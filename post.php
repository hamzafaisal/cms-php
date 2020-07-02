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
                
                 <?php
                
                if(isset($_GET['id'])){
                 $id = $_GET['id'];
                    
                $query_view  = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = $id";
                $result_view = mysqli_query($conn, $query_view);  
                    if($result_view){
//                    echo 'ee';
                }else{
                    echo mysqli_error($conn);
                }
                    
                $query  = "SELECT * FROM posts WHERE post_id = $id ";
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
                                 

                <h1 class="page-header">
                    CMS
                    <small>Posts</small>
                </h1>

                <h2>
                    <a href="#"><?php echo ucwords($post_title); ?></a>
                </h2>
                <p class="lead">
                  By <a href="index.php"><?php echo ucwords($post_author); ?></a>
                     <h6 class="text-muted">Post Views <?php echo $post_views; ?></h6>

                </p>
                
                <p><span class="glyphicon glyphicon-time"></span> <?php date_default_timezone_set("Asia/Karachi"); echo timer($post_date); ?></p>
                <hr>
                <img class="img-responsive" src="admin/includes/uploads/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo ucwords($post_content); ?></p>
<!--                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>-->

                <hr>
          
                <?php 
                              
                    }
                }
                } else{
                    
                    header('Location: index.php');
                }
                ?>   
                
                
                
                <!-- Blog Comments -->
                <?php
                if(isset($_POST['create_comment'])){
                    $post_id = escape($_GET['id']);
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    
                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)
                         VALUES($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now() ) ";
                $result = mysqli_query($conn, $query);
                    
                if($result){
                    
                    header("Location: post.php?id={$post_id} ");
                }
                    
                    
//                
//                $query_count = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id "; 
//                $result_count = mysqli_query($conn, $query_count);
//                    
//                    
                }
                
                
                ?>              
                
                

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" action=" ">
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" class="form-control" name="comment_author" required>
                        </div>
                         <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="comment_email" required>
                        </div>
                         <label for="author">Comment:</label>
                        <textarea name="comment_content" id="" cols="50" rows="4" class="form-control" required></textarea><br>
                        
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                
                <?php
                
                $query = "SELECT * FROM comments WHERE comment_post_id = {$id} AND comment_status = 'approve' ORDER BY comment_id DESC";
                $result_comment = mysqli_query($conn, $query);
                
                if($result_comment){
//                    echo 'ee';
                }else{
                    echo mysqli_error($conn);
                }
                
                while($rows = mysqli_fetch_assoc($result_comment)){

                    $comment_author  = ucwords($rows['comment_author']);
                    $comment_date    = $rows['comment_date'];
                    $comment_content = ucwords($rows['comment_content']);
            
                ?>  
                
                

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small> <?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                
                
                <?php } ?>

                <!-- Comment -->
               

            
            

            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include("includes/sidebar.php"); ?>


        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        
<?php include("includes/footer.php"); ?>






