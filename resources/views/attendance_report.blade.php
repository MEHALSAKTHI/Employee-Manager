<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

        <title>Employee Manager | {{ $month }} Attendance Report </title>
        <style>
            body{
                background-image: linear-gradient(to right, #0f0c29, #302b63, #24243e);
            }
        </style>
    </head>
    <body>

        <script>
            function myFunction() {
              var input, filter, table, tr, td, i, txtValue;
              input = document.getElementById("myInput");
              filter = input.value.toUpperCase();
              table = document.getElementById("reporttable");
              tr = table.getElementsByTagName("tr");
              for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                  txtValue = td.textContent || td.innerText;
                  if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                  }
                }
              }
            }
        </script>

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
                var elt = document.getElementById('reporttable');
                var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });

                return dl ?
                  XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
                  XLSX.writeFile(wb, fn || ('Employeeattendance.' + (type || 'xlsx')));
             }

        </script>


        <div class="container my-5 mx-4">
            <div>
                <h1 class="text-left text-light d-inline">Employee details Manager</h1>
            </div>
            <div class="card my-5 mx-1">
                <div class="card-header"> <h5><b><h2 class="d-inline">{{ $month }}</h2></b> Month Attendance Report </h5>

                <div >
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
                    <span style="float:right;">
                        <a class="btn btn-secondary" href="/">Back to Homepage</a>
                    </span>

                </div><br>
                <div>
                    <div class="text-right">
                        <input type="text" class="mx-1 " id="myInput" onkeyup="myFunction()" placeholder=' Search Names' >
                    </div>
                </div>

                </div>
                <div class="container">
                    <div class="row" id="printabletable">
                        <div class="table-responsive" id="resp" >

                                <table class="table m-4" name="reporttable" id="reporttable">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        @php

                                            if($mnth=='1'||$mnth=='3'||$mnth=='5'||$mnth=='7'||$mnth=='8'||$mnth=='10'||$mnth=='12'){
                                                $dno=31;
                                            }
                                            else{
                                                $dno=30;
                                            }


                                            for ($i=1;$i<$dno+1;$i++){
                                                $timestamp=strtotime($yr."-".$mnth."-".$i);
                                                $day = date('D',$timestamp);
                                                echo "<th scope='col' class='text-center'>".$i."<br>".$day."</th>";
                                            }
                                        @endphp
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @foreach ($users as $user)
                                        <tr class="vertical-align: middle">
                                            <td>{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>

                                            @php
                                            for ($i=1;$i<$dno+1;$i++){
                                                $flag=0;
                                                foreach($usrdatarr as $key1 => $value1){
                                                    if($key1==$user->id && $flag==0){
                                                        foreach($value1 as $key2 => $value2){
                                                            //echo $value2;
                                                            if($i==$value2 ){
                                                                $flag=1;
                                                                echo "<td>"."<p hidden>P</p>".'<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="green" class="bi bi-check-lg " viewBox="0 0 16 16">
                                                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                                                  </svg>'."</td>";

                                                            }
                                                        }
                                                    }
                                                }

                                                if($flag==0){
                                                    $flag2=0;
                                                    foreach($datuserarr as $key1 => $value1){
                                                        if($key1==$i){
                                                            $flag2=1;
                                                            echo "<td>"."<p hidden>A</p>".'<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="red" class="bi bi-x" viewBox="0 0 16 16">
                                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                              </svg>'."</td>";
                                                        }
                                                    }
                                                    if($flag2==0){
                                                        echo "<td class='text-primary   '>"."-"."</td>";
                                                    }
                                                }
                                            }
                                            @endphp
                                        </tr>
                                        @endforeach
                                    </tr>

                                    </tbody>
                                </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>



