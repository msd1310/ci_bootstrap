<html>
     <head>
          <title>Department Master</title>
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <!--link the bootstrap css file-->
          <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>">
     </head>
     <body>
          <div class="container">
            <div class="form-group">
            <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Insert" />

            </div>
            </div>
          <div class="row">
          <div class="col-lg-12 col-sm-12">
               <table class="table table-striped table-hover">
                    <thead>
                         <tr>
                              <th>#</th>
                              <th>Department Name</th>
                              <th>Head of Department</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php for ($i = 0; $i < count($deptlist); ++$i) { ?>
                              <tr>
                                   <td><?php echo ($i+1); ?></td>
                                   <td><?php echo $deptlist[$i]->noplate; ?></td>
                                   <td><?php echo $deptlist[$i]->var_emp_name; ?></td>
                              </tr>
                         <?php } ?>
                    </tbody>
               </table>
          </div>
          </div>
          </div>
     </body>
</html>
