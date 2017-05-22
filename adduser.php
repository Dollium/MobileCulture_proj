<?php
include 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>
        .update_btn {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .update_btn + label {
            padding: 0 5px 0 8px;
            border-radius: 4px;
            font-size: 1.25em;
            font-weight: 700;
            color: white;
            background-color: #0050b0;
            display: inline-block;
        }
        .update_btn + label
        {
            cursor: pointer; /* "hand" cursor */
        }
        label:hover, label:active {
            color: #49515e;
            background-color: transparent;
        }
        .user_log td#edit input
        {
            width:100%;
        }
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
        .searchbar
        {
            padding-left:57px;
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
            text-align: right;
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
        @media only screen and (max-width: 822px){
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
            .user_log td:nth-of-type(2):before { content: "Etunimi"; }
            .user_log td:nth-of-type(3):before { content: "Sukunimi"; }
            .user_log td:nth-of-type(4):before { content: "Sähköposti"; }
            .user_log td:nth-of-type(5):before { content: "Koulu"; }
            .user_log td:nth-of-type(6):before { content: "Aloitusvuosi"; }
            .user_log td:nth-of-type(7):before { content: "Poista"; }


            td.desktop
            {display:none;}
            td.mobile
            {display:block;}
        }

    </style>
</head>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="container" style="background-color:#f3f3f5;">
            <?php
            // User access restriction
            if($_SESSION["isAdmin"] == true)
            {
                $_SESSION['schoolID'] = '1';
                ?>
                <div class="row">
                    <nav class="col-lg-12 navbar navbar-toggleable-md navbar-inverse centered admin">
                        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand" href="admin.php"><img src="img/Lahti_logo_nega_RGB_web.jpg" /></a>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="admin.php">
                                        <i class="fa fa-home" aria-hidden="true"></i> Etusivu
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="addSclAd.php">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i> Lisää koulu käyttäjä
                                    </a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="addstudent.php">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i> Lisää opiskelija
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="addInst.php">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i> Lisää instituutio
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="settings.php">
                                        <i class="fa fa-code" aria-hidden="true"></i> Asetukset
                                    </a>
                                </li>
                            </ul>
                            <a class="navbar-brand pull-sm-right mr-0" style="padding-right: 30px; padding-top:7px; font-size: 16px;" href="logout.php">Kirjaudu ulos &nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i>
                            </a>
                        </div>
                    </nav>

                    <div class="container bordered addStudent" style="background-color:#f3f3f5; padding-bottom: 50px;">
                        <br>
                        <?php
                        // successes and errors for registration

                        if(!empty($_SESSION['success_registration'])){
                            echo "<div class='alert success'>".$_SESSION['success_registration']."</div>"; ?> <?php
                            unset($_SESSION['success_registration']);
                        }

                        if(!empty($_SESSION['email_taken']))
                        {
                            echo "<div class='alert danger'>".$_SESSION['email_taken']."</div>"; ?> <?php
                            unset($_SESSION['email_taken']);
                        }

                        if(!empty($_SESSION['error']))
                        {
                            echo "<div class='alert danger'>".$_SESSION['error']."</div>"; ?> <?php
                            unset($_SESSION['error']);
                        }

                        if(!empty($_SESSION['format']))
                        {
                            echo "<div class='alert danger'>".$_SESSION['format']."</div>"; ?> <?php
                            unset($_SESSION['format']);
                        }


                        // Deletion success/error
                        if(!empty($_SESSION['delete_success']))
                        {
                            echo "<div class='alert success'>".$_SESSION['delete_success']."</div>"; ?> <?php
                            unset($_SESSION['delete_success']);
                        }

                        if(!empty($_SESSION['delete_unsuccess']))
                        {
                            echo "<div class='alert danger'>".$_SESSION['delete_unsuccess']."</div>"; ?> <?php
                            unset($_SESSION['delete_unsuccess']);
                        }

                        if(!empty($_SESSION['no_delete']))
                        {
                            echo "<div class='alert danger'>".$_SESSION['no_delete']."</div>"; ?> <?php
                            unset($_SESSION['no_delete']);
                        }
                        ?>


                        <div class="form-inline">
                            <form method="post" style="padding: 6px;margin-bottom:40px;">
                                <!-- Admin selects school which they want to see -->
                                <select class="custom-select mb-2 mr-sm-2 mb-sm-0 school" name="school" id="school" onchange="this.form.submit();">
                                    <?php
                                    $query = "SELECT Name, school_id FROM school";
                                    $result = mysqli_query($conn, $query);
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $selected = (isset($_POST['school']) && $_POST['school'] == $row['school_id']) ? ' selected="selected"' : '';
                                        echo  "<option name='school' value=". $row["school_id"] ." ". $selected .">". $row["Name"]."</option>";
                                    }

                                    ?>

                                </select>
                            </form>
                            <?php
                            if(isset($_POST['school']) && !empty($_POST['school']))
                            {
                                $_SESSION['schoolID'] = $_POST['school'];
                            }
                            $schoolID = $_SESSION['schoolID'];
                            ?>

                            <table class="register">
                                <tr>
                                    <form action="studentToDTB.php" method="POST">
                                        <td>
                                            <label class="sr-only" for="name">Nimi</label>
                                            <input type="text" pattern="[a-zåäöA-ZÅÄÖ]+" class="form-control mb-2 mr-sm-2 mb-sm-0" id="name" name="name" placeholder="Nimi" required>
                                        </td>
                                        <td>
                                            <label class="sr-only" for="surName">Sukunimi</label>
                                            <input type="text" pattern="[a-zåäöA-ZÅÄÖ]+" class="form-control mb-2 mr-sm-2 mb-sm-0" id="surName" name="surName" placeholder="Sukunimi" required>
                                        </td>
                                        <td>
                                            <label class="sr-only" for="year">Aloitusvuosi</label>
                                            <input type="number" class="form-control mb-2 mr-sm-2 mb-sm-0" id="year" name="year" placeholder="Aloitusvuosi" required>
                                        </td>
                                        <td>
                                            <label class="sr-only" for="email">Sähköposti</label>
                                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                <div class="input-group-addon">@</div>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Sähköposti" required>
                                        </td>
                        </div>
                        <td>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </td>
                        </form>
                        </tr>
                        </table>
                    </div>
                    <br>

                    <!--UPLOAD CSV FILE -->
                    <form action="studentbyCSV.php" method="post" enctype="multipart/form-data">
                        <table class="register">
                            <tr>
                                <td>
                                    <div class="col-lg-8">
                                        Tai lataa csv tiedosto:
                                        <input type="file" class="mb-2 mr-sm-2 mb-sm-0" name="studentFile" id="csvStudentList" style="margin-top:15px;" />
                                        <input type="submit" name="upload" id="upload" value="Lataa" style="margin-top:10px;" class="mb-2 mr-sm-2 mb-sm-0 btn btn-primary" />
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <br>

                    <!-- Search by email bar -->
                    <div class="row">

                        <div class="col-lg-5 offset-lg-2 col-md-9 col-sm-10 searchbar">
                            <form style="margin: 0 10px 0 10px;">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    <div class="input-group-addon search_icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                                    <input type="text" name="textSearch" id="textSearch" placeholder="Hae sähköpostia" onkeyup="search()">
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-2 offset-lg-3 offset-sm-0 col-sm-3 delete_form">
                            <form action="update.php" method="post">
                                <!-- Button for checkbox deletion (clicking this will delete checked rows) -->
                                <button type="submit" value="dltBox" name="dltBox" onclick="return deleteConfirm()" formaction="Delete.php" class="delete_button btn btn-primary">Poista valitut</button>

                        </div>
                    </div>
                    <!-- Student list -->
                    <table id="user_log" class="user_log" style="overflow-x:auto; max-width:1140px;">
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Nimi</th>
                            <th>Sukunimi</th>
                            <th>Sähköposti</th>
                            <th>Koulu</th>
                            <th>Aloitusvuosi</th>
                            <th>Päivitä</th>
                            <th>Poista</th>
                            <th class="mobile"> Rekisteröidyt käyttäjät </th>
                        </tr>


                        <?php
                        $_SESSION['currentShowingSchool'] = $schoolID;
                        // Get students from database along with all required information
                        $sql = "SELECT us.user_id as userid, us.First_name as First_name, us.Last_name as Last_name, us.Email as Email, scl.Name as school_name, scl.school_id as scl_id, stu.Starting_year as Year
              FROM user AS us
              LEFT JOIN student AS stu ON stu.user_id = us.user_id
              LEFT JOIN school AS scl ON stu.school_id = scl.school_id
              WHERE us.user_type_id ='3'
              AND scl.school_id = '$schoolID'
              ORDER BY stu.Starting_year DESC, us.Last_name ASC";

                        $result = $conn->query($sql);

                        // Loop the results to make a table
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo '<td class="checkbox"><input type="checkbox" name="box[]" value='. $row['userid'] .'></td>';
                            echo "<td>" . $row['First_name'] . "</td>";
                            echo "<td>" . $row['Last_name'] . "</td>";
                            echo "<td>" . $row['Email'] . "</td>";
                            echo "<td>" . $row['school_name'] . "</td>";
                            echo "<td>" . $row['Year'] . "</td>";
                            echo '<td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="updateStudentInfo('.$row['userid'].', event)"></i></label>'.

                                '</td>';
                            echo "<td>" . $row['Year'] . "</td>";
                            echo '<td><a href="Delete.php?did='. $row['userid'] .'" onclick="return deleteConfirm()" id="delete"><label for="delete"><i class="fa fa-times" aria-hidden="true"></i></label></a></td>';
                            echo "</tr>"; ?>

                            <?php
                        }
                        ?>
                    </table>
                    </form>
                </div>

            <?php }
            // Show to non-admin users
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
        </div>
        <?php } ?>
    </div>
