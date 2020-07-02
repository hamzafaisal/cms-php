    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               
               
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <li class="active"><a class="navbar-brand" href="index.php">CMS System</a></li>
            </div>

               
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
      
                <?php
                    
                $query  = "SELECT * FROM category ";
                $result = mysqli_query($conn, $query);
                    
                if(mysqli_num_rows($result) > 0 ){ 
                    while($rows = mysqli_fetch_assoc($result)){
                        $cat_id    = $rows['cat_id'];
                        $cat_title = $rows['cat_title'];
                        
                        $active = '';
                        
                        $pagename = basename($_SERVER['PHP_SELF']);
                        
                        if(isset($_GET['category']) && $_GET['category'] == $cat_id ){
                            
                            $active = 'active';
                            
                        }
                        
                        echo "<li class='$active'><a href='category_post.php?category= $cat_id'>{$cat_title}</a></li>";
                        
                    }
                }
                ?>   
            
                    <li>
                        <a  href="admin/index.php">Admin</a>
                    </li>
                   
                     <?php
                    
                    if(isset($_SESSION['userrole'])){
                        if(isset($_GET['id'])){
                        $id = $_GET['id'];      
                            
                     echo "<li><a href='admin/posts.php?source=edit_posts&p_id={$id}'>Edit Post</a></li>";
                        }
                        
                    }
                    
                     ?>
                     
               </ul>
                    <ul class="nav navbar-nav pull-right">
                     <?php
                    
                    if(isset($_SESSION['userrole'])){
                    
                    ?>
     
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-fw fa-user"> </span> 
          
                    <?php echo  ucwords($_SESSION['username']);  ?> <b class="caret"></b></a>
                    
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="admin/includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                    </li>
                        
                    <?php
                        
                    }else{
                        
                    ?>
                    
                    
                    <li><span class="fa fa-fw fa-sign-in"></span><a  href="registration.php"> SignUp</a></li>
                    
                    <?php    
                    }
                    
                    ?>
                
                 </ul>
               
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>