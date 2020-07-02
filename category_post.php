<?php include("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
   
    <!-- Navigation -->
<?php include("includes/nav.php"); ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                 <?php
                
                if(isset($_GET['category'])){
                    $cat = $_GET['category'];
                    
                    
                $query  = "SELECT * FROM posts WHERE post_category_id = $cat ";
                $result = mysqli_query($conn, $query);
                    
                if(mysqli_num_rows($result) > 0 ){
                    while($rows = mysqli_fetch_assoc($result)){
                        
                         $post_id      = $rows['post_id'];
                         $post_title   = $rows['post_title'];
                         $post_author  = $rows['post_author'];
                         $post_date    = $rows['post_date'];
                         $post_image   = $rows['post_image'];
                         $post_content = $rows['post_content'];                        
                 ?>   
                                 

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <h2>
                    <a href="post.php?id=<?php echo $post_id; ?>">  <?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
          
                <?php 
                              
                    }
                }else{
                 
                    echo "<div class='alert alert-warning text-center'>No Posts To Show</div>";
                
                }
                }
                ?>   
                
            
            

            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include("includes/sidebar.php"); ?>


        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        
<?php include("includes/footer.php"); ?>






