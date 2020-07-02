<?php include('includes/header.php');  ?>
<?php include('includes/nav.php');  ?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome
                    <small> <?php echo ucwords($_SESSION['username']); ?>    </small>
                </h1>

            </div>
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                               
                               <?php
                                $query  = "SELECT * FROM posts";
                                $result_post = mysqli_query($conn,$query); 
                                $count_post = mysqli_num_rows($result_post);
                                
                                echo "<div class='huge'>{$count_post}</div>";
                                    
                                ?>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>


                    <a href="posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                              
                               <?php
                                $query  = "SELECT * FROM comments";
                                $result_com = mysqli_query($conn,$query); 
                                $count_com = mysqli_num_rows($result_com);
                                
                                echo "<div class='huge'>{$count_com}</div>";
                                    
                                ?>
                                
                                 <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                               
                               <?php
                                $query  = "SELECT * FROM users";
                                $result_user = mysqli_query($conn,$query); 
                                $count_user = mysqli_num_rows($result_user);
                                
                                echo "<div class='huge'>{$count_user}</div>";
                                    
                                ?>
                                
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                
                                <?php
                                $query  = "SELECT * FROM category";
                                $result_cat = mysqli_query($conn,$query); 
                                $count_cat = mysqli_num_rows($result_cat);
                                
                                echo "<div class='huge'>{$count_cat}</div>";
                                    
                                ?>
                                
                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="categories.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
                
        <?php
        
        $query  = "SELECT * FROM posts WHERE post_status = 'Draft' ";
        $result_draft = mysqli_query($conn,$query); 
        $count_draft = mysqli_num_rows($result_draft);
        
        $query  = "SELECT * FROM posts WHERE post_status = 'Published' ";
        $result_publised = mysqli_query($conn,$query); 
        $count_publised = mysqli_num_rows($result_publised);
        
        $query  = "SELECT * FROM comments WHERE comment_status = 'Unapproved' ";
        $result_unapproved = mysqli_query($conn,$query); 
        $count_unapproved = mysqli_num_rows($result_unapproved);
        
        $query  = "SELECT * FROM users WHERE user_role = 'Subscriber' ";
        $result_subs = mysqli_query($conn,$query); 
        $count_subs = mysqli_num_rows($result_subs);
        
        ?>
            
        <div class="row">
            
      <script type="text/javascript">
    
 
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            
            <?php
            
            $element_text = ['Posts','Draft Posts', 'Published Posts', 'Comment', 'Pending Comment', 'User', 'Subscribers', 'Category', 'Online Users' ];
            $element_count = [$count_post, $count_draft, $count_publised, $count_com, $count_unapproved, $count_user,$count_subs, $count_cat, $count_users,];
            
            for($i = 0 ; $i < 9 ; $i++){
                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]} ],";
            }     
            
            ?>
            
//          ['2014', 1000 ]
       
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    
        <div id="columnchart_material" style="width: auto; height: 500px;"></div>

  
            
            
        </div>
        


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->







<?php include('includes/footer.php');  ?>
