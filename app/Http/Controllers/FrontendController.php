<?php

namespace App\Http\Controllers;

use App\Models\Membertype;
use App\Models\Paymenttype;
use App\Models\User;
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
        $membertypes = Membertype::all();
        $paymentypes = Paymenttype::all();
        return Inertia::render('Welcome', [
            'membertypes' => $membertypes,
            'paymentypes' => $paymentypes,
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
            'image' => 'image|mimes:png,jpg,jpeg',
            'email' => 'required|unique:users,email',
            'street_address' => 'required',
            'apartment' => 'required',
            'city' => 'required',
            'provience' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
            'status' => 'required|in:citizenship,permanent_resident,other',
            'membertype_id' => 'required|exists:membertypes,id',
            'paymenttype_id' => 'required|exists:paymenttypes,id',
            'phone' => 'required',
            'donation_amount' => 'gt:0',

        ]);



        $amount = 0;

        $paymentypes = Paymenttype::findOrFail($request->paymenttype_id);
        $amount = $amount + $paymentypes->price;
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
                    return redirect()->away($links['href']);
                }
            }
            dd('something went wrong');

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


    public function joinInvitationByLink(Request $request, User $user)
    {
        dd($user);
    }

    public function GenerateLink()
    {
        if (auth()->user()->children->count()) {
            return "your cannot add more member";
        } else {
            $user = auth()->user();
            $user->referal_code = Str::uuid();
            $user->save();
            return route('joinInvitationByLink', $user->referal_code);
        }
    }

    public function changeMemberStatusGet()
    {
        $users = User::withCount('membertype')->get();
        return view('m');
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


        return Inertia::render('Users/MemberList', [
            'users' => $users,
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
}
