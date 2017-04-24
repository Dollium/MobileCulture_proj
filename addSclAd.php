<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>

.form-inline .form-control {
display: table-cell!important;
width: 100%!important;
}

.user_log th.mobile {
  display:none;
}

table {
  width: 100%;
  border-collapse: collapse;
}
/* Zebra striping */
tr:nth-of-type(odd) {
  background: #eee;
}
th {
  background: #333;
  color: white;
  font-weight: bold;
}
td, th {
  padding: 6px;
  border: 1px solid #ccc;
  text-align: left;
}
.register tr, .register td
{
  background-color:transparent!important;
  border:0!important;
  max-width:100%;
}

@media only screen and (max-width: 760px){

  .form-inline
  {
    width:100%;
    margin: 0 10px 0 10px;
  }
  .register .mr-sm-2
  {
    margin-right: 0px!important;
  }

	.user_log table, .user_log thead, tbody, th, td, tr {
		display: block;
	}

	.user_log tr {
    border: 1px solid #ccc;
  }

	.user_log td {
		border: none;
		border-bottom: 1px solid #eee;
		position: relative;
		padding-left: 50%;
	}

	.user_log td:before {
		position: absolute;
		top: 6px;
		left: 6px;
		width: 45%;
		padding-right: 10px;
		white-space: nowrap;
	}
  .user_log th{
    display:none;
  }

  .user_log th.mobile
  {display:inline-block;
  width:100%;}

	/* Labels on td*/
	.user_log td:nth-of-type(1):before { content: "First Name"; }
	.user_log td:nth-of-type(2):before { content: "Last Name"; }
	.user_log td:nth-of-type(3):before { content: "Email"; }
	.user_log td:nth-of-type(4):before { content: "School"; }
  .user_log td:nth-of-type(5):before { content: "Remove"; }

}
    </style>
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
                            <a class="nav-link" href="admin.php">
                                <i class="fa fa-home" aria-hidden="true"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addSclAd.php">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Add school admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
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

        <div class="addSchool">
          <div class="row">
            <div class="form-inline">

            <table class="register">
              <tr>
                <td>

                  <form  method="POST" style="margin:auto;">
                  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="schoolID" id="schoolID">
                      <?php
                      $query = "SELECT school_id, Name FROM school";
                      $result = mysqli_query($conn, $query);
                      while($row = mysqli_fetch_array($result))
                      {
                         echo  "<option value=". $row["school_id"] .">".$row["Name"]."</option>";
                      }
                      ?>

                </select>

                </form>


            </td>

                  <td>
                <label class="sr-only" for="name">Name</label>
                <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="name" name="schoolName" placeholder="Name">
              </td>
                <td>
                <label class="sr-only" for="surName">Surname</label>
                <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="surName" name="schoolSurname" placeholder="Surname">
                </td>
                <td>
                <label class="sr-only" for="email">Email</label>
                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                    <div class="input-group-addon">@</div>
                    <input type="text" class="form-control" id="email" name="schoolEmail" placeholder="Useremail">
                    </td>
                </div>
                <td>
                <button type="submit" class="btn btn-primary" onclick=uploadManually()><i class="fa fa-plus" aria-hidden="true"></i></button>
                </td>
              </tr>
            </table>
            <?php

                    if (isset($_POST['schoolID']))
                    {
                      $_SESSION['schoolID'] = mysqli_real_escape_string($conn, ($_POST['schoolID']));

                    }

                      print_r($_SESSION);

                    ?>
            </div>
          </div>

            <br>
            <!--UPLOAD CSV FILE -->

            <form id="upload_csv" method="post" enctype="multipart/form-data">
                Or upload a csv file:
                <input type="file" name="SchoolFile" id="csvSchoolList" style="margin-top:15px;" />
                <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-primary" />

            </form>

            <!--//UPLOAD CSV FILE-->
            <br>
        </div>
        </center>
        <table class="user_log" style="overflow-x:auto; max-width:100%;">

          <tr>
              <th>Name</th>
              <th>Surname</th>
              <th>Email</th>
              <th>School</th>
              <th>Remove</th>
              <th class="mobile"> Registered users </th>
          </tr>
          <?php
          $sql = "SELECT * FROM user AS us INNER JOIN school AS scl ON us.user_id = scl.school_admin_id WHERE user_type_id = '1'";

          $result = $conn->query($sql);

          while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["First_name"]. " </td><td> " . $row["Last_name"]. "</td><td> " . $row["Email"]. "</td><td>" . $row["Name"]. "</td><td>" ?>
          <button type="submit" class="btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i></button> <?php echo "</td></tr>";
    } ?>
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
                url: "schoolToDTB.php", //EDIT THIS URL TO THE FILE HANDLE IMPORT TO DTB METHOD
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
        $(document).ready(function(){
            $('#upload_csv').on("submit", function(e){
                e.preventDefault(); //form will not submitted
                $.ajax({
                    url:"schoolbyCSV.php", //EDIT THIS URL TO THE FILE HANDLE IMPORT TO DTB METHOD
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,          // The content type used when sending data to the server.
                    cache:false,                // To unable request pages to be cached
                    processData:false,          // To send DOMDocument or non processed data file it is set to false
                    success: function(data){
                            alert(data)
                            $('#csvSchoolList').val("")
                    }
                })
            });
        });
        </script>
    </div>
</body>

</html>
