<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Employee Details</title>
    </head>
    <body>
        <div class="container my-3 mx-4">
            <div>
                <h1 class="text-left d-inline">Employee details Manager</h1>
                <div class="text-right">
                    <a class="btn btn-secondary mt-2" href="/">View All Employees</a>
                        {{--  <button class="btn btn-light">Home</button>
                        <button class="btn btn-light">View</button>
                        <button class="btn btn-light">Create</button>  --}}
                </div>
            </div>
            <div class="card my-5 mx-5">
                <h5 class="card-header">Enter Employee Details</h5>
                <div class="container">
                    <div class="row">

                      <div class="col p-4">
                        {{--  <img class="img-fluid " src="{{ asset('emp.png') }}">  --}}
                        <img class="img-fluid " src="/images/emp.png">
                      </div>
                      <div class="col-7 pt-5" >
                        <div class="m-3 px-3 mt-5" >
                            <form action='store' method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" id="experience" name="experience" placeholder="Experience" required>
                                </div>

                                <button type="submit" class="btn btn-success ">Submit</button>

                                <a class="btn btn-primary " href="/">Back</a>
                            </form>
                        </div>
                      </div>
                    </div>
                </div>
                {{--  <div class="m-3 px-5 mt-4">
                    <form action='store' method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="experience" name="experience" placeholder="Experience" required>
                        </div>

                        <button type="submit" class="btn btn-success ">Submit</button>

                    </form>
                </div>  --}}
            </div>
        </div>
    </body>
</html>

