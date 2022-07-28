<?php

namespace App\Http\Controllers;

use App\Models\DailySalary;
use App\Models\MonthlySalary;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

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

    // public function att_manage($date)
    // {
    //     $users = User::all();
    //     $dailysalaries = DailySalary::where('saldate',$date);
    //     return view('attendancemanage', compact('users', 'dailysalaries'));
    // }

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
                $dsal->saldate=$request->at_date;
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
                return redirect('/attendance');

                echo "Saved";
                echo "<br>";
            }
        }


        return redirect('/attendance');
        //return redirect('/show');
    }

    public function v2attstore(Request $request)
    {
        if(!$request->at_date){
            return "Error1";
        }
        $tdsals=DailySalary::where('saldate',$request->at_date)->first();
        if($tdsals){
            return "Error2";
        }
        $users = User::all();
        foreach($request->at_details as $atkey => $atval){
            $nm=$atval['name'];
            foreach ($users as $user){
                if($nm == $user->name){
                    $status=0;
                    if($atval['pr']==1){
                        $status=1;
                    }

                    if($status==1){


                        $user->experience*1000;
                        $dsal=new DailySalary();
                        $dsal->user_id=$user->id;
                        $fsal=(int)$user->experience*1000;
                        $dsal->saldate=$request->at_date;
                        $dsal->fixed_salary=$fsal;
                        if($atval['inc']){
                            $dsal->incentives=$atval['inc'];
                        }
                        else{
                            $dsal->incentives=0;
                        }
                        try{
                            $dsal->save();
                        }
                        catch(Exception $e){
                            return "Error2";
                        }

                        //return redirect('/attendance');

                        echo "Saved";
                        echo "<br>";
                    }

                }
            }
        }

            return "response()->json(['success'=>'Added Successfully'])";

            //return "response()->json(['error'=>'Error'])";
    }
    public function __invoke(Request $request)
    {
        //
    }
}
