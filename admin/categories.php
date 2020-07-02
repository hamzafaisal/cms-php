<?php include('functions.php');  ?>
<?php include('includes/header.php');  ?>
<?php include('includes/nav.php');  ?>


   <?php



    ?>
   

   
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small>Admin</small>
                        </h1>
                        
                        <div class="col-md-6">
                           
                         <?php   insert();    ?> 
                           
                         <form action="" method="post" >
                           <div class="form-group">
                               <label for="cat_title">Add Category</label>
                               <input name="cat_title" type="text" class="form-control">
                           </div>
                           
                           <button name="submit" type="submit" class="btn btn-primary">Add Category</button>
                           </form>
                           <br><br><br>
                           
                           
                           <form class="" action="" method="post" >
                           <div class="form-group">
                               <label for="cat_edit">Edit Category</label>
                      
                               
                        <?php
                               
                        if(isset($_GET['edit'])){
                            
                          $cat_id = $_GET['edit'];
                              
                        $query_edit  = "SELECT * FROM category WHERE cat_id = {$cat_id} ";
                        $result_edit = mysqli_query($conn, $query_edit);

                            while($rows = mysqli_fetch_assoc($result_edit)){

                                $cat_id = $rows['cat_id'];
                                $cat_title = $rows['cat_title'];
                                
                        ?>    
                            
                        <input name="cat_edit" type="text" class="form-control" value="<?php if(isset($cat_title)){echo $cat_title; } ?>">

                              
                        <?php
                            }

                            }

                        ?>   
                               
                               
                           </div>
                           
                           <button name="update" type="submit" class="btn btn-primary">Update Category</button>
                           </form>
       
                        </div>
                        
                        
                           
                           <?php  
                            
                            if(isset($_POST['update'])){
                                $cat_edit = $_POST['cat_edit'];
                                $query  = "UPDATE category SET cat_title = '{$cat_edit}' WHERE cat_id = {$cat_id}" ;
                                $result = mysqli_query($conn, $query);
                                header('Location: categories.php');

                            }
                        
                        ?>

                        
                    
                                                
                        <div class="col-md-6">
                            <table class="table table-bordered table-responsive table-striped table-hover">
                                <tr>
                                    <th>Category Id</th>
                                    <th>Category Title</th>
                                </tr>
                                
                                <tbody>
                                   
                           <?php  display_table();   ?>   
                       
                                </tbody>
                                
                            </table>

                            <?php    delete1();   ?>                            
                            
                        </div>
                        
                        
                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->



<?php include('includes/footer.php');  ?>
