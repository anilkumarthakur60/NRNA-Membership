<?php

namespace App\Http\Controllers;

use App\Models\Membertype;
use App\Models\Paymenttype;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Str;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FrontendController extends Controller
{
    public function membershipIndex()
    {

        $membertypes = Membertype::withCount('paymenttype')->with('paymenttype')->get();

        return Inertia::render('Welcome', [
            'membertypes' => $membertypes,
        ]);
    }

    public function memberlists()
    {
        $membertypes = Membertype::withCount('users')->get();
        $users = User::withCount('membertype')->get();
        return view('membership.list', [
            'membertypes' => $membertypes,
            'users' => $users
        ]);
    }

    public function membershipStore(Request $request)
    {

        $data =  $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'street_address' => 'required',
            'apartment' => 'required',
            'city' => 'required',
            'provience' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
            'status' => 'required|in:citizenship,permanent_resident,other',
            'membertype_id' => 'required|exists:membertypes,id',
            'phone' => 'required',
            'donation_amount' => 'numeric|nullable',

        ]);





        $amount = 0;
        if ($request->paymenttype_id) {
            $this->validate($request, [
                'paymenttype_id' => 'nullable|exists:paymenttypes,id',
            ]);
            $paymentypes = Paymenttype::find($request->paymenttype_id);
            $amount = $amount + $paymentypes->price;
        }


        $membertypes = Membertype::findOrFail($request->membertype_id);
        $amount = $amount + $membertypes->price;
        if ($request->donation_amount > 0) {
            $amount = $amount + $request->donation_amount;
        }
        $data['amount'] = $amount;


        if ($request->hasFile('image')) {

            $this->validate($request, [
                'image' => 'mimes:png,jpg,jpeg'
            ]);

            $image = $request->image->store('membership', 'public');
            $data['image'] = $image;
        }



        session()->put('membershipData', $data);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('processSuccess'),
                "cancel_url" => route('processCancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return  Inertia::location($links['href']);
                    // return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('front.index')
                ->with('error', 'Something went wrong.');
        } else {

            dd('something went wrong else');
            return redirect()
                ->route('front.index')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }


    public function processSuccess(Request $request)
    {

        dd($request->all());

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            User::create(session()->get('membershipData'));
            return redirect()
                ->route('membership')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('membership')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function processCancel(Request $request)
    {

        dd($request->all());
        return redirect()
            ->route('membership')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }


    public function joinInvitaionLink(Request $request, User $user)
    {
        return Inertia::render('Users/JoinInvitation', [
            'user' => $user
        ]);
    }

    public function joinInvitaionLinkPost(Request $request)
    {
        dd($request->all());
    }

    public function GenerateLink()
    {
        if (auth()->user()->children()->exists()) {
            return "your cannot add more member";
        } else {
            $user = auth()->user();
            $user->referal_code = Str::uuid();
            $user->save();
            return back();
        }
    }



    public function membershipList()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                $query->where('name', 'LIKE', "%{$value}%")->orWhere('email', 'LIKE', "%{$value}%");
            });
        });

        $users = QueryBuilder::for(User::class)
            ->defaultSort('name')
            ->allowedSorts(['name', 'email'])
            ->allowedFilters(['name', 'email', $globalSearch])
            ->paginate()
            ->withQueryString();

        $usertypes = UserType::withCount('users')->get();

        return Inertia::render('Users/MemberList', [
            'users' => $users,
            'usertypes' => $usertypes
        ])->table(function (InertiaTable $table) {
            $table->addSearchRows([
                'name' => 'Name',
                'email' => 'Email address',
            ])->addColumns([
                'email' => 'Email address',
                'name' => 'Name',
            ]);
        });
    }
    public function getcouplePrice(Membertype $membertype)
    {

        return $membertype->paymenttype;
    }
}
