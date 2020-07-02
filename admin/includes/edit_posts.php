<?php
  if(isset($_GET['p_id'])) {  
      $p_id = escape($_GET['p_id']);
    
    $query  = "SELECT * FROM posts WHERE post_id = {$p_id}";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
       while($rows = mysqli_fetch_assoc($result)){

           $post_id          = $rows['post_id'];
           $post_author      = $rows['post_author'];
           $post_title       = $rows['post_title'];
           $post_category_id = $rows['post_category_id'];
           $post_status      = $rows['post_status'];
           $post_image       = $rows['post_image'];
           $post_content     = $rows['post_content'];
           $post_tags        = $rows['post_tags'];
           $post_comment_count = $rows['post_comment_count'];
           $post_date        = $rows['post_date'];
         
       }
    }
}
    ?>
    
    
    
<form action="" method="post" enctype="multipart/form-data">    
     
      <div class="form-group">
         <label for="title">Edit Title</label>
          <input type="text" class="form-control" name="title" value="<?php echo $post_title; ?>">
      </div>

       <div class="form-group">
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
       </div>

<!--
       <div class="form-group">
       <label for="users">Users</label>
       <select name="post_user" id=""> </select>
      
       </div>
-->

       <div class="form-group">
         <label for="title">Post Author</label>
          <input type="text" class="form-control" name="author" value="<?php echo $post_author; ?>">
      </div> 
      
<!--
      <div class="form-group">
         <input type="text" class="form-control" name="post_status" id="" value="<?php echo $post_status; ?>">
             
      </div>
-->

       <div class="form-group">
         <select class="form-control" name="post_status" id="">
             <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
             
             <?
             if($post_status == 'Draft'){
                 echo '<option value="Published">Published</option>';
             }else{
                 echo '<option value="Draft">Draft</option>';
             }
        
             ?>
     
         </select>
      </div>
      
      
      
     <div class="form-group">
         <label for="post_image">Edit Image</label>
          <input  type="file"  name="king" >
          
      </div>

      <div class="form-group">
         <img width="100px" src="includes/uploads/<?php echo $post_image; ?>">
      </div>
      
      
      
    <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="body" cols="30" rows="6" ><?php echo $post_content; ?>
         </textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
      </div>


</form> 

<?php

if(isset($_POST['update_post'])){
    
   $post_title       = $_POST['title'];    
   $post_category_id = $_POST['post_category'];
   $post_author      = $_POST['author'];
   $post_status      = $_POST['post_status'];
    
   $post_image       = $_FILES['king']['name'];
   $post_image_temp  = $_FILES['king']['tmp_name'];
    
   $post_tags          = $_POST['post_tags'];
   $post_content       = $_POST['post_content'];
   $post_date          = time('d-m-y');

    
    move_uploaded_file($post_image_temp, "includes/uploads/$post_image");
    
        
        if(empty($post_image)) {
        
        $query_image = "SELECT * FROM posts WHERE post_id = $p_id ";
        $select_image = mysqli_query($conn, $query);
            
        while($row = mysqli_fetch_array($select_image)) {
            
           $post_image = $row['post_image'];
        
        }
        
        
}    
    
    
        
$query = "UPDATE posts SET post_category_id = {$post_category_id} , post_title = '{$post_title}' , post_author = '{$post_author}', post_date = now() , post_image = '{$post_image}',  post_content = '{$post_content}' , post_tags = '{$post_tags}', post_comment_count = {$post_comment_count}, 
post_status = '{$post_status}' WHERE post_id = {$p_id} ";

    
$result = mysqli_query($conn, $query);
    
    if($result){
           header('Location: posts.php');
        } else{
           echo "Error: ". mysqli_error($conn);
        }
    
    
}

?>




