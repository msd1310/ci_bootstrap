        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php?action=home">ISHA Foundation</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                   <?php echo 'Howdy'; ?>
                <!-- /.dropdown -->

                <!-- /.dropdown -->

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">

                        <li><a href="<?php echo Config::get('PROJECT_URL').'index.php?action=logout'; ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

							 <li>
                            <a href="index.php?action=trainer&idd=<?php ?>"><i class="fa fa-dashboard fa-fw"></i> My Info</a>
                        </li>


                        <li>
                            <a href="index.php?action=ulist"><i class="fa fa-dashboard fa-fw"></i> User List</a>
                        </li>

                        <li>
                            <a href="index.php?action=olist"><i class="fa fa-dashboard fa-fw"></i> Organisation List</a>
                        </li>

                        <li>
                            <a href="index.php?action=tlist"><i class="fa fa-dashboard fa-fw"></i> Trainer List</a>
                        </li>
                      
                        <li>
                            <a href="index.php?action=plist"><i class="fa fa-dashboard fa-fw"></i> Participant List</a>
                        </li>


            <!-- /.navbar-static-side -->
        </nav>
