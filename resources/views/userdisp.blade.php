<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Employee Manager | Home</title>
        <style>
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
                    <script>
                        function printDiv() {
                            //Get the HTML of div
                            var divElements = document.getElementById("printabletable").innerHTML;
                            //Get the HTML of whole page
                            var oldPage = document.body.innerHTML;
                            //Reset the page's HTML with div's HTML only
                            document.body.innerHTML =
                            "<html><head><title></title></head><body>" +
                            divElements + "</body>";
                            //Print Page
                            window.print();
                            //Restore orignal HTML
                            document.body.innerHTML = oldPage;

                        }

                    function exportDiv(){
                        var table = document.getElementById("indextable");
                        var rows =[];
                        for(var i=0,row; row = table.rows[i];i++){
                            column1 = row.cells[0].innerText;
                            column2 = row.cells[1].innerText;
                            column3 = row.cells[2].innerText;
                            column4 = row.cells[3].innerText;
                            column5 = row.cells[4].innerText;
                            column6 = row.cells[5].innerText;

                        /* add a new records in the array */
                            rows.push(
                                [
                                    column1,
                                    column2,
                                    column3,
                                    column4,
                                    column5,
                                    column6

                                ]
                            );

                            }


                            console.log(rows);

                            csvContent = "data:text/csv;charset=utf-8,";
                             /* add the column delimiter as comma(,) and each row splitted by new line character (\n) */
                            rows.forEach(function(rowArray){
                                row = rowArray.join(",");
                                csvContent += row + "\r\n";
                            });

                            /* create a hidden <a> DOM node and set its download attribute */
                            var encodedUri = encodeURI(csvContent);
                            var link = document.createElement("a");
                            link.setAttribute("href", encodedUri);
                            link.setAttribute("download", "Employeedetails.csv");
                            document.body.appendChild(link);
                             /* download the data file named "Stock_Price_Report.csv" */
                            link.click();
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
                                            <a class="btn btn-secondary my-1" href="manage/{{ $user->id }}">Manage</a>
                                            <a class="btn btn-info my-1" href="msal/{{ $user->id }}">Calculate Salary</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    <div class="text-right mr-3">
                        <button class="btn btn-dark mt-1 ml-1 " onclick="printDiv()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                            <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                            </svg>
                        </button>
                        <button class="btn btn-dark mt-1 ml-1 " onclick="exportDiv()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                              </svg>
                        </button>

                    </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>

