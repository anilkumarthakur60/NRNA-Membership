<?php

namespace App\Http\Controllers;

use App\Models\Membertype;
use App\Models\Paymenttype;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        // dd($request->all());



        $amount = 0;
        if ($request->payment_amount) {
            $this->validate($request, [
                'payment_amount' => 'nullable|exists:paymenttypes,id',
            ]);

            $paymentypes = Paymenttype::find($request->payment_amount);
            $amount = $amount + $paymentypes->price;
            $data['payment_amount'] = $request->payment_amount;
        } else {
            $data['payment_amount'] = null;
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
        } else {
            $data['image'] = null;
        }

        // dd($amount);


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


        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);


        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            DB::transaction(function () use ($response) {


                $UserPostData = session()->get('membershipData');



                $user = User::create([
                    'name' => $UserPostData['name'],
                    'email' => $UserPostData['email'],
                    'password' => bcrypt($UserPostData['email'] . $UserPostData['city']),

                    'street_address' => $UserPostData['street_address'],
                    'apartment' => $UserPostData['apartment'],
                    'city' => $UserPostData['city'],
                    'provience' => $UserPostData['provience'],
                    'zip_code' => $UserPostData['zip_code'],
                    'country' => $UserPostData['country'],
                    'status' => $UserPostData['status'],
                    'image' => $UserPostData['image'],
                    'membertype_id' => $UserPostData['membertype_id'],
                    'paymenttype_id' => $UserPostData['payment_amount'],
                    'phone' => $UserPostData['phone'],
                    'donation_amount' => $UserPostData['donation_amount'],

                ]);

                $data = [];
                $data['user_id'] = $user->id;
                $data['amount'] = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
                $data['currency_code'] = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
                $data['payer_name'] = $response['purchase_units'][0]['shipping']['name']['full_name'];
                $data['payer_email_address'] = $response['payer']['email_address'];
                $data['address_line_1'] = $response['purchase_units'][0]['shipping']['address']['address_line_1'];
                $data['admin_area_2'] = $response['purchase_units'][0]['shipping']['address']['admin_area_2'];
                $data['admin_area_1'] = $response['purchase_units'][0]['shipping']['address']['admin_area_1'];
                $data['postal_code'] = $response['purchase_units'][0]['shipping']['address']['postal_code'];
                $data['country_code'] = $response['purchase_units'][0]['shipping']['address']['country_code'];
                $data['payer_payer_id'] = $response['payer']['payer_id'];
                $data['token'] = $response['id'];
                $data['status'] = $response['status'];

                $user->paymentInfos()->create($data);
                $usertype = UserType::where('slug', 'pending')->first();
                $user->UserTypes()->attach($usertype->id);
                toastr()->success('Transation completed');
            });
            return redirect()
                ->route('membershipList')
                ->with('success', 'Transaction complete.');
        } else {

            toastr()->error('Some Thing Went Wrong');
            return redirect()
                ->route('front.index')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function processCancel(Request $request)
    {


        toastr()->warning('You have cancelled transation');
        return redirect()
            ->route('front.index')
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

        $users = QueryBuilder::for(User::class)->whereHas('UserTypes')
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
