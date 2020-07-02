<?php
if(isset($_POST['checkarray'])){
   
    foreach($_POST['checkarray'] as $checkbox){
        $option = $_POST['bulkoption'];
        
         switch($option){
        
            case 'approve':      
            $query      = "UPDATE comments SET comment_status = 'approve' WHERE comment_id = $checkbox " ;
            $result_app =  mysqli_query($conn, $query);   
            break;
                
            case 'unapprove':   
            $query        = "UPDATE comments SET comment_status = 'unapprove' WHERE comment_id = $checkbox " ;
            $result_unapp =  mysqli_query($conn, $query);
            break;
 
            case 'Delete':   
            $query      = "DELETE FROM comments WHERE comment_id = $checkbox " ;
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
                       <option value="approve">Approve</option>
                       <option value="unapprove">Unapprove</option>
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
                        <th>Author</th>
                        <th>Comment</th>
                        <th>E-Mail</th>
                        <th>Status</th>
                        <th>Response</th>
                        <th>Approved</th>
                        <th>Unapproved</th>
                        <th>Date</th>
                        <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>

                                   <?php
                                     
                                    $query  = "SELECT * FROM comments";
                                    $result = mysqli_query($conn, $query);
                                    
                                    if(mysqli_num_rows($result) > 0){
                                       while($rows = mysqli_fetch_assoc($result)){
                                           
                                           $comment_id          = $rows['comment_id'];
                                           $comment_author      = $rows['comment_author'];
                                           $comment_post_id     = $rows['comment_post_id'];
                                           $comment_email       = $rows['comment_email'];
                                           $comment_status      = $rows['comment_status'];
                                           $comment_content     = $rows['comment_content'];
                                           $comment_date        = $rows['comment_date'];
                                           
                                           echo  "<tr>";
                                           
                                    ?>
                                         
                                         <td><input type="checkbox" name="checkarray[]" value="<?php echo $comment_id; ?>"></td>
                                          
                                    <?php       
                                           
                                           
                                           echo  "<td>$comment_id </td>";
                                           echo  "<td>$comment_author</td>";
                                           echo  "<td>$comment_content</td>";
                                           echo  "<td>$comment_email</td>";
                                           echo  "<td>$comment_status</td>";
                                                                                 
                                        $query_post  = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                                        $result_post = mysqli_query($conn, $query_post);
                                           
                                        while($rows = mysqli_fetch_assoc($result_post)){
                                        $post_title = $rows['post_title'];
                                        $post_id    = $rows['post_id'];

                                        echo "<td><a href='../post.php? id= {$post_id}'> $post_title </a></td>";

                                        }
                                    
                                           echo  "<td><a href='comments.php?approve={$comment_id}'>Approve</td>";
                                           echo  "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</td>";
                                           echo  "<td>$comment_date</td>";
                                           echo  "<td><a href='comments.php?delete={$comment_id}'>Delete</td>";
                        
                                           echo "</tr>";
                        
                                       }
                                    }
                                    
                                    ?>

                                    
                                    <?php
                                    
                                    if(isset($_GET['approve'])){
                                        $del_id = escape($_GET['approve']);
                                        
                                        $query = "UPDATE comments SET comment_status = 'approve' WHERE comment_id = {$del_id} ";
                                        $result = mysqli_query($conn, $query);
                                        
                                        if($result){
                                            header('Location: comments.php');
                                        }
                                    }
                                    
                                    
                                    ?>
                                    
                                      <?php
                                    
                                    if(isset($_GET['unapprove'])){
                                        $del_id = escape($_GET['unapprove']);
                                        
                                        $query = "UPDATE comments SET comment_status = 'unapprove' WHERE comment_id = {$del_id}   ";
                                        $result = mysqli_query($conn, $query);
                                        
                                        if($result){
                                            header('Location: comments.php');
                                            echo "<div class='alert alert-danger'>delete</div>";
                                        }
                                    }
                                    
                                    
                                    ?>
                       
                                    <?php
                                    
                                    if(isset($_GET['delete'])){
                                        $del_id = escape($_GET['delete']);
                                        
                                        $query = "DELETE FROM comments WHERE comment_id = {$del_id}";
                                        $result = mysqli_query($conn, $query);
                                        
                                        if($result){
                                            header('Location: comments.php');
                                            echo "<div class='alert alert-danger'>delete</div>";
                                        }
                                    }
                                    
                                    
                                    ?>
                                   
                          
                                    
                                </tbody>
                                
                         
                        </table>
                        
                        
            