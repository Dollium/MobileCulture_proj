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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    #chart {
        width: 100%;
        min-height: 450px;
      }
      #smallerChart
      {
        width: 100%;
        min-height: 200px;
      }
      .row, .container
      {
        padding-left: 0!important;
        padding-right: 0!important;

      }
      .row{
        margin-right:0!important;
        margin-left:0!important;
      }
      #startDate, #endDate{
          border: 1px solid darkgray;
      }

        @media screen and (min-width: 992px) {
            #chart{
                display: flex;
            }
            div#smallerChart{
                display: none;
            }
        }
        @media screen and (max-width: 992px) {
            #chart{
                display: none;
            }
            #smallerChart{
                display: flex;
            }
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
    </style>
</head>

<body>
    <!--<div class="col-lg-8 container" style="background-color: #FFF;">-->
<div class="container-fluid">
  <div class="row">
    <div class="container">
      <div class="row">
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
                            <a class="nav-link" href="addSclAd.php">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Add school admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addstudent_resp.php">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Add student user
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addInst.php">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Add institution
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

        <br>
        <div class="row" style="max-width:100%;">
          <div class="col-sm-12">
<!--          <form>-->

                <label class="mr-sm-2" for="inlineFormCustomSelect">Show statistics by</label>
                <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="filterBy">
                  <option selected>School</option>
                  <option >Institution</option>
              </select>
                <br>
                <br>
                <input type="text" name="startDate" id="startDate">
                <input type="text" name="endDate" id="endDate">
                <br>
                <br>
                <button type="submit" class="btn btn-primary" id="getStatistic">Get the statistics</button>

<!--            </form>-->
          </div>
              <div class="col-sm-12">
            <br>

                <div id="chart">
<!--                    <div id="columnchart_material" style="width: 900px; height: 500px;">-->
<!---->
<!--                    </div>-->
<!--                    <div id="stacked_chart" style="width:100%; height:300px">-->
<!---->
<!--                    </div>-->
                </div>
                  <div id="smallerChart">

                  </div>


        </div>
      </div>
    </div>
  </div>
</div>




        <!-- jQuery first, then bootstrap js -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function(event) {
                $.getJSON("chartSchool.php", function(result){
                    window.schoolVisit = result;
//                    FORMAT THE DATA TYPE FOR THE CHART
                    var institution_ids = ["name","1", "2", "3", "4"]
                    window.chartData = schoolVisit.map(function(row) {
                        if (row === schoolVisit[0]) {
                            return row;
                        }
                        return institution_ids.map(function(id, index) {
                            if(index === 0) return row[0]
                            var result = row.find(function(col) {
                                return col.institution_id === id
                            })
                            return result ? Number(result.visit_number) : 0;
                        })
                    });
                });
//                    GET INSTITUTION CHART DATA BY DEFALT
                    $.getJSON("chartInsti.php", function(result){
                        window.institutionVisit = result;
                        institutionVisit = institutionVisit.map(function (row) {
                            if (row === institutionVisit[0]) {
                                return row;
                            }
                            return row.map(function (value, index) {
                                if(index===1)   {
                                    return  Number(value);
                                }
                                return value;
                            })
                        })
                        institutionVisit[0].push({ role: "style" });
                        institutionVisit[1].push("#4DD0E1");
                        institutionVisit[2].push("#AED581");
                        institutionVisit[3].push("#FFD54F");
                        institutionVisit[4].push("#A1887F");
                    });

                });
//            DEFAUTL CHART FOR SCHOOL
                google.charts.load('current', {
                    'packages': ['bar','corechart']
                });
                google.charts.setOnLoadCallback(drawSchoolChart);

                function drawSchoolChart() {
                    var data = google.visualization.arrayToDataTable(window.chartData);

                    var options = {
                        chart: {
                            title: 'Student visits record',
                            subtitle: 'Timespan: 6 months',
                        }
                    };

//                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                    var chart = new google.charts.Bar(document.getElementById('chart'));


                    chart.draw(data, options);
                }

                //DRAW SCHOOL SMALL CHART

                google.charts.setOnLoadCallback(drawSchoolSmallChart);

                // Callback that creates and populates a data table,
                // instantiates the pie chart, passes in the data and
                // draws it.
                function drawSchoolSmallChart() {
                    console.log(chartData);
                    // Create the data table.
                    var data = google.visualization.arrayToDataTable(chartData);

                    var options = {
                        legend: {
                            position: 'top',
                            maxLines: 4
                        },
                        bar: {
                            groupWidth: '75%'
                        },
                        fontSize: 12,
                        isStacked: true
                    };

                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.BarChart(document.getElementById('smallerChart'));
                    chart.draw(data, options);
                }


