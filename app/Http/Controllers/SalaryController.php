<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SalaryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function att_marker()
    {
        $users = User::all();
        return view('attendance', compact('users'));
    }

    public function att_store(Request $request)
    {
        //return "hi";
        $users = User::all();
        echo $request->at_date;
        foreach ($users as $user){
            $qid="pr".$user->id;
            $iid="inc".$user->id;
            echo $iid;
            echo "<br><br>";
            $status=$request->$qid;
            echo "--".$status."-- ";
            $dsal=0;
            $fsal=0;
            $fsal=(int)$user->experience*1000;
            if($status == '1'){
                echo $request->$iid;
                if($request->$iid){
                    $dsal=(int)$request->$iid +$fsal;
                }
                else{
                    $dsal=$fsal;
                }
            }
            echo $dsal;
            echo "<br>";
        }

        //return redirect('/show');
    }

    public function __invoke(Request $request)
    {
        //
    }
}
