<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>Pie Chart Demo (Google VAPI) - http://codeofaninja.com/</title>
                <script type="text/javascript" src="http://www.google.com/jsapi"></script>

    </head>
    
    <style type="text/css">
.box {
    display:inline-block;
    margin:10px 0;
    border-radius:5px;
    width: 500px; height: 400px;
}
#container {
    white-space:nowrap;
    text-align:center;
}
    </style>
<body style="font-family: Arial;border: 0 none;">
    <!-- where the chart will be rendered -->
    <div class="container">
        <div class="col-lg-4 col-sm-4">
        <table class="table"><caption class="panel-heading">Yard Slots</caption>
        <thead><tr><th>Yard Name</tf><th>Slots</th></thead>
        <tbody>
        <?php 
            foreach ($data_yard as $yard) {?>
            <tr><td><?php echo $yard['name'];?></td><td><?php echo $yard['quantity'];?></td></tr>
        <?php }?>
        </tbody></table></div>
        <div id="visualization3" class="box"></div>
    <div id="visualization" class="box"></div>&nbsp;
    <div id="visualization2" class="box" style="width: 500px; height: 400px;"></div></div>
    
 <?php
 
    $num_results3 = count($result3);
    if( $num_results3 > 0){ 
    ?>
        <!-- load api -->
        
        <script type="text/javascript">
            //load package
            google.load('visualization', '1', {packages: ['corechart']});
        </script>
 
        <script type="text/javascript">
            function drawVisualization() {
                // Create and populate the data table.
                var data = google.visualization.arrayToDataTable([
                    ['name', 'slots'],
                    <?php
                    //while($row = $result->fetch_assoc() ){
                        
                    foreach($result3  as $row){
                        //extract($row);
                        $name = $row['name'] .'( '.$row['quantity'].' )';
                        echo "['{$name}', {$row['quantity']}],";
                       // echo "['{$name}', {$ratings}],";
                    }
                    ?>
                ]);
 
                 var options = {
                    title: 'yard and vehicles',
                    pieSliceText: 'value',
                    is3D: true,
                 };
                // Create and draw the visualization.
                new google.visualization.PieChart(document.getElementById('visualization3')).
                draw(data, options);
            }
 
            google.setOnLoadCallback(drawVisualization);
        </script>
    <?php
 
    }else{
        echo "No record found in the database.";
    }
    ?>
    <?php
 
	$num_results = $result->num_rows;
    if( $num_results > 0){ 
    ?>
        <!-- load api -->
        
        <script type="text/javascript">
            //load package                                      
            google.load('visualization', '1', {packages: ['corechart']});
        </script>
 
        <script type="text/javascript">
            function drawVisualization() {
                // Create and populate the data table.
                var data = google.visualization.arrayToDataTable([
                    ['name', 'slots'],
                    <?php
                    //while($row = $result->fetch_assoc() ){
						
					foreach($result->result_array() as $row){
                        extract($row);
						$name = $row['yard_name'] .'( '.$row['vessel_name'].' )';
						 echo "['{$name}', {$row['alloted_slot']}],";
                       // echo "['{$name}', {$ratings}],";
                    }
                    ?>
                ]);
 
                 var options = {
                    title: 'Yard and Vessel',
                    pieSliceText: 'value',
                    is3D: true,
                 };
                // Create and draw the visualization.
                new google.visualization.PieChart(document.getElementById('visualization')).
                draw(data, options);
            }
 
            google.setOnLoadCallback(drawVisualization);
        </script>
    <?php
 
    }else{
        echo "No record found in the database.";
    }
    ?>
	
	    <?php
 
    $num_results2 = $result2->num_rows;
    if( $num_results2 > 0){ 
    ?>
        <!-- load api -->
        
        <script type="text/javascript">
            //load package
            google.load('visualization', '1', {packages: ['corechart']});
        </script>
 
        <script type="text/javascript">
            function drawVisualization() {
                // Create and populate the data table.
                var data = google.visualization.arrayToDataTable([
                    ['name', 'slots'],
                    <?php
                    //while($row = $result->fetch_assoc() ){
                        
                    foreach($result2->result_array() as $row){
                        extract($row);
                        $name = $row['yard_name'] .'( '.$row['vessel_name'].' )';
                         echo "['{$name}', {$row['total']}],";
                       // echo "['{$name}', {$ratings}],";
                    }
                    ?>
                ]);
 
                 var options = {
                    title: 'vessel and Vehicles',
                    pieSliceText: 'value',
                    is3D: true,
                 };
                // Create and draw the visualization.
                new google.visualization.PieChart(document.getElementById('visualization2')).
                draw(data, options);
            }
 
            google.setOnLoadCallback(drawVisualization);
        </script>
    <?php
 
    }else{
        echo "No record found in the database.";
    }
    ?>

</body>
</html>