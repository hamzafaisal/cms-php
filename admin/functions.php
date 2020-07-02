<?php

function escape($string){
    
    global $conn;
    
    $string = mysqli_real_escape_string($conn, trim($string));
    return $string;
    
}

//avoid sql injections*********************************************************



function insert(){
                
    global $conn;
    
            if(isset($_POST['submit'])){

            $cat_title = $_POST['cat_title'];

            if($cat_title == "" || empty($cat_title)){
                echo "<div class='alert alert-danger'>Enter Some Values</div>";

            } else {

            $query_cat  = "INSERT INTO category (cat_title) VALUE ('$cat_title') ";
            $result_cat = mysqli_query($conn, $query_cat);
            header('Location: categories.php');

            if(!$result_cat){
                echo "mysqli_error()";
            }

            }     

        }

}

//end insert****************************************************************

function delete1(){
    
    global $conn;
    
    if(isset($_GET['delete'])){
        $cat_id = $_GET['delete'];

        $query = "DELETE FROM category WHERE cat_id = {$cat_id}";
        $result_del = mysqli_query($conn, $query);
        header('Location: categories.php');                                 
    }

    
    
   
    
    
}
//end delete****************************************************************


function display_table(){
    
    global $conn;
 
    $query  = "SELECT * FROM category";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0 ){
        while($rows = mysqli_fetch_assoc($result)){

            $cat_id = $rows['cat_id'];
            $cat_title = $rows['cat_title'];

            echo "<tr>";
            echo "<td>$cat_id</td>";
            echo "<td>$cat_title</td>";
            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";

            echo "</tr>";

        }
    }
    
}
//end display****************************************************************


 function timer($timestamp) {  
      $time_ago         = strtotime($timestamp);  
      $current_time     = time();  
      $time_difference  = $current_time - $time_ago;  
      $seconds          = $time_difference;  
      $minutes          = round($seconds / 60 );            // value 60 is seconds  
      $hours            = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
      $days             = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
      $weeks            = round($seconds / 604800);         // 7*24*60*60;  
      $months           = round($seconds / 2629440);        //((365+365+365+365+366)/5/12)*24*60*60  
      $years            = round($seconds / 31553280);       //(365+365+365+365+366)/5 * 24 * 60 * 60  
      if($seconds <= 60)  
      {  
     return "Just Now";  
   }  
      else if($minutes <=60)  
      {  
     if($minutes==1)  
           {  
       return "one minute ago";  
     }  
     else  
           {  
       return "$minutes minutes ago";  
     }  
   }  
      else if($hours <=24)  
      {  
     if($hours==1)  
           {  
       return "an hour ago";  
     }  
           else  
           {  
       return "$hours hrs ago";  
     }  
   }  
      else if($days <= 7)  
      {  
     if($days==1)  
           {  
       return "yesterday";  
     }  
           else  
           {  
       return "$days days ago";  
     }  
   }  
      else if($weeks <= 4.3) //4.3 == 52/12  
      {  
     if($weeks==1)  
           {  
       return "a week ago";  
     }  
           else  
           {  
       return "$weeks weeks ago";  
     }  
   }  
       else if($months <=12)  
      {  
     if($months==1)  
           {  
       return "a month ago";  
     }  
           else  
           {  
       return "$months months ago";  
     }  
   }  
      else  
      {  
     if($years==1)  
           {  
       return "one year ago";  
     }  
           else  
           {  
       return "$years years ago";  
     }  
   }  
 }   
//timer*********************************************************











?>