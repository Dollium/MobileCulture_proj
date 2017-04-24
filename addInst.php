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
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Add institution
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
              <?php if(!empty($_SESSION['success_registration']))
              {
              ?>
              <div class="alert danger"></div>
              <?php
              echo $_SESSION['success_registration']; ?> <?php
              unset($_SESSION['success_registration']);
              } ?>
              <?php if(!empty($_SESSION['email_taken']))
              {
              ?>
              <div class="alert danger"></div>
              <?php
              echo $_SESSION['email_taken']; ?> <?php
              unset($_SESSION['email_taken']);
              } ?>

              <?php if(!empty($_SESSION['error']))
              {
              ?>
              <div class="alert danger"></div>
              <?php
              echo $_SESSION['error']; ?> <?php
              unset($_SESSION['error']);
              } ?>

            <table class="register">
              <tr>
		              <form  action="instToDTB.php" method="POST" style="margin:auto;">
                    <td>
                      <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="instID" id="instID">
                      <?php
                      $query = "SELECT institution_id, Name FROM institution";
                      $result = mysqli_query($conn, $query);
                      while($row = mysqli_fetch_array($result))
                      {
                         echo  "<option value=". $row["institution_id"] .">".$row["Name"]."</option>";
                      }
                      ?>
                      </select>
                    </td>
                    <td>
                      <label class="sr-only" for="email">Email</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon">@</div>
                            <input type="text" class="form-control" id="email" name="institutionEmail" placeholder="Email">

                        </div>
                    </td>
                    <td>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>

                </td>
                </form>
              </tr>
            </table>
            <?php

                    if (isset($_POST['instID']))
                    {
                      $_SESSION['instID'] = mysqli_real_escape_string($conn, ($_POST['instID']));
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
        <form action="Delete.php" method="post">

          <!-- Button for checkbox deletion (clicking this will delete checked rows) -->
        <button type="submit" value="dltBox" name="dltBox" onclick="return deleteConfirm()" formaction="Delete.php" class="delete_button btn btn-primary">Delete selected records</button>

        <table class="user_log" style="overflow-x:auto; max-width:100%;">

          <tr>
              <th><input type="checkbox" id="checkAll"></th>
              <th>Name</th>
              <th>Email</th>
              <th>Remove</th>
              <th class="mobile"> Registered users </th>
          </tr>
          <?php
          $sql = "SELECT * FROM user AS us LEFT JOIN institution AS scl ON us.user_id = scl.institution_user_id WHERE user_type_id = '4'";

          $result = $conn->query($sql);

          while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
                            echo '<td><input type="checkbox" name="box[]" value='. $row['user_id'] .'></td>';
                            echo "<td>" . $row['Name'] . "</td>";
                            echo "<td>" . $row['Email'] . "</td>";
                            echo '<td><a href="delete.php?did='. $row['user_id'] .'" onclick="return deleteConfirm()" id="delete"><label for="delete"><i class="fa fa-times" aria-hidden="true"></i></label></a></td>';
                            echo "</tr>"; ?>
<?php    } ?>
        </table>

    </form>









        <!-- jQuery first, then bootstrap js -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.0.js"></script>

        <script>

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


        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        function deleteConfirm(){
            var result = confirm("Are you sure to delete users?");
            if(result){
                return true;
            }else{
                return false;
            }
        }

        function deleteConfirm(){
            var result = confirm("Are you sure to delete users?");
            if(result){
                return true;
            }else{
                return false;
            }
        }
        </script>
    </div>
</body>

</html>
