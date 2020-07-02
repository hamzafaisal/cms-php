<?php include("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
   
    <!-- Navigation -->
<?php include("includes/nav.php"); ?>
<?php include("includes/timer.php"); ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
               
                      <h1 class="page-header">
                    CMS
                    <small>Posts</small>
                </h1>
                
                 <?php
                
                if(isset($_GET['id'])){
                    $id     = $_GET['id'];
                    $author = $_GET['author'];
                    
                    
                $query  = "SELECT * FROM posts WHERE post_author = $author ";
                $result = mysqli_query($conn, $query);
                    
                if(mysqli_num_rows($result) > 0 ){
                    while($rows = mysqli_fetch_assoc($result)){
                        
                         $post_title   = $rows['post_title'];
                         $post_author  = $rows['post_author'];
                         $post_date    = $rows['post_date'];
                         $post_image   = $rows['post_image'];
                         $post_content = $rows['post_content'];  
                         $post_views   = $rows['post_views'];
                 ?>   
         

                <h2>
                    <a href="#"><?php echo ucwords($post_title); ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php"><?php echo ucwords($post_author); ?></a>
                     <h6 class="text-muted">Post Views <?php echo $post_views; ?></h6>
                </p>
  <p><span class="glyphicon glyphicon-time"></span> <?php date_default_timezone_set("Asia/Karachi"); echo timer($post_date); ?></p>                <hr>
                <img class="img-responsive" src="admin/includes/uploads/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo ucwords($post_content); ?></p>
<!--                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>-->

                <hr>
          
                <?php 
                              
                    }
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