</div>
</div>
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
        var result = confirm("Haluatko varmasti poistaa käyttäjät?");
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
            td = tr[i].getElementsByTagName("td")[3];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function updateStudentInfo(id, event){
        console.log(id);
        currentID = id;
        console.log('curent id',currentID);
//        console.log(event.target.parentNode.parentNode);
        $(event.target.parentNode.parentNode).html(
            '<td class="checkbox"><input type="checkbox" name="box[]" value='+currentID+'></td>' +
            '<td> <input type="text" pattern="[a-zåäöA-ZÅÄÖ]+" class="form-control mb-2 mr-sm-2 mb-sm-0" id="eName" name="name" placeholder="Nimi" required=""> </td>' +
            '<td><input type="text" pattern="[a-zåäöA-ZÅÄÖ]+" class="form-control mb-2 mr-sm-2 mb-sm-0" id="eSurName" name="surName" placeholder="Sukunimi" required=""></td>' +
            '<td><div class="input-group mb-2 mr-sm-2 mb-sm-0">'+
            '<div class="input-group-addon">@</div>'+
            '<input type="text" class="form-control" id="eEmail" name="email" placeholder="Sähköposti" required="">'+
            '</div></td>'+
            '<td>'+
            '<select class="custom-select mb-2 mr-sm-2 mb-sm-0 school" name="school" id="eSchool">'+
            '<option name="school" value="1">isthmus high school</option>' +
            '<option name="school" value="2">Tiirismaa high school</option>' +
            '<option name="school" value="3">Gulf of Lyceum</option>' +
            '<option name="school" value="4">Nastopolin high school</option>'+
            '</select>'+
            '</td>'+
            '<td><input type="number" class="form-control mb-2 mr-sm-2 mb-sm-0" id="eYear" name="year" placeholder="Aloitusvuosi" required=""></td>'+
            '<td><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="newStudentInfoToDtb(event, currentID)"></i>'+
            '</td>');
    }
    function newStudentInfoToDtb(e, currentID) {
//        console.log($('#eName').val());
//        console.log($('#eSurName').val());
//        console.log($('#eEmail').val());
//        console.log($('#eSchool').val());
//        console.log($('#eYear').val());

        console.log('current ID',currentID);
        $.ajax({
            url: "userEditting.php",
            type: "post",
            dateType: "text",
            data: {
                eName: $('#eName').val(),
                eSurName: $('#eSurName').val(),
                eEmail: $('#eEmail').val(),
                eSchool: $('#eSchool').val(),
                eYear: $('#eYear').val(),
                eID: currentID
            },
            success: function (result) {
                console.log(result);
                $('#user_log').html(result);

            }
        });
    }

</script>

</body>

</html>
