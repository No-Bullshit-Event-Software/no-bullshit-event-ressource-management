<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Exception;
use App\User;
use Auth;



class SocialController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {

        $usersocial = Socialite::driver('google')->user();

        $finduser = User::where('email', $usersocial-> getEmail())->first();

        if($finduser !== null) { // USER EXIST LOG IT IN
            Auth::login($finduser);
            return redirect('/home');

        }

        // User does not exist
        $newUser = User::create([
            'name' => $usersocial->name,
            'email' => $usersocial->email,
            'google_id'=> $usersocial->id,
            'password' => "password",
        ]);

        Auth::login($newUser);

        return redirect('/home');

    }
}