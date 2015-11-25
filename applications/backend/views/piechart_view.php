<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Webrocom Codeigniter tutorial</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.33/example1/colorbox.min.css" rel="stylesheet"/>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.33/jquery.colorbox-min.js"></script>
        <style>#loader{display: none}</style>
         
    </head>
    <body>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<div id="container" style="width: 600px; height: 400px; margin: 0 auto"></div>
<?php print_r($yard); ?>
<script type="text/javascript">
$(function () {
    var yard = '<?php echo json_encode($yard);  ?>';
    var vessel = '<?php echo json_encode($vessel);  ?>';
    
    var total = '<?php echo json_encode($total);  ?>';
    var data2 = [];
    
    /*$.each(JSON.parse(total),function(key,v){
        //data2 =  JSON.parse(total);
        data2 = [{
            y:v.count,
            drilldown:{
                name:'inside',
                categories:[ v.vessels ],
                data:[ v.vessels ],
            }
        }];
    });*/
var v_names,v_counts = [];
for (var i = 0; i < total.length; i++) {
    var t = total[i].vessels;
    alert(total[i].y_name); 
    /*for(var j = 0;j < t.length;j++){
        //alert(t[j].v_name);    
        v_names.push(t[j].v_name);
        v_counts.push(t[j].v_count);
    }*/
    alert(v_names);
}

    console.log(data2);

        var colors = Highcharts.getOptions().colors,
            categories = ['Inside', 'External'],
        
            name = 'Attack sources',
            data = [{
                    y: 17.11,
                    color: colors[0],
                    drilldown: {
                        name: 'inside',
                        categories: ['login abuse', 'access voilation'],
                        data: [10.85, 7.35],
                        color: colors[0]
                    }
                },
                    {
                    y: 20,
                    color: colors[1],
                    drilldown: {
                        name: 'Outside',
                        categories: ['login abuse', 'access'],
                        data: [ 3,17],
                        color: colors[1]
                    }
                                
                }];
    
                console.log(data);
    

            // Build the data arrays
        var attacksource = [];
        var attacktype = [];
        var method_detect=[];
        var plaza = [];
        //alert(yard);
          
         $.each(JSON.parse(yard),function(k,v){

             attacksource.push({
                name: v.yard_name,
                y: parseInt(v.count)
             });
             p_yard = v.count;
          });
            
           plaza.push({
                name: "Plaza",
                y: 60,
                color:'green'
            });
         
        for (var i = 0; i < data.length; i++) {
    
            // add browser data
        
            // add version data
            for (var j = 0; j < data[i].drilldown.data.length; j++) {
                var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
                attacktype.push({
                    name: data[i].drilldown.categories[j],
                    y: data[i].drilldown.data[j],
                    color: Highcharts.Color(data[i].color).brighten(brightness).get()
                });
                
            }
        }
    
        // Create the chart
        $('#container').highcharts({
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Browser market share, April, 2011'
            },
            yAxis: {
                title: {
                    text: 'Total percent market share'
                }
            },
            plotOptions: {
                pie: {
                    shadow: false,
                    center: ['50%', '50%']
                }
            },
            tooltip: {
                valueSuffix: '%'
            },
            series: [{
                name: 'Plaza',
                data: plaza,
                size: '40%',
                dataLabels: {
                    formatter: function() {
                        return this.y > 5 ? this.point.name : null;
                    },
                    color: 'white',
                    distance: -30
                }
            },
            {
                name: 'Attacksource',
                data: attacksource,
                size: '60%',
                innerSize:'40%',
                dataLabels: {
                    formatter: function() {
                        return this.y > 5 ? this.point.name : null;
                    },
                    }
            }, {
                name: 'Attacktype',
                data: attacktype,
                size: '80%',
                innerSize: '60%',
                dataLabels: {
                    formatter: function() {
                        // display only if larger than 1
                        return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ this.y +'%'  : null;
                    }
                }
            }, {
                name: 'asdf',
                data: attacktype,
                size: '100%',
                innerSize: '80%',
                dataLabels: {
                    formatter: function() {
                        // display only if larger than 1
                        return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ this.y +'%'  : null;
                    }
                }
                         
            }]
        });
});

</script>
</body>
</html>