//              DRAW CHART TO USE FILTER
                $('#getStatistic').click(function() {

//               CHECK IF DRAW CHART BY DEFAULT 6 MONTHS
                    if($('#filterBy').val()=== "Institution"
                        && $('#startDate').val() ===''
                        && $('#endDate').val()==='') {

                            google.charts.setOnLoadCallback(drawInstiChart);
                        function drawInstiChart() {
                            var data = google.visualization.arrayToDataTable(institutionVisit);
//                            console.log('institution visit', institutionVisit);
                            var view = new google.visualization.DataView(data);
                            view.setColumns([0, 1,
                                { calc: "stringify",
                                    sourceColumn: 1,
                                    type: "string",
                                    role: "annotation" },
                                2]);

                            var options = {
                                title: "Institution visit for 6 months",
                                width: 700,
                                height: 400,
                                bar: {groupWidth: "95%"},
                                legend: { position: "none" },
                            };
                            var chart = new google.visualization.ColumnChart(document.getElementById("chart"));
                            chart.draw(view, options);
                        }
//                        DRAW INSTITUTION SMALL CHART
                        google.charts.setOnLoadCallback(drawInstiSmallChart);
                        function drawInstiSmallChart() {
                            var data = google.visualization.arrayToDataTable(institutionVisit);
//                            console.log('institution visit', institutionVisit);
                            var view = new google.visualization.DataView(data);
                            view.setColumns([0, 1,
                                { calc: "stringify",
                                    sourceColumn: 1,
                                    type: "string",
                                    role: "annotation" },
                                2]);

                            var options = {
                                title: "Institution visit for 6 months",
                                width: 300,
                                height: 350,
                                bar: {groupWidth: "95%"},
                                legend: { position: "none" },
                            };
                            var chart = new google.visualization.ColumnChart(document.getElementById("smallerChart"));
                            chart.draw(view, options);
                        }
                    }
//                    CHECK IF THE CHART IS FILTER BY TIME
                    else if($('#filterBy').val()=== "Institution"
                        && $('#startDate').val()!==''
                        && $('#endDate').val()!=='') {

                        $.ajax({
                            url: "chartInstiByTime.php", //EDIT THIS URL TO THE FILE HANDLE IMPORT TO DTB METHOD
                            type: "post",
                            dateType: "text",
                            data: {
                                startDate: $('#startDate').val() + ' 00:00:00',
                                endDate: $('#endDate').val() + ' 00:00:00'
                            },
                            success: function (result) {
                                window.institutionVisitByTime = JSON.parse(result);
                                console.log(institutionVisitByTime);
                                institutionVisitByTime = institutionVisitByTime.map(function (row) {
                                    if (row === institutionVisitByTime[0]) {
                                        return row;
                                    }
                                    return row.map(function (value, index) {
                                        if (index === 1) {
                                            if(value===null){
                                                return 0;
                                            }
                                            return Number(value);
                                        }
                                        return value;
                                    })
                                })

                                institutionVisitByTime[0].push({role: "style"});
                                institutionVisitByTime[1].push("#4DD0E1");
                                institutionVisitByTime[2].push("#AED581");
                                institutionVisitByTime[3].push("#FFD54F");
                                institutionVisitByTime[4].push("#A1887F");

                                google.charts.setOnLoadCallback(drawInstiByTimeChart);
                                function drawInstiByTimeChart() {
                                    var data = google.visualization.arrayToDataTable(institutionVisitByTime);
                                    var view = new google.visualization.DataView(data);
                                    view.setColumns([0, 1,
                                        {
                                            calc: "stringify",
                                            sourceColumn: 1,
                                            type: "string",
                                            role: "annotation"
                                        },
                                        2]);

                                    var options = {
                                        title: "Institution visit from " + $('#startDate').val() + " to " + $('#endDate').val(),
                                        width: 700,
                                        height: 400,
                                        bar: {groupWidth: "95%"},
                                        legend: {position: "none"},
                                    };
                                    var chart = new google.visualization.ColumnChart(document.getElementById("chart"));
                                    chart.draw(view, options);
                                }

//                                DRAW SMALLER CHART
                                google.charts.setOnLoadCallback(drawInstiByTimeSmallChart);
                                function drawInstiByTimeSmallChart() {
                                    var data = google.visualization.arrayToDataTable(institutionVisitByTime);
                                    var view = new google.visualization.DataView(data);
                                    view.setColumns([0, 1,
                                        {
                                            calc: "stringify",
                                            sourceColumn: 1,
                                            type: "string",
                                            role: "annotation"
                                        },
                                        2]);

                                    var options = {
                                        title: "Institution visit from " + $('#startDate').val() + " to " + $('#endDate').val(),
                                        width: 300,
                                        height: 350,
                                        bar: {groupWidth: "95%"},
                                        legend: {position: "none"},
                                    };
                                    var chart = new google.visualization.ColumnChart(document.getElementById("smallerChart"));
                                    chart.draw(view, options);
                                }

                            }

                        })
                    }
                    else if($('#filterBy').val()=== "School"
                        && $('#startDate').val() ===''
                        && $('#endDate').val()===''){
                        google.charts.setOnLoadCallback(drawSchoolChart);
                        google.charts.setOnLoadCallback(drawSchoolSmallChart);

                    }
                    else if($('#filterBy').val()=== "School"
                        && $('#startDate').val()!==''
                        && $('#endDate').val()!==''){
                        $.ajax({
                            url: "chartSchoolByTime.php", //EDIT THIS URL TO THE FILE HANDLE IMPORT TO DTB METHOD
                            type: "post",
                            dateType: "text",
                            data: {
                                startDate: $('#startDate').val() + ' 00:00:00',
                                endDate: $('#endDate').val() + ' 00:00:00'
                            },
                            success: function (result) {
                                console.log(result);
                                window.schoolVisitByTime = JSON.parse(result);
//                    FORMAT THE DATA TYPE FOR THE CHART
                                var institution_ids = ["name","1", "2", "3", "4"]
                                window.schoolVisitByTime = schoolVisitByTime.map(function(row) {
                                    if (row === schoolVisitByTime[0]) {
                                        return row;
                                    }
                                    return institution_ids.map(function(id, index) {
                                        if(index === 0) return row[0]
                                        var result = row.find(function(col) {
                                            return col.institution_id === id
                                        })
                                        return result ? Number(result.visit_number) : 0;
                                    })
                                });

                                google.charts.setOnLoadCallback(drawSchoolByTimeChart);
                                function drawSchoolByTimeChart() {
                                    var data = google.visualization.arrayToDataTable(window.schoolVisitByTime);

                                    var view = new google.visualization.DataView(data);

                                    var options = {
                                        chart: {
                                            title: 'Student visits record',
                                            subtitle: "Timespan: from " + $('#startDate').val() + " to " + $('#endDate').val(),
                                        }
                                    };
                                    var chart = new google.charts.Bar(document.getElementById('chart'));


                                    chart.draw(data, options);
                                }


                                google.charts.setOnLoadCallback(drawSchoolByTimeSmallChart);

                                // Callback that creates and populates a data table,
                                // instantiates the pie chart, passes in the data and
                                // draws it.
                                function drawSchoolByTimeSmallChart() {
                                    // Create the data table.
                                    var data = google.visualization.arrayToDataTable(window.schoolVisitByTime);

                                    var options = {
                                        legend: {
                                            position: 'top',
                                            maxLines: 4
                                        },
                                        bar: {
                                            groupWidth: '75%'
                                        },
                                        fontSize: 12,
                                        isStacked: true
                                    };

                                    // Instantiate and draw our chart, passing in some options.
                                    var chart = new google.visualization.BarChart(document.getElementById('smallerChart'));
                                    chart.draw(data, options);
                                }



                            }

                        })

                    }
                });
//            });

            $(document).ready(function() {
                $('#startDate').datepicker({ dateFormat: 'yy-mm-dd' });
                $('#endDate').datepicker({ dateFormat: 'yy-mm-dd' });
            })

    </script>
</body>

</html>
