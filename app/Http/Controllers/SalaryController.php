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

    public function v2attreport(Request $request)
    {
        $users = User::all();
        $dss = DailySalary::all();

        $mnth = explode("-",$request->mnth)[1];
        $dss = DailySalary::whereMonth('saldate', $mnth)->get();
        // return $dss;
        //$date = Carbon::createFromFormat('m/d/Y', $dss[0]->saldate);
        $tdate= '01/'.$mnth.'/2022';
        $month = Carbon::createFromFormat('d/m/Y', $tdate)->format('F');
        // //return $dss[0]->user_id;
        // $usrarr=(array)$users;

        // return view('attendance_report', compact('users','month','dss'));
        $usrdatarr=array();
        foreach($users as $user){
            $tmparr = array();
            foreach($dss as $ds){
                if($ds->user_id==$user->id){
                    // if($itr==0){
                    //     $usrdatarr
                    // }
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
                    // if($itr==0){
                    //     $usrdatarr
                    // }
                    array_push($tmparr,$user->id);
                }
            }
            $datuserarr[explode("-",$ds->saldate)[2]]=$tmparr;
        }

        // return $usrdatarr;
        // $usrdataobj=(object)$usrdatarr;
        //$usrdataobj = json_decode(json_encode($usrdatarr), FALSE);
        //$st="3";
        // dd ($usrdatarr) ;
        $yr=explode("-",$request->mnth)[0];


       return view('attendance_report', compact('users','month','mnth','yr','usrdatarr','datuserarr'));


        // $users = User::all();
        // $dss = DailySalary::all();
        // $datelist = DailySalary::distinct('saldate')->get(['saldate']);
        // $dates=array();
        // foreach($datelist as $dateentry){
        //     array_push($dates,  $dateentry['saldate']);
        // }

        // // foreach($datelist as $dateentry){
        // //     $tmparr=explode("-",$dateentry['saldate']);
        // //     $tmpstr=$tmparr[2]."-".$tmparr[1]."-".$tmparr[0];
        // //     array_push($dates,  $tmpstr);
        // // }

        // sort($dates);

        // for($i=0;$i<sizeof($dates);$i++){
        //     $tmparr=explode("-",$dates[$i]);
        //     $tmpstr=$tmparr[2]."-".$tmparr[1]."-".$tmparr[0];
        //     $dates[$i]=$tmpstr;
        // }

        // //return $dates;
        // $bundled_dates=array();
        // $ctr=0;
        // $tmparr=array();
        // foreach($dates as $dateelem){
        //     $ctr+=1;
        //     if($ctr>10){
        //         array_push($bundled_dates,$tmparr);
        //         $tmparr=array();
        //     }
        //     array_push($tmparr,$dateelem);
        // }
        // return $bundled_dates;
        // return view('attendance_report', compact('users','dss','dates'));
    }

    public function __invoke(Request $request)
    {
        //
    }
}
