<?php

namespace App\Http\Controllers;

use App\Models\DailySalary;
use App\Models\MonthlySalary;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $users = DB::select('select * from users');
        return view('dataform');
    }

    public function index()
    {
        return "index page";
    }

    public function show()
    {
        $users = User::all();
        return view('userdisp', compact('users'));
        foreach ($users as $user){
            echo $user->name;
            echo "<br>";
        }
    }

    public function store(Request $request)
    {
        $tuser = new User();
        $tuser->name = $request->name;
        $tuser->email = $request->email;
        $tuser->experience = $request->experience;
        $tuser->save();
        return redirect('/show');
    }

    public function manage($id)
    {
        $user = User::where('id', $id)->first();
        return view('manage', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $tuser = User::where('id', $id)->first();
        $tuser->name = $request->name;
        $tuser->email = $request->email;
        $tuser->experience = $request->experience;
        $tuser->save();
        return redirect('/show');
    }

    public function delete($id)
    {
        $tuser = User::where('id', $id)->delete();
        return redirect('/show');
    }


    public function msalarycalc($id)
    {
        $dailysalaries = User::find($id)->dailysalaries ;
        $net_sal=0;
        foreach ($dailysalaries as $dailysalary) {
            $t_sal=(int)$dailysalary->fixed_salary+(int)$dailysalary->incentives;
            $net_sal=$t_sal+$net_sal;
        }

        echo ($net_sal);

        $msal = new MonthlySalary();
        $msal->user_id=$id;
        $msal->total_salary=$net_sal;
        $msal->save();
    }

    public function __invoke(Request $request)
    {
        //
    }
}
