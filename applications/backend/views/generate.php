<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create simple website using codeigniter</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <!-- Latest compiled and minified Jquery library -->
        <script src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
 
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
     
<body>
    <div class="container">
        <div class="row clearfix">
        <div class="col-md-12 column">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="<?php echo base_url() ?>">CodeIgniter integration with php excel</a>
                </div>
                            <ul class="nav navbar-nav pull-right">
                                <li class="active"><a href="<?php echo base_url()?>backend.php/generate/excel"><i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;Export Excel</a></li>
                            </ul>
                 
                 
                 
            </nav>
        </div>
    </div>
         
    </div>    
 
<div class="container">
    <table style="width: 100%">
        <thead><th>S N</th><th>Country code</th><th>Country name</th></thead>
    <tbody>
    <?php foreach ($rs->result() as $row): ?>
     
        <tr><td><?php echo $row->id?></td><td><?php echo $row->country_code ?></td><td><?php echo $row->country_name?></td></tr>
     
    <?php endforeach; ?>
    </tbody>
        </table>
</div>
 
 
</body>
</html>