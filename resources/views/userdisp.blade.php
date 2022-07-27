<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Employee Details</title>
    </head>
    <body>
        {{--  {{ $msals }}  --}}
        {{--  {{ $users }}  --}}
        <div class="container my-5 mx-4">
            <div>
                <h1 class="text-left d-inline">Employee details Manager</h1>
                <div class="text-right mr-5">
                    <a class="btn btn-success mt-2" href="create">Add Employee</a>
                    <a class="btn btn-primary mx-1 mt-2 text-light" href="/attendance">
                        Mark Attendance
                    </a>
                </div>
            </div>
            <div class="card my-5 mx-5 ">
                <h5 class="card-header">Employee Details</h5>
                <div class=" mx-4 my-2">
                    <p class="font-weight-bold m-3">Total No. of employees: {{ sizeof($users) }}</p>
                    <a class="btn btn-info mt-1 ml-3" href="msal">Calculate Monthly Salary</a>
                    </div>
                    <div class="m-3">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Experience</th>
                                <th scope="col">Email</th>
                                <th scope="col">Monthly Salary (AON)</th>
                                <th scope="col" class="text-center">Actions</th>
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

                                    @if($user->experience == 1)
                                        <td>{{ $user->experience }} yr</td>
                                    @else
                                        <td>{{ $user->experience }} yrs</td>
                                    @endif
                                    <td>{{ $user -> email }}</td>
                                    <td>
                                        @foreach ($msals as $msal)
                                            @php
                                            if ($msal->user_id==$user->id){
                                                echo "$msal->total_salary";
                                            }
                                            @endphp
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-secondary " href="manage/{{ $user->id }}">Manage</a>
                                        <a class="btn btn-info " href="msal/{{ $user->id }}">Calculate Salary</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>

