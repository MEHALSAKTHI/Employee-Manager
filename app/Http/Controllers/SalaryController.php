<?php

namespace App\Http\Controllers;

use App\Models\DailySalary;
use App\Models\MonthlySalary;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Arr;
use Carbon\Carbon;

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
        return view('attendance_mark', compact('users'));
    }

    public function att_manage(Request $request)
    {
        $users = User::all();
        $dss = DailySalary::all();
        $chkdetails = array();
        $incdetails = array();

       // return $chkdetails;
        //return $request->at_date;
        if($dss){
            foreach($dss as $ds){
                if($ds->saldate==$request->at_date){
                    array_push($chkdetails,$ds->user_id);
                    array_push($incdetails,$ds->user_id."-".$ds->incentives);
                }
            }
            $dt=$request->at_date;

            $hdt=explode("-",$request->at_date)[2]."-".explode("-",$request->at_date)[1]."-".explode("-",$request->at_date)[0];
            return view('attendance_manage', compact('users','incdetails','chkdetails','dt','hdt','dss'));
        }
        else{
            echo "Attendance Not marked for the day";
            return view('attendance_mark', compact('users'));
        }
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

    public function att_update(Request $request)
    {
        echo $request;
        $users = User::all();
        $dss = DailySalary::all();
        $chkdetails = array();

       // return $chkdetails;
        //return $request->at_date;
        if($dss){
            foreach($dss as $ds){
                if($ds->saldate==$request->at_date){
                    $res=DailySalary::where('id',$ds->id)->delete();
                }
            }
        }

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

                        echo "Saved";
                        echo "<br>";
                    }

                }
            }
        }

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

                        echo "Saved";
                        echo "<br>";
                    }

                }
            }
        }

        return "response()->json(['success'=>'Added Successfully'])";

    }

    public function v2attreport(Request $request)
    {
        $users = User::all();
        $dss = DailySalary::all();

        $mnth = explode("-",$request->mnth)[1];
        $dss = DailySalary::whereMonth('saldate', $mnth)->get();

        $tdate= '01/'.$mnth.'/2022';
        $month = Carbon::createFromFormat('d/m/Y', $tdate)->format('F');

        $usrdatarr=array();
        foreach($users as $user){
            $tmparr = array();
            foreach($dss as $ds){
                if($ds->user_id==$user->id){

                    array_push($tmparr,explode("-",$ds->saldate)[2]);
                }
            }
            $usrdatarr[$user->id]=$tmparr;
        }

        $datuserarr=array();
        foreach($dss as $ds){
            $tmparr = array();
            foreach($users as $user){
                if($ds->user_id==$user->id){

                    array_push($tmparr,$user->id);
                }
            }
            $datuserarr[explode("-",$ds->saldate)[2]]=$tmparr;
        }


        $yr=explode("-",$request->mnth)[0];


       return view('attendance_report', compact('users','month','mnth','yr','usrdatarr','datuserarr'));

    }

    public function __invoke(Request $request)
    {
        //
    }

    public function fullcal()
    {
        return view('temp');
    }
}
