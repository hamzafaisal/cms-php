<?php include("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
   
    <!-- Navigation -->
<?php include("includes/nav.php"); ?>

<?php 
 function timer($timestamp) {  
      $time_ago         = strtotime($timestamp);  
      $current_time     = time();  
      $time_difference  = $current_time - $time_ago;  
      $seconds          = $time_difference;  
      $minutes          = round($seconds / 60 );            // value 60 is seconds  
      $hours            = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
      $days             = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
      $weeks            = round($seconds / 604800);         // 7*24*60*60;  
      $months           = round($seconds / 2629440);        //((365+365+365+365+366)/5/12)*24*60*60  
      $years            = round($seconds / 31553280);       //(365+365+365+365+366)/5 * 24 * 60 * 60  
      if($seconds <= 60)  
      {  
     return "Just Now";  
   }  
      else if($minutes <=60)  
      {  
     if($minutes==1)  
           {  
       return "one minute ago";  
     }  
     else  
           {  
       return "$minutes minutes ago";  
     }  
   }  
      else if($hours <=24)  
      {  
     if($hours==1)  
           {  
       return "an hour ago";  
     }  
           else  
           {  
       return "$hours hrs ago";  
     }  
   }  
      else if($days <= 7)  
      {  
     if($days==1)  
           {  
       return "yesterday";  
     }  
           else  
           {  
       return "$days days ago";  
     }  
   }  
      else if($weeks <= 4.3) //4.3 == 52/12  
      {  
     if($weeks==1)  
           {  
       return "a week ago";  
     }  
           else  
           {  
       return "$weeks weeks ago";  
     }  
   }  
       else if($months <=12)  
      {  
     if($months==1)  
           {  
       return "a month ago";  
     }  
           else  
           {  
       return "$months months ago";  
     }  
   }  
      else  
      {  
     if($years==1)  
           {  
       return "one year ago";  
     }  
           else  
           {  
       return "$years years ago";  
     }  
   }  
 }     

 ?>


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
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
            
                } else{
                    $page = "";
                }
                
                if($page == 0 || $page == ""){
                    $value = 0;
                }else{
                    $value = ($page * 3) - 3;
                }
                
               if(isset($_SESSION['userrole']) && strtolower($_SESSION['userrole']) == 'admin' ){
                    
                $query_count  = "SELECT * FROM posts"; 

                }else{
                    
                $query_count  = "SELECT * FROM posts WHERE post_status = 'Published'";       
                }
                
               
//              $query_count  = "SELECT * FROM posts WHERE post_status = 'Published'";
                $result_count = mysqli_query($conn, $query_count);
                $count = mysqli_num_rows($result_count);
                
                $count = ceil(($count)/3);
                
                if(!$result_count){
                    echo mysqli_error($conn);
                }  
                    
                       
                
//                Which num, How Many    
                
                if(isset($_SESSION['userrole']) && strtolower($_SESSION['userrole']) == 'admin' ){
                    
                $query  = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $value,3"; 

                }else{
                    
                $query  = "SELECT * FROM posts WHERE post_status = 'Published' ORDER BY post_id DESC LIMIT $value,3"; 
   
                    
                }
                
//                $query  = "SELECT * FROM posts WHERE post_status = 'Published' ORDER BY post_id DESC LIMIT $value,3";               
                $result = mysqli_query($conn, $query);
                $count_post = mysqli_num_rows($result);
                
                if($count_post < 1){
                    echo "<div class='alert alert-warning text-center'>No Posts To Show</div>";
                }
                
                if(!$result){
                    echo mysqli_error($conn);
                }
                    
                if(mysqli_num_rows($result) > 0 ){
                    while($rows = mysqli_fetch_assoc($result)){
                        
                         $post_id      = $rows['post_id'];
                         $post_title   = $rows['post_title'];
                         $post_author  = $rows['post_author'];
                         $post_date    = $rows['post_date'];
                         $post_image   = $rows['post_image'];
                         $post_content = substr($rows['post_content'],0,100);
                         $post_status  = $rows['post_status'];
                         $post_views   = $rows['post_views'];
                      
                 ?>
                 
                <h2>
                    <a href="post.php?id=<?php echo $post_id; ?>">  <?php echo ucwords($post_title); ?> </a>
                </h2>
                <p class="lead">
                    By <a href="author_posts.php?author='<?php echo $post_author; ?>'&id=<?php echo $post_id;?>"><?php echo ucwords($post_author); ?></a>
                    <h6 class="text-muted">Post Views: <?php echo $post_views; ?>  (<?php echo $post_status; ?>)</h6>

                </p>
                      <p><span class="glyphicon glyphicon-time"></span> <?php 
                          date_default_timezone_set("Asia/Karachi");  
                          echo timer($post_date); ?></p>
                
                <hr>
                <a href="post.php?id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="admin/includes/uploads/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                
                <a class="btn btn-primary" href="post.php?id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
          
                <?php 
                              
                        
                }
                    }
     
                ?>   
                
            
            

            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include("includes/sidebar.php"); ?>


        </div>
        <!-- /.row -->

        <hr>
   
       <ul class="pager">
           <?php           
//            echo "<li class='page-item'><a class='page-link' href='index.php?page='>Previous</a></li>";
           
           for($i=1 ; $i <= $count ; $i++ ){
               
            if($i == $page){ 
               echo "<li class='link'><a style='background-color: #176ef1; color: white ' class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                
            }else{
               
            echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
            }
    
            }
           
//            echo "<li class='page-item'><a class='page-link' href='index.php?page='>Next</a></li>";
           
           ?>

       </ul>
        
        

        <!-- Footer -->
        
<?php include("includes/footer.php"); ?>






