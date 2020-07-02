            <div class="col-md-4">
            
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="search"  class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                                        
                                           
                <?php
                
                   
               if(isset($_SESSION['userrole']) && strtolower($_SESSION['userrole']) == 'admin' ){
                   
                   
               }else{
                   
                 ?>
    
                    <div class="well">
                    <h4>Login</h4>
                    
                                               
                <?php
                if(isset($_GET['notadmin'])){
                 echo "<div class='alert alert-warning text-center'>Wrong E-Mail Or Password!</div>";
                }
                
                ?>
                   
                   
                                 
                    <form action="includes/login.php" method="post">
                    
                    <div class="form-group">
                    <input name="username" type="text"  class="form-control" placeholder="Enter Username" required>
                    </div>
                                 
                    <div class="input-group">
                    
                    <input name="password" type="password"  class="form-control" placeholder="Enter Password" required>
                    <span class="input-group-btn">
                        <button name="submit" class="btn btn-default" type="submit">Submit</button>
                    </span>
                </div>

                    
                    </form>
                    <!-- /.input-group -->
                    
                </div>
              
                <?php       
               
                }
                
          
                ?>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    

                    
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                
                        <?php

                        $query  = "SELECT * FROM category";
                        $result = mysqli_query($conn, $query);

                        if(mysqli_num_rows($result) > 0 ){
                            while($rows = mysqli_fetch_assoc($result)){

                                $cat_title = $rows['cat_title'];
                                $cat_id    = $rows['cat_id'];

                                echo "<li><a href='category_post.php?category= $cat_id'> $cat_title</a></li>";

                            }
                        }  

                        ?>   
                           
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
            
                     
                                       
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
           <?php include("includes/widget.php"); ?>


            </div>
            
           
          
         
        
       