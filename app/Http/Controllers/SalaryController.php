<?php

namespace App\Http\Controllers;

use App\Models\DailySalary;
use App\Models\MonthlySalary;
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
        echo $request;
        $users = User::all();
        echo $request->at_date;
        foreach ($users as $user){
            $qid="pr".$user->id;
            $iid="inc".$user->id;
            echo $iid;
            echo "<br><br>";
            $status=$request->$qid;
            echo "--".$status."-- ";
            $fsal=0;
            $fsal=(int)$user->experience*1000;

            if($status == '1'){
                $dsal=new DailySalary();
                $dsal->user_id=$user->id;
                $dsal->fixed_salary=$fsal;
                echo $request->$iid;
                if($request->$iid){
                    //$dsal=(int)$request->$iid +$fsal;
                    $dsal->incentives=$request->$iid;
                }
                else{
                    $dsal->incentives=0;
                }
                $dsal->save();
                echo "Saved";
                echo "<br>";
            }

            //
        }
        return redirect('/attendance');
        //return redirect('/show');
    }

    public function __invoke(Request $request)
    {
        //
    }
}
