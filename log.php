<?php
include 'config.php';
session_start();

$ID = $_SESSION['id'];
$_SESSION['inst_filt'] = '';
// print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <title>Logi</title>

</head>

<body>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="container" style="background-color:#f3f3f5;">
        <?php if($_SESSION["isStudent"] == true)
        { ?>
        <div class="row">
            <!-- NAV -->
            <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse centered">
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <a class="navbar-brand" href="student.php"><img src="img/Lahti_logo_nega_RGB_web.jpg" /></a>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="student.php">
                      <i class="fa fa-home" aria-hidden="true"></i> Profiili <span class="sr-only">(current)</span>
                    </a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="log.php">
                      <i class="fa fa-user-circle-o" aria-hidden="true"></i> Logi
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="settings.php">
                      <i class="fa fa-cog" aria-hidden="true"></i> Asetukset
                    </a>
                  </li>
                </ul>
                <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px; padding-top:7px; font-size: 16px;" href="logout.php">Kirjaudu ulos &nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i></a>
              </div>
            </nav>
            <br>
        </div>
      </div>
        <!-- /NAV -->
      <div class="col-md-12 col-sm-12 banner_image">
      </div>
        <!-- INSTITUTION  LIST-->
      <div class="container bordered" style="background-color: #f3f3f5;">
        <div class="wrapper log_height">
          <div class="box-code">
              <br/>
            <?php if(!empty($_SESSION['code_success']))
            {
            echo "<div class='alert success'>".$_SESSION['code_success']."</div>";
            unset($_SESSION['code_success']);
            }

            if(!empty($_SESSION['wrong_code']))
            {
            echo "<div class='alert danger'>".$_SESSION['wrong_code']."</div>";
            unset($_SESSION['wrong_code']);
            }

             if(!empty($_SESSION['insert_code']))
            {
            echo "<div class='alert danger'>".$_SESSION['insert_code']."</div>";
            unset($_SESSION['insert_code']);
            }
            ?>
          <br/>
            <h4>Kirjaa käyntisi syöttämällä koodi</h4 >
            <form method="POST" id="formCode" action="studentVisitRecord.php">
                <input type="text" placeholder="Syötä koodi" class="data-input" id="institutionCode" name="institutionCode">
                <button class="btn btn-primary">Kirjaa</button>
             </form>
        	</div>
          <form name="inst" class="form-inline filter_by_inst" method="post" action="log.php">
              <div class="text-sm-center">
                <select class="custom-select mb-2 mr-sm-2 mb-sm-0 institution" name="institution" id="institution" onchange="this.form.submit();">

                        <?php
                        $query = "SELECT Name, institution_id FROM institution";
                        $result = mysqli_query($conn, $query);
                        echo "<option name='institution' value=''> Kaikki </option>";
                        while($row = mysqli_fetch_array($result))
                        {
                           $selected = (isset($_POST['institution']) && $_POST['institution']  == $row['institution_id']) ? ' selected="selected"' : '';
                           echo  "<option name='institution' value=". $row["institution_id"] ." ". $selected .">".$row["Name"]."</option>";
                        }
                        ?>

                </select>
              </div>
          </form>

          <?php
          if(isset($_POST['institution']) && !empty($_POST['institution']))
          {
            $_SESSION['inst_filt'] = $_POST['institution'];
          }

          if(isset($_POST['institution']) && empty($_POST['institution']))
          {
              $_SESSION['inst_filt'] = '';
          }
          $inst_filt = $_SESSION['inst_filt'];
          ?>

          <!-- INSTITUTION LIST -->
          <div class="logTable">
            <table>
              <tr>
                <th>Kulttuurilaitos</th>
                <th>Päivämäärä</th>
              </tr>
              <?php

              if(isset($_SESSION['inst_filt']) && ($_SESSION['inst_filt'] != ''))
              {

                $sql = "SELECT vi.time as visit_time, ins.Name as name, vi.user_id as id
                FROM user as us
                LEFT JOIN student_visits AS vi ON vi.user_id = us.user_id
                LEFT JOIN institution AS ins ON ins.institution_id = vi.institution_id
                WHERE vi.user_id = '$ID'
                AND vi.institution_id ='$inst_filt'
                ORDER BY visit_time DESC";
              }
                else {
                  $sql = "SELECT vi.time as visit_time, ins.Name as name, vi.user_id as id
                  FROM user as us
                  LEFT JOIN student_visits AS vi ON vi.user_id = us.user_id
                  LEFT JOIN institution AS ins ON ins.institution_id = vi.institution_id
                  WHERE vi.user_id = '$ID'
                  ORDER BY visit_time DESC";
                }


              $result = $conn->query($sql);

              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["name"]. " </td><td> " . date('j.n.Y', strtotime($row["visit_time"])) . "</td></tr>";

              } ?>
            </table>
          </br></br>
        </div>
      </div>
      <div class="wrapper">
      <div class="row footer">
        <div class="col-lg-12" style="border-top:1px solid;">
          <div class="tooltipz"><i class="fa fa-question fa-2x" aria-hidden="true"></i></p>
            <span class="tooltiptextz">Rekisteröi laitokselta saamasi koodi ja kirjaa käynti logiisi.<br/>Voit myös suodattaa käyntejä kohteiden mukaan.</span>
          </div>
        </div>
      </div>
    </div>
    <?php
    }
    else { ?>
      <div class="row">
        <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse centered">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="/img/Lahti_logo_nega_RGB_web.jpg" /></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            </div>
            <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px;" href="index.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </nav>
        <br>
      </div>
      <br>
      <br>
      <!-- /navbar -->
      <div class="restrict"><?php echo "Sinulla ei ole oikeuksia katsella sivua."; ?> </div>
      <br>
      <?php
      }
      // print_r($_SESSION);
      ?>
    </div>
  </div>
</div>

    <!-- jQuery first, then bootstrap js -->

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>

</html>
