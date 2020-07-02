

<?php
if(isset($_POST['add_user'])){
    
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
    
//    
    
$hash_password = password_hash($user_password, PASSWORD_DEFAULT);

$query = "INSERT INTO users (user_name ,user_password , user_firstname, user_lastname, user_email, user_role, user_image ) 
         VALUES( '{$user_name}','{$hash_password}', '{$user_firstname}' ,'{$user_lastname}','{$user_email}', '{$user_role}', '{$user_image}')";
    
$result = mysqli_query($conn, $query);
   
    if($result){
           header('Location: users.php');
        } else{
           echo "Error: ". mysqli_error($conn);
        }
}

?>
    <form action="" method="post" enctype="multipart/form-data">    
     
      <div class="form-group">
         <label for="username">Username</label>
          <input type="text" class="form-control" name="user_name">
      </div>

      
      <div class="form-group">
         <label for="password">User Password</label>
          <input type="password" class="form-control" name="user_password">
      </div>

      
      <div class="form-group">
         <label for="firstname">First Name</label>
          <input type="text" class="form-control" name="user_firstname">
      </div>

      
      <div class="form-group">
         <label for="lastname">Last Name</label>
          <input type="text" class="form-control" name="user_lastname">
      </div>

      
      <div class="form-group">
         <label for="email">Email</label>
          <input type="email" class="form-control" name="user_email">
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
       
       <option value="Subscriber">Subscriber</option>
       <option value="Admin">Admin</option>
 </select>
       </div>
      
      
    <div class="form-group">
         <label for="post_image">User Image</label>
          <input  type="file"  name="image">
    </div>


       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="add_user" value="Add User">
      </div>


</form> 