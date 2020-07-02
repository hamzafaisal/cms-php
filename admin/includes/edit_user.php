   <?php
  if(isset($_GET['id'])) {  
      $id = escape($_GET['id']);
    
    $query  = "SELECT * FROM users WHERE user_id = {$id}";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
       while($rows = mysqli_fetch_assoc($result)){

    
   $user_name         = $rows['user_name'];    
   $user_password     = $rows['user_password'];
   $user_firstname    = $rows['user_firstname'];
   $user_lastname     = $rows['user_lastname'];
    
//   $user_image       = $_FILES['image']['name'];
//   $user_image_temp  = $_FILES['image']['tmp_name'];
//    
    
   $user_email         = $rows['user_email'];
   $user_role          = $rows['user_role'];
//   $user_date          = time('d-m-y');
//    
//    move_uploaded_file($user_image_temp, "includes/uploads/$user_image");
//    
//    
//         
       }
    }
}
    ?>
    
    
    
    <form action="" method="post" enctype="multipart/form-data">    
     
      <div class="form-group">
         <label for="username">Edit Username</label>
          <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>">
      </div>

      
      <div class="form-group">
         <label for="password">Edit Password</label>
          <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
      </div>

      
      <div class="form-group">
         <label for="firstname">Edit First Name</label>
          <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
      </div>

      
      <div class="form-group">
         <label for="lastname">Edit Last Name</label>
          <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
      </div>

      
      <div class="form-group">
         <label for="email">Edit Email</label>
          <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
      </div>

<!--
      
       <div class="form-group ">
       <select class="form-control" name="post_category" id="">
           <?php

//            $query_edit  = "SELECT * FROM users";
//            $result_edit = mysqli_query($conn, $query_edit);
//
//                while($rows = mysqli_fetch_assoc($result_edit)){
//
//                    $user_id = $rows['user_id'];
//                    $user_role = $rows['user_role'];
//
//            echo "<option value='$user_id'>$user_role</option>";
//           
//                }
//           
           
           ?>
           
       </select>
       </div>
-->



       <div class="form-group">
       <label for="users">Users</label>
       
       <select class="form-control" name="user_role" id="">
       <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
       
       <?php
       if($user_role == 'Admin' ){
        echo '<option value="Subscriber">Subscriber</option>';

       } else{
        echo '<option value="Admin">Admin</option>';
       }
       ?>
 </select>
       </div>
      
      
    <div class="form-group">
         <label for="image">Edit Image</label>
          <input  type="file"  name="image">
    </div>
    
    
      <div class="form-group">
         <img width="100px" src="includes/uploads/<?php echo $post_image; ?>">
      </div>
      


       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
      </div>


</form> 
    
          
 

<?php

if(isset($_POST['edit_user'])){
    
   $user_name         = $_POST['user_name'];    
   $user_password     = $_POST['user_password'];
   $user_firstname    = $_POST['user_firstname'];
   $user_lastname     = $_POST['user_lastname'];
    
   $user_image       = $_FILES['image']['name'];
   $user_image_temp  = $_FILES['image']['tmp_name'];
    
    
   $user_email         = $_POST['user_email'];
   $user_role          = $_POST['user_role'];
//   $user_date          = time('d-m-y');
    
    move_uploaded_file($user_image_temp, "includes/uploads/$user_image");

    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);

    $query = "UPDATE users SET user_name = '{$user_name}' , user_password = '{$hash_password}' , user_firstname = '{$user_firstname}',    user_lastname = '{$user_lastname}' , user_email = '{$user_email}', user_role = '{$user_role}',  user_image = '{$user_image}'  WHERE user_id = {$id} ";

    
    $result = mysqli_query($conn, $query);
    if($result){
           header('Location: users.php?success');
        } else{
           echo "Error: ". mysqli_error($conn);
        }
    
    
}

?>




