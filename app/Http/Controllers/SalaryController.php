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

        //$dsalaries=DailySalary::all();
        // foreach($dsalaries as $dsalary){
        //     if($dsalary->saldate == $request->at_date){
        //         return redirect('/attendance')->withErrors('Attendance for the day has been marked already');
        //     }
        // }
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
                // try{
                //     $dsal->save();
                // }
                // catch(\Exception $e){
                //     // return redirect('/attendance')->withError($e->getMessage());
                //     //return back()->withError($exception->getMessage())->withInput();
                // }
                $dsal->save();
                return redirect('/attendance');

                echo "Saved";
                echo "<br>";
            }
        }


        return redirect('/attendance');
        //return redirect('/show');
    }

    public function ajaxtest(Request $request)
    {
            //return $request;
            // $grocery = new Grocery();
            // $grocery->name = $request->name;
            // $grocery->type = $request->type;
            // $grocery->price = $request->price;

            // $grocery->save();

            // return "response()->json(['success'=>'Data is successfully added'])";
            return $request;
            return "response()->json(['success'=>$request->pr1])";

            //return "response()->json(['error'=>'Error'])";
    }

    public function __invoke(Request $request)
    {
        //
    }
}
