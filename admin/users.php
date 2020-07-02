<?php include('functions.php');  ?>
<?php include('includes/header.php');  ?>
<?php include('includes/nav.php');  ?>

       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small><?php echo ucfirst($_SESSION['username']); ?></small>
                        </h1>
                        
                        <?php
                           
                        if(isset($_GET['success'])){
                          echo "<div class='alert alert-success text-center'>User Updated!</div>";
                        
                        } else{
                  
                        }
                      
                        
                        
                        ?>
            
                        <?php
                        
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                           
                        } else{
                            $source = "";
                        }
                        
                        switch($source){
                                
                            case 'add_user';
                            include('includes/add_user.php');
                            break;
                              
                            case 'edit_user';
                            include('includes/edit_user.php');
                            break;
                                
                            default:
                            include('includes/view_user.php');
                             
                                
                        }
                        
                        
                        
                        ?>
                        
                        
                        
                        
                    </div>
                    </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->



<?php include('includes/footer.php');  ?>
