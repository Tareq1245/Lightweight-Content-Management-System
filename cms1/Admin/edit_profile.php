 <?php require_once('include/top.php');

if(!isset($_SESSION['username'])){
    header('location:login.php');
    
}

$session_username = $_SESSION['username'];

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
    
    $edit_query = "SELECT * FROM users WHERE id = '$edit_id'";
    $edit_query_run = mysqli_query($connection, $edit_query);
    if(mysqli_num_rows($edit_query_run) > 0){
        $edit_row = mysqli_fetch_array($edit_query_run);
        $edit_username = $edit_row['username'];
        
        if($edit_username == $session_username){
            $edit_first_name = $edit_row['first_name'];
        $edit_last_name = $edit_row['last_name'];
        
        $edit_image = $edit_row['image'];
        $edit_details = $edit_row['details'];
        }
        else{
            header('location: index.php');
        }
        
    }
    else{
        header('location: index.php');
    }
}
else{
    header('location: index.php');
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
                <h1><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zM13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
</svg>
                Edit Profile
                <small>Edit Profile Details</small>
                
                </h1>
                
                   <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">
                                Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Edit Profile</li>
                        </ol>
                        
                        <?php
                        if(isset($_POST['submit'])){
                            
                            $first_name = mysqli_real_escape_string($connection,$_POST['first-name']);
                            $last_name = mysqli_real_escape_string($connection,$_POST['last-name']);
                           
                            $password = mysqli_real_escape_string($connection,$_POST['password']);
                            
                            $image = $_FILES['image']['name'];
                            $image_tmp = $_FILES['image']['tmp_name'];
                            
                            $details = mysqli_real_escape_string($connection,$_POST['details']);
                            
                            if(empty($image)){
                                $image = $edit_image;
                            }
                            
                            $salt_query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                            $salt_run = mysqli_query($connection, $salt_query);
                            $salt_row = mysqli_fetch_array($salt_run);
                            $salt = $salt_row['salt'];
                            
                            $insert_password = crypt($password,$salt);
                            
                            if(empty($first_name) or empty($last_name) or empty($image)){

                            $error = "All (*) fields are Required";
                                
                            }
                            
                            else{
                                $update_query = "UPDATE `users` SET `date` = '1234567891', `first_name` = '$first_name', `last_name` = '$last_name', `image` = '$image', `details` = '$details'";
                                
                                if(isset($password)){
                                    $update_query .= " ,`password` = '$insert_password'";
                                    
                                }
                                
                                $update_query .=" WHERE `users`.`id` = $edit_id";
                                
                                if(mysqli_query($connection,$update_query)){
                                    $msg = "User Updated Successfully";
                                    header("refresh:1; url=edit_profile.php?edit=$edit_id");
                                    if(!empty($image)){
                                        move_uploaded_file($image_tmp,"image/$image");
                                    }
                                }
                                else{
                                    $error = "User has not Updated";
                                }
                            }
                            
                        }
                
                        ?>
                        
                        <div class="row">
                            <div class="col-md-8">
                                <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="first-name">First Name<small>*</small>:</label>
                                
                                <?php
                                if(isset($error)){
                                    echo "<span class='float-right text-danger'>$error</span>";
                                }
                                else if(isset($msg)){
                                    echo "<span class='float-right text-success'>$msg</span>";
                                    
                                }
                                ?>
                                <input type="text" name="first-name" id="first-name" class="form-control" value="<?php  echo $edit_first_name;?>" placeholder="First Name">
                            </div>
                            
                            <div class="form-group">
                                <label for="last-name">Last Name<small>*</small>:</label>
                                <input type="text" name="last-name" id="last-name" class="form-control" value="<?php  echo $edit_last_name;?>" placeholder="Last Name">
                            </div>
                            
                            
                            
                            <div class="form-group">
                                <label for="password">Password<small>*</small>:</label>
                                <input type="password" name="password" id="password" class="form-control"  placeholder="Password">
                            </div>
                            
                            
                            
                            <div class="form-group">
                                <label for="image">Profile Picture<small>*</small>:</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="form-group">
                                <label for="details">Details:<small>*</small>:</label>
                                <textarea style="overflow:auto;resize:none" name="details" id="details" cols="30" rows="10" class="form-control" ><?php  echo $edit_details;?></textarea>
                            </div>
                            
                            
                            <input type="submit" value="Update User" name="submit" class="btn btn-primary">
                        </form>
                            </div>
                            <div class="col-md-4">
                                
                                <?php
                                
                                    echo "<img src='image/$edit_image' width= '80%'>";
                               
                                ?>
                            </div>
                        </div>
                        
            </div>
        </div>
    </div>
    
    <?php require_once('include/footer.php');?>