<?php

namespace App\Http\Controllers;

use App\Mail\SendInvitationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class DashboardController extends Controller
{

    public function index()
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

        return Inertia::render('Dashboard', [
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

    public function donor()
    {
        return Inertia::render('Users/DonorDashboard', [
            'user' => auth()->user()
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
}
