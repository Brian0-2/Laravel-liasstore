<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        //Create user
        $user = User::create($request -> all());
        $user -> assignRole('customer');

        event(new Registered($user));
        Auth::login($user);

         // Redirect
         if ($user->hasRole('admin')) {
            //Route('admin.index')
            return redirect(RouteServiceProvider::HOME);
         }else{
            return redirect() -> route('index');
         }
    }
}
