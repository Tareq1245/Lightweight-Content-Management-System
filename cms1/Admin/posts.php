 <?php require_once('include/top.php');
if(!isset($_SESSION['username'])){
    header('location:login.php');
    
}

$session_username = $_SESSION['username'];
?>
 <?php

if(isset($_GET['del'])){
    $del_id  = $_GET['del'];
  if($_SESSION['role'] == 'admin'){
       $del_check_query = "SELECT * FROM posts WHERE id= $del_id";
   $del_check_run = mysqli_query($connection,$del_check_query);
      
  }
    else if($_SESSION['role'] == 'author'){

     $del_check_query = "SELECT * FROM posts WHERE id= $del_id and author='$session_username'";
   $del_check_run = mysqli_query($connection,$del_check_query);
    }
    if(mysqli_num_rows($del_check_run)>0){
         $del_query = "DELETE FROM `posts` WHERE `posts`.`id` = $del_id";
   
        if(mysqli_query($connection,$del_query)){
        $msg = "Posts has been Deleted";
        
    }
    else{
        $error = "Posts has not been Deleted";
    }
   
    }
    else{
        header('location: index.php');
    }
}


if(isset($_POST['checkboxes'])){
   foreach($_POST['checkboxes'] as $user_id){
       $bulk_option = $_POST['bulk-options'];
       if($bulk_option == 'delete'){
           $bulk_del_query =  "DELETE FROM `posts` WHERE `posts`.`id` = $user_id";
           mysqli_query($connection, $bulk_del_query);
       }
       else if($bulk_option == 'publish'){
           $bulk_author_query = "UPDATE `posts` SET `status` = 'publish' WHERE `posts`.`id` = '$user_id'";
           mysqli_query($connection, $bulk_author_query);
       }
       else if($bulk_option == 'draft'){
           $bulk_admin_query = "UPDATE `posts` SET `status` = 'draft' WHERE `posts`.`id` = '$user_id'";
           mysqli_query($connection, $bulk_admin_query);
       }
   }
}
?>
 
  </head>
  <body>
   
   <div id="wrapper">
       
        <?php require_once('include/header.php');?>
    <div class="container-fluid body-section">
        <div class="row">
            <div class="col-md-3">
                
                 <?php require_once('include/sidebar.php');?>
            </div>
            <div class="col-md-9">
                <h1><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path fill-rule="evenodd" d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
</svg>
                Posts
                <small>View All Posts</small>
                
                </h1>
                
                   <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">
                                Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Posts</li>
                        </ol>
                        
                        <?php
                        
                        if($_SESSION['role'] == 'admin'){
                            $query = "SELECT * FROM posts ORDER BY id ASC";
                        $run = mysqli_query($connection,$query);
                            
                        }
                else if($_SESSION['role'] == 'author'){
                    $query = "SELECT * FROM posts WHERE author='$session_username' ORDER BY id ASC";
                        $run = mysqli_query($connection,$query);
                        }
                        if(mysqli_num_rows($run) > 0){
                            
                        
                        ?>
                        <form action="" method="post">
                        <div class="row">
                            <div class="col-sm-8">
                                
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="bulk-options" id="" class="form-control">
                                                <option value="delete">Delete</option>
                                                <option value="publish">Publish</option>
                                                <option value="draft">Draft</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn btn-success" value="Apply">
                                            <a href="add_post.php" class="btn btn-primary">Add New</a>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        
                        <?php
if(isset($error)){
                                    echo "<span class='float-right text-danger'>$error</span>";
                                }
                                else if(isset($msg)){
                                    echo "<span class='float-right text-success'>$msg</span>";
                                    
                                }
                ?>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                   <th><input type="checkbox" id="selectallboxes"></th>
                                    <th>Sr No</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                   
                                    <th>Image</th>
                                    
                                    <th>Categories</th>
                                     <th>Views</th>
                                     <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                while($row = mysqli_fetch_array($run)){
                                    $id = $row ['id'];
                                    $date = getdate($row ['date']);
                                    $day = $date['mday'];
                                    $month = substr($date['month'],0,3);
                                    $year = $date['year'];
                                    $title = ucfirst($row ['title']);
                                    $author = $row ['author'];
                                    $image = $row ['image'];
                                    $categories = $row['categories'];
                                    $views = $row ['views'];
                                    $status = $row['status'];
                                    

                                ?>
                               
                                <tr>
                                   <th><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></th>
                                    <td><?php echo $id;?></td>
                                    <td><?php echo "$day $month $year";?></td>
                                    <td><?php echo "$title";?></td>
                                    <td><?php echo $author;?></td>
                                    
                                    <td><img src="image/<?php echo $image;?>" alt="Profile Picture" width="30px"></td>
                                    <td><?php echo $categories;?></td>
                                  <td><?php echo $views;?></td>
                                    <td><span style="color:<?php 
                                       if($status == 'publish'){
                                           echo 'green';
                                       }
                                    else if($status == 'draft'){
                                       echo 'red';
                                    }
                                    
                                       ?>"><?php echo ucfirst($status);?></span></td>
                                    
                                    <td><a href="edit_post.php?edit=<?php echo $id;?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg></a></td>
                                    <td><a href="posts.php?del=<?php echo $id;?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></a></td>
                                </tr>
                                
                                <?php
                                 }
                                ?>
                            </tbody>
                        </table>

           <?php
                }
                else{
                    echo "<center><h2>No Users Available</h2></center>";
                }
                ?>
                </form>
            </div>
        </div>
    </div>
    
    <?php require_once('include/footer.php');?>