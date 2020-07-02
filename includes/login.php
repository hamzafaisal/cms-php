<?php include('connection.php'); ?>
<?php ob_start(); ?>
<?php session_start(); ?>


<?php
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    
    
    
    $query  = "SELECT * FROM users WHERE user_name = '{$username}' ";
    $result_log =  mysqli_query($conn, $query);
    
    if(!$result_log){
        echo mysqli_error($conn);
    }
    
    while($rows = mysqli_fetch_assoc($result_log)){
        $user_id = $rows['user_id'];
        $user_password = $rows['user_password'];
        $user_name = $rows['user_name'];
        $user_firstname = $rows['user_firstname'];
        $user_lastname = $rows['user_lastname'];
        $user_email = $rows['user_email'];
        $user_role = $rows['user_role'];
        $user_image = $rows['userimage'];

    }
    
        $hash_password = password_verify($password, $user_password);
  
        if($username != $user_name && $hash_password != $user_password ){
            header('Location: ../index.php?notadmin');

        } elseif ($username == $user_name && $hash_password == $user_password ){
            header('Location: ../admin');
                
            $_SESSION['username']  = $user_name;    
            $_SESSION['userfname'] = $user_firstname;    
            $_SESSION['userlname'] = $user_lastname;    
            $_SESSION['useremail'] = $user_email;
            $_SESSION['userrole']  = $user_role; 
            $_SESSION['userimage'] = $user_image; 
                
            } else{
               
                header('Location: ../index.php?notadmin');

            }
   
}
?>