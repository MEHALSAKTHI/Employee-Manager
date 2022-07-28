<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <title>Employee Manager | Attendance</title>

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


        <div class="container my-3 mx-4">
            <div>
                <h1 class="text-left d-inline">Employee details Manager</h1>
                <div class="text-right">
                    <a class="btn btn-secondary mt-2" href="/">View All Employees</a>
                </div>
            </div>
            <div class="card my-5 mx-5">

                <div class="container">

                    <form id="myForm">
                       <div class="form-group">
                         <label for="name">Name:</label>
                         <input type="text" class="form-control" id="name">
                       </div>
                       <div class="form-group">
                         <label for="type">Type:</label>
                         <input type="text" class="form-control" id="type">
                       </div>
                       <div class="form-group">
                          <label for="price">Price:</label>
                          <input type="text" class="form-control" id="price">
                        </div>
                       <button class="btn btn-primary" id="ajaxSubmit">Submit</button>
                     </form>
                 </div>
                 <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                          integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                          crossorigin="anonymous">
                 </script>
                 <script>
                    jQuery(document).ready(function(){
                       jQuery('#ajaxSubmit').click(function(e){
                          e.preventDefault();
                          $.ajaxSetup({
                             headers: {
                                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                             }
                         });
                          jQuery.ajax({
                             url: "{{ url('/v2/ajaxtest') }}",
                             method: 'post',
                             data: {


                                name: jQuery('#pr1').val(),
                                type: jQuery('#inc1').val(),
                                
                                //price: jQuery('#price').val()
                             },
                             success: function(result){
                                console.log(result);
                                jQuery('.alert').show();
                                jQuery('.alert').html(result.success);
                             }});
                          });
                       });
                 </script>



                {{--  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif  --}}

                <h5 class="card-header">Mark presence of employees:</h5>
                <div class="container">
                    <div class="row">
                      <div class="col-8 pt-3" >

                        <div class="m-3 px-3 mt-1" >
                            <div class="alert alert-success mr-5" style="display:none"> Attendance Added Successfully</div>
                            <form action="/attstore" method="POST">
                                <label for="date">Date of Attendance:</label>
                                <input type="date" id="at_date" name="at_date" required><br><br>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" class="text-center">A &nbsp P</th>
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
                                                <input type="range" style="width:40px" id="pr{{ $user->id }}" name="pr{{ $user->id }}" min="0" max="1">
                                                {{--  <input type="radio" required class="mx-1" id="pr{{ $user->id }}" name="pr{{ $user->id }}" value="1">
                                                <input type="radio" required id="pr{{ $user->id }}" class="mx-1" name="pr{{ $user->id }}" value="0">  --}}
                                            </td>
                                            <td>
                                               <input type="text" id="inc{{ $user->id }}" name="inc{{ $user->id }}">
                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-success ">Submit</button>
                            </form>
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

