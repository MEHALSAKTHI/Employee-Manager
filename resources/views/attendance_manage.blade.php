<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <title>Employee Manager | Attendance</title>
        <style>
            body{
                background-image: linear-gradient(to right, #0f0c29, #302b63, #24243e);
            }
        </style>
    </head>
    <body>


        {{--  <script>
            $(document).ready(function(){
              $("#hidebtn").click(function(){
                $("table").hide();
              });
            });
        </script>
        <button id="hidebtn">Hide</button>
        <h1>Hi</h1>  --}}


        <div class="container my-5 mx-4">
            <div>
                <h1 class="text-left text-light d-inline">Employee details Manager</h1>

            </div>
            <div class="card my-5 mx-5 ">

                 <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                          integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                          crossorigin="anonymous">
                 </script>

                 <script type="text/javascript">
                    function selects(){
                        var ele=document.getElementsByName('chk');
                        for(var i=0; i<ele.length; i++){
                            if(ele[i].type=='checkbox')
                                ele[i].checked=true;
                        }
                    }
                    function deSelect(){
                        var ele=document.getElementsByName('chk');
                        for(var i=0; i<ele.length; i++){
                            if(ele[i].type=='checkbox')
                                ele[i].checked=false;

                        }
                    }
                </script>

                 <script>
                    jQuery(document).ready(function(){
                       jQuery('#ajaxSubmit').click(function(e){
                            e.preventDefault();
                            jQuery('.alert').hide();
                            jQuery('.nalert').hide();
                            var arrData=[];
                            // loop over each table row (tr)
                            $("#at_table tbody tr").each(function(){
                                    var currentRow=$(this);
                                    var prstatus=0;
                                    var nameval=currentRow.find("td:eq(1) ").text();
                                    {{--  var prstatus=currentRow.find("td:eq(2) input[type='text']").val();  --}}
                                    var incentives=currentRow.find("td:eq(3) input[type='text']").val();
                                    var prstatus1=currentRow.find("td:eq(2) input[type='checkbox']").val(function(){
                                        if($(this).prop("checked") == true){
                                            prstatus=1;
                                        }
                                        else if($(this).prop("checked") == false){
                                            prstatus=0;
                                        }
                                    });

                                    console.log(prstatus);

                                    var obj={};
                                    obj.name=nameval;
                                    obj.pr=prstatus;
                                    obj.inc=incentives

                                    arrData.push(obj);
                            });

                          $.ajaxSetup({
                             headers: {
                                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                             }
                         });

                        jQuery.ajax({
                             url: "{{ url('/v2/attendance/update') }}",
                             method: 'post',
                             data: {

                                at_date: jQuery('#at_date').val(),
                                at_details: arrData
                                //price: jQuery('#price').val()
                             },
                             success: function(result){
                                console.log(result);
                                if(result=="Error1"){
                                    jQuery('#nalert1').show();
                                }
                                else if(result=="Error2"){
                                    jQuery('#nalert2').show();
                                }
                                else{
                                    jQuery('#alert').show();
                                }
                                //jQuery('.alert').html(result.success);
                             }});
                          });
                       });
                 </script>

                <h5 class="card-header">Mark presence of employees:</h5>
                <div class="container">
                    <div class="row">
                      <div class="col-8 pt-3" >

                        <div class="m-3 px-3 mt-1" >
                            <div class="alert alert-success " id="alert" style="display:none"> Attendance Update Successfully</div>
                            <div class="alert alert-warning  " id="nalert1" style="display:none"> Choose the Date</div>
                            <div class="alert alert-danger  " id="nalert2" style="display:none"> Attendance Already marked</div>


                            {{--  <script>
                                // Get relevant element
                                function chk(){
                                    checkBox = document.getElementById('takenBefore');
                                    // Check if the element is selected/checked
                                    if(checkBox.checked) {
                                        // Respond to the result
                                        alert("Checkbox checked!");
                                    }
                                }
                            </script>  --}}

                            <form action="/attstore" class="d-inline" method="POST">
                                <label for="date">Date of Attendance: {{ $hdt }}</label>
                                <input type="date" id="at_date" name="at_date" value={{ $dt  }} max="<?=date('Y-m-d')?>" hidden required>
                                <span class="mx-2">
                                    <input type="button" class="btn btn-info" onclick='selects()' value="Select All"/>
                                    <input type="button" class="btn btn-info" onclick='deSelect()' value="Deselect All"/>
                                </span>

                                <br><br>
                                <table class="table" name="at_table" id="at_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" class="text-center">Present</th>
                                        <th scope="col">Incentive</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $ctr=0;
                                        @endphp
                                        @foreach ($users as $user)
                                        <tr class="vertical-align: middle">
                                            @php
                                                $ctr=$ctr+1;
                                            @endphp
                                            <th scope="row" >{{ $ctr}}</th>
                                            <td>{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td class="text-center">
                                                {{--  <input type="text" id="pr{{ $user->id }}" class="w-50 text-center" required name="pr{{ $user->id }}">  --}}
                                                {{--  <input type="range" style="width:40px" id="pr{{ $user->id }}" name="pr{{ $user->id }}" min="0" max="1">  --}}
                                                @php
                                                    $flag=0;
                                                    foreach($chkdetails as $key1 => $value1){
                                                        if($value1==$user->id){
                                                            $flag=1;
                                                            echo'<input type="checkbox" id="pr{{ $user->id }}" name="chk" value="1" checked>';
                                                        }
                                                    }
                                                    if($flag==0){
                                                        echo'<input type="checkbox" id="pr{{ $user->id }}" name="chk" value="1" >';
                                                    }
                                                @endphp


                                                {{--  <input type="radio" required class="mx-1" id="pr{{ $user->id }}" name="pr{{ $user->id }}" value="1">
                                                <input type="radio" required id="pr{{ $user->id }}" class="mx-1" name="pr{{ $user->id }}" value="0">  --}}
                                            </td>
                                            <td>

                                                @php
                                                    $flag=0;
                                                    foreach($incdetails as $key1 => $value1){
                                                        if($user->id == explode("-",$value1)[0]){
                                                            $flag=1;
                                                            echo'<input type="text" id="inc{{ $user->id }}" class="w-75 text-center" value='.explode("-",$value1)[1].' name="inc{{ $user->id }}">';
                                                        }
                                                    }
                                                    if($flag==0){
                                                        echo'<input type="text" id="inc{{ $user->id }}" class="w-75 text-center" name="inc{{ $user->id }}">';
                                                    }
                                                @endphp

                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>

                                {{--  <button type="reset" class="btn btn-secondary text-light" href="/attendance" >
                                    <div class="pt-2 d-inline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" fill="currentColor" class="bi bi-arrow-clockwise " viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                            </svg>
                                    </div>
                                    &nbspRefresh Entry
                                </button >  --}}

                            </form>
                            <button class="btn btn-success m-1" id="ajaxSubmit">Submit</button>
                            <a class="btn btn-primary m-1" href="/">Back</a>

                        </div>
                      </div>
                      <div class="col p-4 mt-5">
                        {{--  <img class="img-fluid " src="{{ asset('emp.png') }}">  --}}
                        <img class="img-fluid " src="/images/att.jpg">
                      </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>

