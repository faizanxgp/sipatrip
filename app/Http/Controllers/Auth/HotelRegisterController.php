<?php

namespace App\Http\Controllers\Auth;

use App\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


use DB;
use Mail;
use Session;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;

class HotelRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'max:30',
            'website' => 'max:255',
            'email' => 'required|string|email|max:255|unique:hotels',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Hotel::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'website' => $data['website'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function RegistrationForm() {
        return view('auth.hotel-register');
    }

    public function register(Request $request)
    {

        // Laravel validation
        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException($request, $validator);
        }
        // Using database transactions is useful here because stuff happening is actually a transaction
        // I don't know what I said in the last line! Weird!
        DB::beginTransaction();
        try
        {
            $hotel = $this->create($request->all());
//            // After creating the user send an email with the random token generated in the create method above
//            $email = new EmailVerification(new User(['email_token' => $user->email_token, 'name' => $user->name]));
//            Mail::to($user->email)->send($email);
            DB::commit();

            Session::flash('flash_message', 'Please check your email to verify it. Hotel');

            return back();
        }
        catch(Exception $e)
        {
            DB::rollback();
            return back();
        }
    }

    public function verify($token)
    {
        // The verified method has been added to the user model and chained here
        // for better readability
        Hotel::where('email_token',$token)->firstOrFail()->verified();
        return redirect('login');
    }
}
