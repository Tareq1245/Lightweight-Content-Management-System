 <?php require_once('include/top.php');

if(!isset($_SESSION['username'])){
    header('location:login.php');
    
}
else if(isset($_SESSION['username']) && $_SESSION['role'] == 'author'){
    header('location: index.php');
}

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
}

if(isset($_GET['del'])){
    $del_id  = $_GET['del'];
   $del_check_query = "SELECT * FROM categories WHERE id= $del_id";
   $del_check_run = mysqli_query($connection,$del_check_query);
    if(mysqli_num_rows($del_check_run)>0){
         $del_query = "DELETE FROM `categories` WHERE `categories`.`id` = $del_id";
    if(isset($_SESSION['username']) && $_SESSION['role'] == 'admin'){
        if(mysqli_query($connection,$del_query)){
        $msg = "Categories has been Deleted";
        
    }
    else{
        $error = "Categories has not been Deleted";
    }
    }
    }
    else{
        header('location: index.php');
    }
}



if(isset($_POST['submit'])){
    $cat_name = mysqli_real_escape_string($connection,strtolower($_POST['cat-name']));
    
 if(empty($cat_name)){
     $error = "Must Fill the Field";
 }
    else{
           $check_query = "SELECT * FROM categories WHERE category = '$cat_name'";
    $check_run = mysqli_query($connection,$check_query);
    if(mysqli_num_rows($check_run) > 0){
        $error = "Categories Already Exist";
        
    }
    else{
        $insert_query = "INSERT INTO categories (category) VALUES ('$cat_name')";
        if(mysqli_query($connection,$insert_query)){
            $msg = "Category Has been Added";
            
        }
        else{
            $error = "Category has not been Added";
        }
    }
    }
}

if(isset($_POST['update'])){
    $cat_name = mysqli_real_escape_string($connection,strtolower($_POST['cat-name']));
    
 if(empty($cat_name)){
     $up_error = "Must Fill the Field";
 }
    else{
        
           $check_query = "SELECT * FROM categories WHERE category = '$cat_name'";
    $check_run = mysqli_query($connection,$check_query);
    if(mysqli_num_rows($check_run) > 0){
        $up_error = "Categories Already Exist";
        
    }
    else{
        $update_query = "UPDATE `categories` SET `category` = '$cat_name' WHERE `categories`.`id` = $edit_id";
        if(mysqli_query($connection,$update_query)){
            $up_msg = "Category Has been Updated";
            
        }
        else{
            $up_error = "Category has not been Updated";
        }
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
                    <h1><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tags-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M3 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 7.586 1H3zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
      <path d="M1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"/>
    </svg>
                    Categories
                    <small>Different Categories</small>

                    </h1>

                       <ol class="breadcrumb">
                       <li class="breadcrumb-item" aria-current="page"><a href="index.php">

                            Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">

                            Categories</li>
                            </ol>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="category">Category Name: </label>
                                            <?php 
                                            if(isset($error)){
                                    echo "<span class='float-right text-danger'>$error</span>";
                                }
                                else if(isset($msg)){
                                    echo "<span class='float-right text-success'>$msg</span>";
                                    
                                }
                                            ?>
                                            <input type="text" placeholder="Category Name" class="form-control" name="cat-name">
                                        </div>
                                        <input type="submit" value="Add Category" name="submit" class="btn btn-primary">
                                    </form>
                                    
                                    <?php
                                    if(isset($_GET['edit'])){
                                        $edit_check_query = "SELECT * FROM categories WHERE id = $edit_id";
                                        $edit_check_run= mysqli_query($connection,$edit_check_query);
                                        if(mysqli_num_rows($edit_check_run) > 0){
                                            
                                            $edit_row = mysqli_fetch_array($edit_check_run);
                                            $up_category = $edit_row['category'];
                             
                                    ?>
                                    <hr>
                                    
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="category">Update Category Name: </label>
                                            <?php 
                                            if(isset($up_error)){
                                    echo "<span class='float-right text-danger'>$up_error</span>";
                                }
                                else if(isset($up_msg)){
                                    echo "<span class='float-right text-success'>$up_msg</span>";
                                    
                                }
                                            ?>
                                            <input type="text" value="<?php echo $up_category;?>" placeholder="Category Name" class="form-control" name="cat-name">
                                        </div>
                                        <input type="submit" value="Update Category" name="update" class="btn btn-primary">
                                    </form>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-md-8">
                                   <?php
                                    $get_query = "SELECT * FROM categories ORDER BY id ASC";
                                    $get_run = mysqli_query($connection, $get_query);
                                    if(mysqli_num_rows($get_run) > 0){
                                        
                                    if(isset($del_error)){
                                    echo "<span class='float-right text-danger'>$del_error</span>";
                                }
                                else if(isset($del_msg)){
                                    echo "<span class='float-right text-success'>$del_msg</span>";
                                    
                                }
                                    
                                    ?>
                                   
                                    <table class="table table-hover table-bordered table-striped">
                                        <thead>
                                           
                                            <tr>
                                               <th><input type="checkbox" id="selectallboxes"></th>
                                                <th>Serial Number</th>
                                                <th>Category Name</th>
                                                <th>Posts</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            while($get_row = mysqli_fetch_array($get_run)){
                                                
                                                $category_id = $get_row['id'];
                                                $category_name = $get_row['category'];
                                           
                                            
                                            ?>
                                            <tr>
                                               <th><input type="checkbox" class="checkboxes" name="checkboxes[]"></th>
                                                <td><?php echo $category_id;?></td>
                                                <td><?php echo ucfirst($category_name);?></td>
                                                <td>12</td>
                                                <td><a href="categories.php?edit=<?php echo $category_id;?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg></a></td>
                                                <td><a href="categories.php?del=<?php echo $category_id;?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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
                                        echo "<center><h3>No Categories Found</h3></center>";
                                    }
                                    ?>
                                </div>
                            </div>
                </div>
            </div>
        </div>

         <?php require_once('include/footer.php');?>