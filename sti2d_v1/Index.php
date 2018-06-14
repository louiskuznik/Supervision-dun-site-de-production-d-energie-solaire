<!DOCTYPE html>
<html>
<head>
    <title>Supervision du panneau</title>
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
<div id="container" style="width:100%; height:400px;"></div>

<script type="text/javascript">
    $(document).ready(function(){
        var options ={
          chart: {
              renderTo: 'container',
              type: 'line',

          },
          title: {
            text: 'Energie toutes les minutes pendant les 2 dernières heures'
        },
          yAxis: {
            title: {
                text: 'Puissance (W)'
            }
        },
           series: [{
           }]
        };
        $.getJSON('data.php', function(data){
           options.series[0].data = data;
           var chart = new Highcharts.Chart(options);
        });
    });
</script>
</body>
</html>