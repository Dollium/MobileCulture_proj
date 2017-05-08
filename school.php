<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
$ID = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>
    .alert
    {
      margin-bottom: 0!important;

    }
    .danger
    {
      border: 1px solid #d33f3f;
      background-color: rgba(247, 70, 70, 0.68);
    }
    .success
    {
      border: 1px solid #b4d6b4;
    background-color: #c2f1c2;
    }

    input#textSearch {
        width: 230px;
        box-sizing: border-box;
        border-top: 2px solid #ccc;
        border-right: 2px solid #ccc;
        border-left: 0;
        border-bottom: 2px solid #ccc;
        border-radius: 0px 4px 4px 0px;
        font-size: 16px;
        background-color: white;

        background-position: 10px 10px;
        background-repeat: no-repeat;
        padding: 7px 20px 7px 10px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    input#textSearch:focus {
        width: 100%;
        outline:none;
      }

      .search_icon
      {
        background-color:white!important;
        border-left: 2px solid #ccc!important;
        border-top: 2px solid #ccc!important;
        border-bottom: 2px solid #ccc!important;
      }
select#year
{
  width:130px;
}


.form-inline .form-control {
display: table-cell!important;
width: 100%!important;
}
td.mobile
{display:none;}
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
#delete
{
  color: #fff;
background-color: #0275d8;
border-color: #0275d8;
padding: 5px 10px;
border-radius: 5px;
}
.delete_form
{
  margin-left:150px;
}
.container-fluid{
  margin-left:0!important;
  margin-right:0!important;
}
@media only screen and (max-width: 992px){
.container-fluid
{
  padding-left:0!important;
  padding-right:0!important;
}
  .container
  {
    width:100%!important;
  }
}
@media only screen and (max-width: 760px){
  .checkbox
  {
    display:none;
  }
  .delete_form
  {
    display:none;
  }
  input#textSearch
  {
      width: 90%;
  }
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
	.user_log td:nth-of-type(2):before { content: "First Name"; }
	.user_log td:nth-of-type(3):before { content: "Surname"; }
	.user_log td:nth-of-type(4):before { content: "Email"; }
	.user_log td:nth-of-type(5):before { content: "School"; }
  .user_log td:nth-of-type(6):before { content: "Starting year"; }
  .user_log td:nth-of-type(7):before { content: "Remove"; }


  td.desktop
  {display:none;}
  td.mobile
  {display:block;}
}

    </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="container">


      <?php

      if($_SESSION["isSchool"] == true)
      {
        $ID = $_SESSION['id'];
      ?>
        <div class="row-fluid">

            <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary centered">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">Admin Page</a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">

                            <a class="nav-link" href="school.php">
                                  <i class="fa fa-home" aria-hidden="true"></i> Home
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="settings.php">
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


        <!-- /navbar -->
        <?php
        $sql = "SELECT * FROM school WHERE school_admin_id='$ID'";
        $result= mysqli_query($conn,$sql);
        $row = $result->fetch_assoc();
        $_SESSION['schoolID'] = $row['school_id'];
        $sID = $_SESSION['schoolID'];
         ?>
        <div class="addStudent">
          <!-- successes and errors for registration -->
          <?php if(!empty($_SESSION['success_registration']))
          {
          echo "<div class='alert success'>".$_SESSION['success_registration']."</div>"; ?> <?php
          unset($_SESSION['success_registration']);
          } ?>
          <?php if(!empty($_SESSION['email_taken']))
          {
          echo "<div class='alert danger'>".$_SESSION['email_taken']."</div>"; ?> <?php
          unset($_SESSION['email_taken']);
          } ?>
          <?php if(!empty($_SESSION['error']))
          {
          echo "<div class='alert danger'>".$_SESSION['error']."</div>"; ?> <?php
          unset($_SESSION['error']);
          } ?>

          <!-- successes and errors for deletion -->
            <?php if(!empty($_SESSION['delete_success']))
            {
            echo "<div class='alert success'>".$_SESSION['delete_success']."</div>"; ?> <?php
            unset($_SESSION['delete_success']);
            } ?>
            <?php if(!empty($_SESSION['delete_unsuccess']))
            {
            echo "<div class='alert danger'>".$_SESSION['delete_unsuccess']."</div>"; ?> <?php
            unset($_SESSION['delete_unsuccess']);
            } ?>
            <?php if(!empty($_SESSION['no_delete']))
            {
            echo "<div class='alert danger'>".$_SESSION['no_delete']."</div>"; ?> <?php
            unset($_SESSION['no_delete']);
            } ?>
          <div class="row">
            <div class="form-inline">
            <table class="register">
              <tr>
                  <td>

                    <form action="studentToDTB.php" method="POST">

                      <td>
                      <label class="sr-only" for="name">Name</label>
                      <input type="text" pattern="[a-zA-Z]+" class="form-control mb-2 mr-sm-2 mb-sm-0" id="name" name="name" placeholder="Name" required>
                      </td>
                      <td>
                      <label class="sr-only" for="surName">Surname</label>
                      <input type="text" pattern="[a-zA-Z]+" class="form-control mb-2 mr-sm-2 mb-sm-0" id="surName" name="surName" placeholder="Surname" required>
                      </td>
                      <td>
                      <label class="sr-only" for="year">Year</label>
                      <input type="number" class="form-control mb-2 mr-sm-2 mb-sm-0" id="year" name="year" placeholder="Starting year" required>
                      </td>
                      <td>
                      <label class="sr-only" for="email">Email</label>
                      <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                          <div class="input-group-addon">@</div>
                          <input type="text" class="form-control" id="email" name="email" placeholder="Useremail" required>
                          </td>
                      </div>
                      <td>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
                      </td>
                </form>
              </td>

              </tr>
            </table>
            </div>
          </div>


            <br>
            <!--UPLOAD CSV FILE -->

            <form action="studentbyCSV.php" method="post" enctype="multipart/form-data">
                 Or upload a csv file:
                <input type="file" name="studentFile" id="csvStudentList" style="margin-top:15px;" />
                <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-primary" />

            </form>

            <!--//UPLOAD CSV FILE-->
            <br>
        </div>
        <div class="row">
          <div class="col-lg-3">
          <form name="year" class="form-inline" method="post">
              <div class="text-sm-center">
                <select class="custom-select mb-2 mr-sm-2 mb-sm-0 year" name="year" id="year" onchange="this.form.submit();">
                    <?php
                    $query = "SELECT DISTINCT Starting_year FROM student WHERE school_id = '$sID' ORDER BY Starting_year DESC";
                    $result = mysqli_query($conn, $query);
                    echo "<option name='year' value=''> All </option>";
                    while($row = mysqli_fetch_array($result))
                    {
                       $selected = (isset($_POST['year']) && $_POST['year'] == $row['Starting_year']) ? ' selected="selected"' : '';
                       echo  "<option name='year' value=". $row["Starting_year"] ." ". $selected .">". $row["Starting_year"]."</option>";
                    }

                    ?>
                    <?php
                    if(isset($_POST['year']) && !empty($_POST['year']))
                    {
                      $_SESSION['selected_year'] = $_POST['year'];
                    }

                    $selectedY = $_SESSION['selected_year'];

                    ?>

              </select>
                </div>

              </form>
</div>
              <div class="col-lg-6">
                <form>
                  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                      <div class="input-group-addon search_icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                      <input type="text" name="search" id="textSearch" placeholder="Search" onkeyup="search()">
                      </td>
                  </div>
                </form>
              </div>


        </div>


        <form action="Delete.php" method="post">

          <!-- Button for checkbox deletion (clicking this will delete checked rows) -->
        <button type="submit" value="dltBox" name="dltBox" onclick="return deleteConfirm()" formaction="Delete.php" class="delete_button btn btn-primary">Delete selected records</button>

        <!-- Student list -->
          <table id="user_log" class="user_log" style="overflow-x:auto; max-width:100%;">
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>School</th>
                <th>Starting year</th>
                <th>Update</th>
                <th>Remove</th>
                <th class="mobile"> Registered users </th>
            </tr>


            <?php
            // Get students from database along with all required information
            if(isset($_POST['year']) && !empty($_POST['year']))
            {
            $sql = "SELECT us.user_id as userid, us.First_name as First_name, us.Last_name as Last_name, us.Email as Email, scl.Name as school_name, stu.Starting_year as Year
            FROM user AS us
            LEFT JOIN student AS stu ON stu.user_id = us.user_id
            LEFT JOIN school AS scl ON stu.school_id = scl.school_id
            WHERE user_type_id ='3'
            AND Starting_year = '$selectedY'
            AND scl.school_id = '$sID' ";

          }
          else {
            $sql = "SELECT us.user_id as userid, us.First_name as First_name, us.Last_name as Last_name, us.Email as Email, scl.Name as school_name, stu.Starting_year as Year
            FROM user AS us
            LEFT JOIN student AS stu ON stu.user_id = us.user_id
            LEFT JOIN school AS scl ON stu.school_id = scl.school_id
            WHERE user_type_id ='3'
            AND scl.school_id = '$sID' ";
}


            $result = $conn->query($sql);

            // Loop the results to make a table

            while($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
                              echo '<td class="checkbox"><input  type="checkbox" name="box[]" value='. $row['userid'] .'></td>';
                              echo "<td>" . $row['First_name'] . "</td>";
                              echo "<td>" . $row['Last_name'] . "</td>";
                              echo "<td>" . $row['Email'] . "</td>";
                              echo "<td>" . $row['school_name'] . "</td>";
                              echo "<td>" . $row['Year'] . "</td>";
                              echo "<td></td>";
                              echo '<td><a href="delete.php?did='. $row['userid'] .'" onclick="return deleteConfirm()" id="delete"><label for="delete"><i class="fa fa-times" aria-hidden="true"></i></label></a></td>';
                              echo "</tr>"; ?>




                <?php

              }

            ?>
        </table>
      </form>


<?php }
else{ ?>

                  <div class="row">

                      <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse bg-primary centered">
                          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
                          <a class="navbar-brand" href="#">Logo</a>

                          <div class="collapse navbar-collapse" id="navbarSupportedContent">




                          </div>
                            <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px;" href="index.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                      </nav>
                      <br>
                  </div>

                  <br>
                  <br>
                  <!-- /navbar -->
                  <div class="restrict"><?php echo "You are not authorized to access this page."; ?> </div>
                      <br>

                </div>
                </center>




          <?php
          }
          // print_r($_SESSION);
          ?>

    </div>


    <!-- jQuery first, then bootstrap js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.0.js"></script>

    <!-- jQuery first, then bootstrap js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.0.js"></script>

    <script>

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


        function search() {
          // Declare variables
          var input, filter, table, tr, td, i;
          input = document.getElementById("textSearch");
          filter = input.value.toUpperCase();
          table = document.getElementById("user_log");
          tr = table.getElementsByTagName("tr");

          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        }



    </script>

</body>

</html>
