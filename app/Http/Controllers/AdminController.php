<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Hotel;
use App\Airline;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    public function test()
    {
        echo 'test';
    }

    public function getUsersAgent()
    {
        $users = User::paginate(10);

        return view('admin.users-agent', ['users' => $users]);
    }

    public function getUserAgent($id)
    {

        $usr = User::findOrFail($id);

        if ($usr->approved == 0)
            $usr->approved = 1;
        else
            $usr->approved = 0;
        $usr->save();

        return redirect()->back();

    }

    public function getUsersHotel()
    {
        $users = Hotel::paginate(10);

        return view('admin.users-hotel', ['users' => $users]);
    }

    public function getUserHotel($id)
    {

        $usr = Hotel::findOrFail($id);

        if ($usr->approved == 0)
            $usr->approved = 1;
        else
            $usr->approved = 0;
        $usr->save();

        return redirect()->back();

    }

    public function getUsersAirline()
    {
        $users = Airline::paginate(10);

        return view('admin.users-airline', ['users' => $users]);
    }

    public function getUserAirline($id)
    {

        $usr = Airline::findOrFail($id);

        if ($usr->approved == 0)
            $usr->approved = 1;
        else
            $usr->approved = 0;
        $usr->save();

        return redirect()->back();

    }
}