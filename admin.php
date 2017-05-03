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
    .columnchart_material {
        width: 100%;
        min-height: 450px;
      }
      .stacked_chart
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

        @media screen and (min-width: 992px) {
            #columnchart_material{
                display: flex;
            }
            div#stacked_chart{
                display: none;
            }
        }
        @media screen and (max-width: 992px) {
            #columnchart_material{
                display: none;
            }
            #stacked_chart{
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
                        <li class="nav-item active">
                            <a class="nav-link" href="adminHomePage.php">
                                <i class="fa fa-home" aria-hidden="true"></i> Home <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
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
        <div class="row" style="max-width:100%;">
          <div class="col-sm-12">
          <form>

                <label class="mr-sm-2" for="inlineFormCustomSelect">Show statistics by</label>
                <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect">
                  <option value="school" selected>School</option>
                  <option value="institution">Institution</option>
                  <option value="Timespan">Timespan</option>
              </select>
                <br>
                <br>
                <input type="text" name="startDate" id="startDate"> <input type="text" name="endDate" id="endDate">
                <button type="submit" class="btn btn-primary">Get the statistics</button>

            </form>
          </div>
              <div class="col-sm-12">
            <br>
                <center>
                    <div id="columnchart_material" style="width: 900px; height: 500px;"></div>

                </center>
                <div id="stacked_chart" style="width:100%; height:300px">

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
                $.getJSON("chart.php", function(result){
                    window.schoolVisit = result;

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
                            return result ? Number(result.visit_number) : 0
                        })
                    });
                    console.log(chartData);

                });
                google.charts.load('current', {
                    'packages': ['bar','corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable(window.chartData);

                    var options = {
                        chart: {
                            title: 'Student visits record',
                            subtitle: 'Timespan: 16/9/2017-16/03/2017',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, options);
                }

                //DRAW STACKED CHART

                google.charts.setOnLoadCallback(drawStackedChart);

                // Callback that creates and populates a data table,
                // instantiates the pie chart, passes in the data and
                // draws it.
                function drawStackedChart() {
                    console.log(chartData);
                    // Create the data table.
                    var data = google.visualization.arrayToDataTable(chartData
    //                    [
    //                    ['School', 'Museumm', 'Cinemammmmmmmm', 'City Symphonyyyy', 'City Theateraaaaaa'],
    //                    ['School1', 1000, 400, 200, 247],
    //                    ['School2', 1170, 460, 250, 240],
    //                    ['School3', 660, 1120, 300, 230]
    //                ]
                    );

                    var options = {
    //                width: 900,
    //                height: 1900,
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
                    var chart = new google.visualization.BarChart(document.getElementById('stacked_chart'));
                    chart.draw(data, options);
                }
            });
            $(document).ready(function() {
                $('#startDate').datepicker();
                $('#endDate').datepicker();
            })

            $(window).resize(function(){
            drawChart();
            drawStackedChart();
          });
    </script>
</body>

</html>
