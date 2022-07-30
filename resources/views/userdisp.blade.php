<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <title>Employee Manager | Home</title>
        <style>
            body{
                background-image: linear-gradient(to right, #0f0c29, #302b63, #24243e);
            }
            #maincard{
                background: rgb(181,185,238);
                background: radial-gradient(circle, rgba(181,185,238,1) 0%, rgba(251,251,251,1) 100%);
            }
            .print {
                display:none;
            }
            .no-print{
                display:block;
            }
            @media print{
                .print {
                    display:block;
                }
                .no-print{
                    display:none;
                }
            }

        </style>
    </head>
    <body>
        <div class="container my-5 mx-4">
            <div>
                <h1 class="text-left text-light d-inline">Employee details Manager</h1>
                <div class="text-right mr-5">

            </div>
            </div>
            <div class="card mt-5 mb-2 mx-5 " >
                <h5 class="card-header">Employee Details</h5>

                <div class=" mx-4 my-2" >
                    <p class="font-weight-bold m-3">Total No. of employees: {{ sizeof($users) }}</p>
                    <div class="buttondiv ml-3 ">
                        <a class="btn btn-info  my-1" href="msal">Calculate Cumm. Salary</a>
                        <a class="btn btn-success my-1" href="create">Add Employee</a>
                        <a class="btn btn-primary mx-1 my-1 text-light" href="/attendance/add">
                            Mark Attendance
                        </a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#exampleModal">
                            Attendance Report
                        </button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Attendance Report</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6">
                                            <form action="/v2/attendance/report" method="POST">
                                                <fieldset>
                                                  <legend>Choose Month</legend>
                                                  <input type="month" name="mnth"><br /><br />
                                                  <button type="submit" class="btn btn-success" max="<?=date('Y-m')?>" value="Submit">Generate</button>
                                                </fieldset>
                                              </form>
                                        </div>
                                        <div class="col-6 ">
                                                {{--  <img class="img-fluid " src="{{ asset('emp.png') }}">  --}}
                                                <img class="img-fluid" src="/images/cal.jpg">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>

                    </div>

                    <script>
                        function printDiv() {
                            var divElements = document.getElementById("printabletable").innerHTML;
                            var oldPage = document.body.innerHTML;
                            document.body.innerHTML =
                            "<html><head><title></title></head><body>" +
                            divElements + "</body>";
                            window.print();
                            document.body.innerHTML = oldPage;

                        }
                        function ExportToExcel(type, fn, dl) {
                            var elt = document.getElementById('indextable');
                            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
                            return dl ?
                              XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
                              XLSX.writeFile(wb, fn || ('Employeedetails.' + (type || 'xlsx')));
                         }

                    </script>

                </div>
                <div class="p-3 " id="printabletable">
                    <div class="table-responsive" >
                        <table class="table text-center" id="indextable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Experience</th>
                                <th scope="col">Email</th>
                                <th scope="col">Cumm. Salary (AON)</th>
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
                                        <a class="btn btn-secondary my-1" href="manage/{{ $user->id }}">Manage</a>
                                        <a class="btn btn-info my-1" href="msal/{{ $user->id }}">Calculate Salary</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if(sizeof($users)==0)
                            <p class="mx-4">No Employees Found</p>
                        @endif
                    </div>
                </div>
                <div class="text-right mx-5 mb-3">
                    <button class="btn btn-dark mt-1 ml-1 " onclick="printDiv()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        </svg>
                    </button>
                    <button class="btn btn-dark mt-1 ml-1 " onclick="ExportToExcel('xlsx')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
        {{--  <div style="z-index: 9;">
            @include('waves')
        </div>  --}}

    </body>
</html>

