             <?php
                 
             $session  = session_id();
             $time     = time();
             $time_sec = 60;
             $time_out = $time - $time_sec;
                
             $query = "SELECT * FROM users_online WHERE session = '$session' ";
             $result_online = mysqli_query($conn, $query);
             $count_online = mysqli_num_rows($result_online);
                
            if(!$result_online){
                echo mysqli_error($conn);
            }
                
                if($count_online == null){
                $query_non = "INSERT INTO users_online (session, date) VALUES('{$session}', '{$time}') ";
                $result_non = mysqli_query($conn, $query_non);
                    
                } else{
                $query_yes = "UPDATE users_online SET date = '{$time}'  WHERE session = '$session' ";
                $result_yes = mysqli_query($conn, $query_yes);
         
                }
                
               $query_time = "SELECT * FROM users_online WHERE date > '$time_out'   ";
               $result_time = mysqli_query($conn, $query_time);
                
                if(!$result_time){
                echo mysqli_error($conn);
                }
                   
               $count_users = mysqli_num_rows($result_time);
                   
            
             ?>       
                                          
                    
         <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand active" href="index.php">CMS Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
            
             <li><a href="">Users Online: <?php echo $count_users; ?> </a></li>
<!--             <li><a href="">Users Online:  <span class="useronline"></span> </a></li>-->
            
             <li ><a href="../index.php"><span  class="fa fa-fw fa-home"></span> Home</a></li>

                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-fw fa-user"> </span>                  
                    
                    <?php echo  ucwords($_SESSION['username']); ?> <b class="caret"></b></a>
                    
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                   
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts"><i class="fa fa-fw fa-twitter-square"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        
                        <ul id="posts" class="collapse">
                            <li>
                                <a href="posts.php"> View All Posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_posts"> Add Posts</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="categories.php"><i class="fa fa-fw fa-th-list"></i> Categories</a>
                    </li>
                    <li>
                        <a href="comments.php"><i class="fa fa-fw fa-comments"></i> Comments</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="users.php">View Users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_user">Add Users</a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href=""><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
