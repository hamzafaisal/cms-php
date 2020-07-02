<?php
if(isset($_POST['checkarray'])){
   
    foreach($_POST['checkarray'] as $checkbox){
        $option = $_POST['bulkoption'];
        
         switch($option){
        
            case 'Admin':      
            $query      = "UPDATE users SET user_role = 'Admin' WHERE user_id = $checkbox " ;
            $result_admin =  mysqli_query($conn, $query);   
            break;
                
            case 'Subscriber':   
            $query      = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $checkbox " ;
            $result_subs =  mysqli_query($conn, $query);
            break;
 
            case 'Delete':   
            $query      = "DELETE FROM users WHERE user_id = $checkbox " ;
            $result_del =  mysqli_query($conn, $query);
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
                       <option value="Admin">Admin</option>
                       <option value="Subscriber">Subscriber</option>
                       <option value="Delete">Delete</option>

                   </select>

               </div>

                   <div class="col-sm-4">
                       <input type="submit" class="btn btn-success" value="Apply" name="submit">
                   </div>     
                  
                                <thead >
                                   <tr>
                                   <th><input type="checkbox" class="selectall"></th>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>E-Mail</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                    <th>Admin</th>
                                    <th>Subscriber</th>
                                    
                                 
                                    
                                    </tr>
                                </thead>
                                
                                <tbody>
                                   
                                   <?php
                                     
                                    $query  = "SELECT * FROM users";
                                    $result = mysqli_query($conn, $query);
                                    
                                    if(mysqli_num_rows($result) > 0){
                                       while($rows = mysqli_fetch_assoc($result)){
                                           
                                           $user_id          = $rows['user_id'];
                                           $user_name         = $rows['user_name'];
                                           $user_password    = $rows['user_password'];
                                           $user_email       = $rows['user_email'];
                                           $user_firstname   = $rows['user_firstname'];
                                           $user_lastname    = $rows['user_lastname'];
                                           $user_image       = $rows['user_image'];
                                           $user_role        = $rows['user_role'];
                                           
                                           echo  "<tr>";
                                                        
                                    ?>
                                         
                                         <td><input type="checkbox" name="checkarray[]" value="<?php echo $user_id; ?>"></td>
                                          
                                    <?php       
                                     
                                           echo  "<td>$user_id </td>";
                                           echo  "<td>$user_name</td>";
                                           echo  "<td>$user_firstname</td>";
                                           echo  "<td>$user_lastname</td>";
                                           echo  "<td>$user_email</td>";
                                           echo  "<td>$user_role</td>";
                                           echo  "<td><img class='img-responsive' width='100' src='includes/uploads/{$user_image}'></td>";
                                                                                 
//                                        $query_post  = "SELECT * FROM posts WHERE post_id = $user_post_id ";
//                                        $result_post = mysqli_query($conn, $query_post);
//                                           
//                                        while($rows = mysqli_fetch_assoc($result_post)){
//                                        $post_title = $rows['post_title'];
//                                        $post_id    = $rows['post_id'];
//
//                                        echo "<td><a href='../post.php? id= {$post_id}'> $post_title </a></td>";
//
//                                        }
                                    
                                           echo  "<td><a href='users.php?delete={$user_id}'>Delete</td>";
                                           echo  "<td><a href='users.php?source=edit_user&id={$user_id}'>Edit</td>";

                                           echo  "<td><a href='users.php?admin={$user_id}'>Admin</td>";
                                           echo  "<td><a href='users.php?subscriber={$user_id}'>Subscriber</td>";
                        
                                           echo "</tr>";
                        
                                       }
                                    }
                                    
                                    ?>

                                    
                                    <?php
                                    
                                    if(isset($_GET['admin'])){
                                        $del_id = escape($_GET['admin']);
                                        
                                        $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$del_id} ";
                                        $result = mysqli_query($conn, $query);
                                        
                                        if($result){
                                            header('Location: users.php');
//                                            echo "<div class='alert alert-danger'>delete</div>";
                                        }
                                    }
                                    
                                    
                                    ?>
                                    
                                      <?php
                                    
                                    if(isset($_GET['subscriber'])){
                                        $del_id = escape($_GET['subscriber']);
                                        
                                        $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = {$del_id}   ";
                                        $result = mysqli_query($conn, $query);
                                        
                                        if($result){
                                            header('Location: users.php');
                                            echo "<div class='alert alert-danger'>delete</div>";
                                        }
                                    }
                                    
                                    
                                    ?>
                                   
                                     

                                   
                                    <?php
                                    
                                    if(isset($_GET['delete'])){
                                        $del_id = escape($_GET['delete']);
                                        
                                        $query = "DELETE FROM users WHERE user_id = {$del_id}";
                                        $result = mysqli_query($conn, $query);
                                        
                                        if($result){
                                            header('Location: users.php');
                                            echo "<div class='alert alert-danger'>delete</div>";
                                        }
                                    }
                                    
                                    
                                    ?>
                                    
                                </tbody>
                                
                         
                        </table>
                        
                        
             