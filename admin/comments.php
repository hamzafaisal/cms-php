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
                            <small>Admin</small>
                        </h1>
            
                        <?php
                        
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                           
                        } else{
                            $source = "";
                        }
                        
                        switch($source){
                                
                            case 'add_posts';
                            include('includes/add_posts.php');
                            break;
                              
                            case 'edit_posts';
                            include('includes/edit_posts.php');
                            break;
                                
                            default:
                            include('includes/view_comments.php');
                             
                                
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
