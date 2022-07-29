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

        {{--  {{ $usrdataobj->st[0] }}  --}}

        <div class="container my-3 mx-2">
            <div>
                <h1 class="text-left d-inline">Employee details Manager</h1>
                <div class="text-right">
                    <a class="btn btn-secondary mt-2" href="/">View All Employees</a>
                </div>
            </div>
            <div class="card my-5 mx-1">
                <h5 class="card-header"> <b><h2 class="d-inline">{{ $month }}</h2></b> - Overall Monthly Attendance Report </h5>
                <div class="container">
                    <div class="row">
                        <div class="table-responsive" >
                            <table class="table m-2">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    @php
                                        for ($i=1;$i<32;$i++){
                                            echo "<th scope='col'>".$i."</th>";
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
                                        for ($i=1;$i<32;$i++){
                                            $flag=0;
                                            foreach($usrdatarr as $key1 => $value1){
                                                if($key1==$user->id && $flag==0){
                                                    foreach($value1 as $key2 => $value2){
                                                        //echo $value2;
                                                        if($i==$value2 ){
                                                            $flag=1;
                                                            echo "<td>".'<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="green" class="bi bi-check-lg " viewBox="0 0 16 16">
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
                                                        echo "<td>".'<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="red" class="bi bi-x" viewBox="0 0 16 16">
                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                          </svg>'."</td>";
                                                    }
                                                }
                                                if($flag2==0){
                                                    echo "<td class='text-primary   '>"."-"."</td>";
                                                }


                                            }
                                            //echo "<td>"."x"."</td>";
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

