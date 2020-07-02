<?php include('includes/modal.php'); ?>


<?php
if(isset($_POST['checkarray'])){
    
    foreach($_POST['checkarray'] as $checkbox){
        
        $bulkoption = $_POST['bulkoption'];
        
        switch($bulkoption){
        
            case 'Published':      
            $query      = "UPDATE posts SET post_status = 'Published' WHERE post_id = $checkbox " ;
            $result_pub =  mysqli_query($conn, $query);   
            break;
                
            case 'Draft':   
            $query      = "UPDATE posts SET post_status = 'Draft' WHERE post_id = $checkbox " ;
            $result_draft =  mysqli_query($conn, $query);
            break;
 
            case 'Delete':   
            $query      = "DELETE FROM posts WHERE post_id = $checkbox " ;
            $result_del =  mysqli_query($conn, $query);
            break;           
     
            case 'Clone': 
                   
            $query  = "SELECT * FROM posts WHERE post_id = $checkbox ";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0){
               while($rows = mysqli_fetch_assoc($result)){

                   $post_id          = $rows['post_id'];
                   $post_author      = $rows['post_author'];
                   $post_title       = ucwords($rows['post_title']);
                   $post_category_id = $rows['post_category_id'];
                   $post_status      = $rows['post_status'];
                   $post_image       = $rows['post_image'];
                   $post_tags        = $rows['post_tags'];
                   $post_content        = substr($rows['post_content'],0,80);

                   $post_comment_count = $rows['post_comment_count'];
                   $post_date        = $rows['post_date'];
  
               }
            }
 
                $query = "INSERT INTO posts (post_id ,post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES(NULL, {$post_category_id},'{$post_title}','{$post_author}', now() , '{$post_image}' ,'{$post_content}','{$post_tags}', '{$post_status}')";

                $result = mysqli_query($conn, $query);


                    if($result){
                           header('Location: posts.php');
                           echo "<div class='alert alert-success'>new entry in Database</div>";
                        } else{
                           echo "Error: ". mysqli_error($conn);
                        }  

                            break; 

        }
   
    }
    
}

?>                        
                        
                        <form action="" method="post">
                        
                        <table  class="table table-bordered table-hover table-striped">
                           
                           <div class="col-sm-4">
                               
                               <select class="form-control" name="bulkoption" id="bulk">
                                   
                                   <option value="">Select Option</option>
                                   <option value="Draft">Draft</option>
                                   <option value="Published">Publish</option>
                                   <option value="Delete">Delete</option>
                                   <option value="Clone">Clone</option>

                               </select>
                               
                           </div>
                               
                               <div class="col-sm-4">
                                   
                                   <input type="submit" class="btn btn-success" value="Apply" name="submit">
                                   <a class="btn btn-primary" href="posts.php?source=add_posts" role="button">Add Posts</a>
                               </div>
                 
                            
                                <thead >
                                   <tr>
                                    <th><input type="checkbox" id="selectall"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Content</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>View Post</th>
                                    <th>Posts Views</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                   
                                   <?php
                                     
                                    $query  = "SELECT * FROM posts";
                                    $result = mysqli_query($conn, $query);
                                    
                                    if(mysqli_num_rows($result) > 0){
                                       while($rows = mysqli_fetch_assoc($result)){
                                           
                                           $post_id          = $rows['post_id'];
                                           $post_author      = $rows['post_author'];
                                           $post_title       = ucwords($rows['post_title']);
                                           $post_category_id = $rows['post_category_id'];
                                           $post_status      = $rows['post_status'];
                                           $post_image       = $rows['post_image'];
                                           $post_tags        = $rows['post_tags'];
                                           $post_content        = substr($rows['post_content'],0,80);

                                           $post_comment_count = $rows['post_comment_count'];
                                           $post_date          = $rows['post_date'];
                                           $post_views         = $rows['post_views'];
                                           
                                           echo  "<tr>";
                                           
                                    ?>
                                     
                                    <td> <input type="checkbox" class="select" value="<?php echo $post_id; ?>" name="checkarray[]">   </td>      
                                           
                                    <?php
                                           
                                           echo  "<td>$post_id </td>";
                                           echo  "<td>$post_author</td>";
                                           echo  "<td>$post_title</td>";
                                           
                                           
                                $query_edit  = "SELECT * FROM category WHERE cat_id = {$post_category_id}";
                                $result_edit = mysqli_query($conn, $query_edit);

                                    while($rows = mysqli_fetch_assoc($result_edit)){
                                        $cat_title = $rows['cat_title'];

                                        echo "<td>$cat_title</td>";

                                    }

                     
                                           echo  "<td>$post_status</td>";
                                           echo  "<td><img class='img-responsive' width='100' src='includes/uploads/$post_image'</td>";
                                           echo  "<td>$post_tags</td>";
                                           echo  "<td>$post_content</td>";
                                           
                                  
                                        $query_com  = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
                                        $result_com = mysqli_query($conn, $query_com);
                                        $count_com  = mysqli_num_rows($result_com);
                                    
                                    
                                           echo  "<td>$count_com</td>";
                                           
                                           
                                           
                                           echo  "<td>$post_date</td>";
                                           echo  "<td><a href='../post.php?id={$post_id}'>{$post_title}</td>";
                                           echo  "<td>{$post_views}</td>";
                                           
//                                           echo  "<td><a onClick = \"javascript: return confirm('Are you sure you want to Delete :');\" href='posts.php?delete={$post_id}''>Delete</td>";  
                                           
                                           
                                           
                                           echo  "<td><a rel='{$post_id}' href='javascript:void(0)' class='del'>Delete</a></td>";
                                        
                                           echo  "<td><a  href='posts.php?source=edit_posts&p_id={$post_id}'>Edit</td>";
                        
                                           echo "</tr>";
                        
                                       }
                                    }
                                    
                                    ?>
                                    
                                    <?php
                                    
                                    if(isset($_GET['delete'])){
                                        
                                        if(isset($_SESSION['userrole'])){
                                            
                                            if(strtolower($_SESSION['userrole']) == 'admin'){
                                        
                                        $del_id = mysqli_real_escape_string($conn, $_GET['delete']);
                                        
                                        $query = "DELETE FROM posts WHERE post_id = {$del_id}";
                                        $result = mysqli_query($conn, $query);
                                        
                                        if($result){
                                            header('Location: posts.php');
                                            echo "<div class='alert alert-danger'>delete</div>";
                                        }
                                    }
                                    
                                    }
                                    }
                                    ?>
                                   
                                    
                                </tbody>
                                
                         
                        </table>
                        
                        
 <script>
  $(document).ready(function(){
      
     $(".del").on('click', function(){
         
      var id = $(this).attr('rel');
      
      var del_url = "posts.php?delete="+ id +" ";
         
        $(".del_link").attr("href",del_url);
         $("#modal").modal('show');
         
         
         
     });
      
      
  });                          
                                                   
</script>                       
        
                        
                        
                        
                        
                 
                        
                        
            