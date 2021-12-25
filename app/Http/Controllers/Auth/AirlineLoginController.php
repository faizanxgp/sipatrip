<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AirlineLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:airline')->except('logout');;
    }
    public function showLoginForm()
    {
        return view('auth.airline-login');
    }
    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        // Attempt to log the user in
        if (Auth::guard('airline')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('airline.dashboard'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    protected function authenticated(Request $request, $user)
    {
        if ( $user->approved == 0 ) {
            auth()->logout();

            return back()->withErrors(['email' => 'You are not activated.']);
        }

        return redirect()->intended($this->redirectPath());
    }

    public function logout()
    {
        Auth::guard('airline')->logout();
        return redirect()->route('airline.login');
    }
}