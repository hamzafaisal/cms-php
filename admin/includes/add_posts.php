<?php
if(isset($_POST['create_post'])){
    
   $post_title       = $_POST['title'];    
   $post_category_id = $_POST['post_category'];
   $post_author      = $_POST['author'];
   $post_status      = $_POST['post_status'];
    
   $post_image       = $_FILES['image']['name'];
   $post_image_temp  = $_FILES['image']['tmp_name'];
    
    
   $post_tags          = $_POST['post_tags'];
   $post_content       = $_POST['post_content'];
   $post_date          = time('d-m-y');
    
    move_uploaded_file($post_image_temp, "includes/uploads/$post_image");
    
    
$query = "INSERT INTO posts (post_id ,post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES(NULL, {$post_category_id},'{$post_title}','{$post_author}', now() , '{$post_image}' ,'{$post_content}','{$post_tags}', '{$post_status}')";
    
$result = mysqli_query($conn, $query);
    
    
    if($result){
           header('Location: posts.php');
           echo "<div class='alert alert-success'>new entry in Database</div>";
        } else{
           echo "Error: ". mysqli_error($conn);
        }




}

?>
    <form action="" method="post" enctype="multipart/form-data">    
     
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="title">
      </div>

      <br>
       <div class="form-inline">
       <label for="">Categories &nbsp;&nbsp;</label>
       <select class="form-control" name="post_category" id="">
           <?php

            $query_edit  = "SELECT * FROM category";
            $result_edit = mysqli_query($conn, $query_edit);

                while($rows = mysqli_fetch_assoc($result_edit)){

                    $cat_id = $rows['cat_id'];
                    $cat_title = $rows['cat_title'];

            echo "<option value='$cat_id'>$cat_title</option>";
           
                }
           
           
           ?>
           
       </select>
       </div><br>



<!--
       <div class="form-group">
       <label for="users">Users</label>
       <select name="post_user" id=""> </select>
      
       </div>
-->

       <div class="form-group">
         <label for="title">Post Author</label>
          <input type="text" class="form-control" name="author">
      </div> 
      
<!--
      <div class="form-group">
         <input type="text" class="form-control" name="post_status" id="">
             
      </div>
-->
<br>
       <div class="form-inline">
        <label for="">Post Status&nbsp;&nbsp; </label>
         <select class="form-control" name="post_status" id="">
             <option value="Draft">Post Status</option>
             <option value="Published">Published</option>
             <option value="Draft">Draft</option>
         </select>
      </div><br>
      
      
      <br>
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input  type="file"  name="image">
      </div><br>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="body" cols="30" rows="6">
         </textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form> 