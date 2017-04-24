<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>

<html>

<head>
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
                <a class="navbar-brand" href="#">Admin Page</a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="adminHomePage.html">
                                <i class="fa fa-home" aria-hidden="true"></i> Home
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="addTeacher.html">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Add Teacher
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
        <!-- /navbar -->

        <div class="addTeacher">

            <div class="form-inline">
                <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="school">
                    <option selected>School1</option>
                    <option value="1">School2</option>
                    <option value="2">School3</option>
              </select>
                <label class="sr-only" for="name">Name</label>
                <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="name" name="teacherName" placeholder="Name">

                <label class="sr-only" for="surName">Surname</label>
                <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="surName" name="teacherSurname" placeholder="SurName">

                <label class="sr-only" for="email">Email</label>
                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                    <div class="input-group-addon">@</div>
                    <input type="text" class="form-control" id="email" name="teacherEmail" placeholder="Useremail">
                </div>
                <button type="submit" class="btn btn-primary" onclick=uploadManually()><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>

            <br>
            <!--UPLOAD CSV FILE -->

            <form id="upload_csv" method="post" enctype="multipart/form-data">
                Or upload a csv file:
                <input type="file" name="studentFile" style="margin-top:15px;" />
                <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-primary" />

            </form>

            <!--//UPLOAD CSV FILE-->
            <br>
        </div>
        </center>
        <table>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>School</th>
                <th>Remove</th>
            </tr>
            <tr>
                <td>Antti</td>
                <td>Salopuro</td>
                <td>my.nguyen@student.lamk.fi</td>
                <td>Lahti High School</td>
                <td>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i></button>
                </td>


            </tr>
            <tr>
                <td>Anh Mai</td>
                <td> Vo Nguyen</td>
                <td>my.nguyen@student.lamk.fi</td>
                <td>Lahti High School</td>
                <td>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i></button>
                </td>
            </tr>
            <tr>
                <td>Zozo</td>
                <td>Nguyen</td>
                <td>my.nguyen@student.lamk.fi</td>
                <td>Lahti High School</td>
                <td>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i></button>
                </td>
            </tr>
            <tr>
                <td>Andrei</td>
                <td> Misuka</td>
                <td>my.nguyen@student.lamk.fi</td>
                <td>Lahti High School</td>
                <td>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i></button>
                </td>
            </tr>
            <tr>
                <td>Aki</td>
                <td>Vaino</td>
                <td>my.nguyen@student.lamk.fi</td>
                <td>Lahti High School</td>
                <td>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i></button>
                </td>
            </tr>
            <tr>
                <td>Hamid</td>
                <td>Guedra</td>
                <td>my.nguyen@student.lamk.fi</td>
                <td>Lahti High School</td>
                <td>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i></button>
                </td>
            </tr>
        </table>



        <!-- jQuery first, then bootstrap js -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.0.js"></script>

        <script>
            function uploadManually() {
                $.ajax({
                    url: "SOMETHINGCOMEHER.php", //EDIT THIS URL TO THE FILE HANDLE IMPORT TO DTB METHOD
                    type: "post",
                    dateType: "text",
                    data: {
                        schoolManually: $('#school').val(),
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

            (document).ready(function(){
                $('#upload_csv').on("submit", function(e){

                    e.preventDefault(); //form will not submitted
                    $.ajax({
                        url:"teacherbyCSV.php",
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
    </div>
</body>

</html>
