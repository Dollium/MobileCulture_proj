<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
$_SESSION['classID'] = 3;
$_SESSION['schoolID'] = 1;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body>
    <div class="col-lg-8 container" style="background-color: #FFF;">
        <div class="row">

            <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary centered">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
                <a class="navbar-brand" href="#">Teacher Page</a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="teacherStatistics.html">
                                <i class="fa fa-home" aria-hidden="true"></i> Home
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="addstudent.php">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Add Student <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="statistics.html">
                                <i class="fa fa-code" aria-hidden="true"></i> Setting
                            </a>
                        </li>
                    </ul>
                    <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px;" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>
                </div>
            </nav>
            <br>
        </div>
        <br>
        <br>
        <center>
            <div class="addStudent">
<!--ADD MANUALLY-->
                <div class="form-inline text-sm-center">
                    <label class="sr-only" for="name">Name</label>
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="name" name="name" placeholder="Name">
                    <label class="sr-only" for="surName">Surname</label>
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="surName" name="surName" placeholder="Surname">
                    <label class="sr-only" for="email">Email</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">@</div>
                        <input type="text" class="form-control" id="email" name="studentEmail" placeholder="userEmail">
                    </div>
                    <button class="btn btn-primary" onclick=uploadManually()><i class="fa fa-plus" aria-hidden="true"></i></button>

                </div>
<!--//ADD MANUALLY-->
                <br>
<!--ADD CSV-->

                <form id="upload_csv" method="post" enctype="multipart/form-data">
                     Or upload a csv file:
                    <input type="file" name="studentFile" id="csvStudentList" style="margin-top:15px;" />
                    <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-primary" />

                </form>
<!--// ADD CSV-->
                <br>
            </div>
        </center>
        <table>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>School</th>
                <th>Starting year</th>
                <th>Class</th>
                <th>Remove</th>
            </tr>
          
            </table>

    </div>


    <!-- jQuery first, then bootstrap js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.0.js"></script>
    <script>
        function uploadManually() {
            $.ajax({
                url: "studentToDTB.php",
                type: "post",
                dateType: "text",
                data: {
                    nameManually: $('#name').val(),
                    surNameManually: $('#surName').val(),
                    emailManually: $('#email').val()
                },
                success: function (result) {
                    alert(result),
                    $('#name').val(""),
                    $('#surName').val(""),
                    $('#email').val("")
                }
            })

        }

        $(document).ready(function(){
            $('#upload_csv').on("submit", function(e){

                e.preventDefault(); //form will not submitted
                $.ajax({
                    url:"studentbyCSV.php",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,          // The content type used when sending data to the server.
                    cache:false,                // To unable request pages to be cached
                    processData:false,          // To send DOMDocument or non processed data file it is set to false
                    success: function(data){

                            alert(data)
                        $('#csvStudentList').val("")

                    }
                })
            });
        });

    </script>

</body>

</html>
