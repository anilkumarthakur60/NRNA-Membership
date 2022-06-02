<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Mail\SendInvitationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{

    public function index()
    {


        $authusers=auth()->user();
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

        return Inertia::render('Dashboard', [
            'users' => $users,
            'authusers'=>$authusers
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

    public function donor()
    {

$user=  new UserResource(auth()->user());
        return Inertia::render('Users/DonorDashboard', [
            'user' => $user,
            'membership'=>auth()->user()->membertype
        ]);
    }

    public function sendInivationLink(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|unique:users,email'
        ]);
        $route = route('joinInvitaionLink', auth()->user()->referal_code);

        Mail::to($request->email)->send(new SendInvitationMail($route));
        return redirect(route('donor.dashboard'));
    }
    public function invite()
    {

        return Inertia::render('Users/Invite');
    }
    public function updateProfile(Request $request){

auth()->user()->update([
    'gender'=>$request->gender,
    'profession'=>$request->profession,
    'street_address'=>$request->street_address,
    'dob'=>date('Y-m-d',(int)$request->dob)
]);
        return redirect()->route('donor.dashboard');

    }

    public function updateDocument(Request $request){



        if($request->hasFile('image')){
            $this->validate($request, [
                'image' => 'image|mimes:png,jpg,jpeg',
            ]);

            if(auth()->user()->image!=null){

                if(Storage::disk('public')->exists(auth()->user()->image)) {
                    Storage::disk('public')->delete(auth()->user()->image);
                }
            }
                $image=$request->image->store('user','public');
                auth()->user()->update([
                    'image'=>$image,

                ]);
        }

        if($request->hasFile('profile_photo_path')){
            $this->validate($request, [
                'profile_photo_path'=>'image|mimes:png,jpg,jpeg'
            ]);
            if(auth()->user()->profile_photo_path!=null){
                if(Storage::disk('public')->exists(auth()->user()->profile_photo_path)) {
                    Storage::disk('public')->delete(auth()->user()->profile_photo_path);
                }
            }
            $profile=$request->profile_photo_path->store('user','public');
            auth()->user()->update([
                'profile_photo_path'=>$profile,

            ]);

        }





        return redirect()->route('donor.dashboard');


    }

    public function updateSkills(Request $request){

        auth()->user()->update($request->all());
        return redirect()->route('donor.dashboard');

    }
}
