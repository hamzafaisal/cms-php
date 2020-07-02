<?php  include "includes/connection.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/nav.php"; ?>
   
<?php

if(isset($_POST['submit'])) {
    $username       = $_POST['username'];
    $email          = $_POST['email'];
    $password       = $_POST['password'];
    $user_firstname = $_POST['firstname'];
    $user_lastname  = $_POST['lastname'];
    
   $username = mysqli_real_escape_string($conn, $username);
   $email    = mysqli_real_escape_string($conn, $email);
   $password = mysqli_real_escape_string($conn, $password);
  
 

$hash_password = password_hash($password, PASSWORD_DEFAULT);
     
$query = "INSERT INTO users (user_name, user_firstname, user_lastname, user_password , user_email ) 
         VALUES( '{$username}', '{$user_firstname}','{$user_lastname}', '{$hash_password}', '{$email}' )";
    
$result = mysqli_query($conn, $query);
   
    if(!$result){
           echo "Error: ". mysqli_error($conn);
        } else{
        header('Location: registration.php');
    }
    }

    
?>       
 
    <!-- Page Content -->
    <div class="container">
<div class="well well-lg"> 
       
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input autocomplete="on" type="text" name="username" id="username" class="form-control" placeholder="Enter  Username" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="firstname" class="sr-only">First Name</label>
                            <input type="text" name="firstname" id="fn" class="form-control" placeholder="Enter  Firstname" >
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">Last Name</label>
                            <input type="text" name="lastname" id="ln" class="form-control" placeholder="Enter Lastname">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">E-mail</label>
                            <input autocomplete="on" type="email" name="email" id="email" class="form-control" placeholder="@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
</div>

        <hr>



<?php include "includes/footer.php";?>
