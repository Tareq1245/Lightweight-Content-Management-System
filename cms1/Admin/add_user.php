 <?php require_once('include/top.php');

if(!isset($_SESSION['username'])){
    header('location:login.php');
    
}
else if(isset($_SESSION['username']) && $_SESSION['role'] == 'author'){
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
                Add User
                <small>Add New User</small>
                
                </h1>
                
                   <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">
                                Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Add User</li>
                        </ol>
                        
                        <?php
                        if(isset($_POST['submit'])){
                            $date = time();
                            $first_name = mysqli_real_escape_string($connection,$_POST['first-name']);
                            $last_name = mysqli_real_escape_string($connection,$_POST['last-name']);
                            $username = mysqli_real_escape_string($connection,strtolower($_POST['username']));
                            $username_trim = preg_replace("/\s+/",'',$username);
                            $email = mysqli_real_escape_string($connection,strtolower($_POST['email']));
                            $password = mysqli_real_escape_string($connection,$_POST['password']);
                            $role = $_POST['role'];
                            $image = $_FILES['image']['name'];
                            $image_tmp = $_FILES['image']['tmp_name'];
                            
                            $check_query = "SELECT * FROM users WHERE username='$username' or email='$email'";
                            $check_run = mysqli_query($connection,$check_query);
                            
                            $salt_query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                            $salt_run = mysqli_query($connection, $salt_query);
                            $salt_row = mysqli_fetch_array($salt_run);
                            $salt = $salt_row['salt'];
                            
                            $password = crypt($password,$salt);
                            
                            if(empty($first_name) or empty($last_name) or empty($username) or empty($email) or empty($password) or empty($image)){

                            $error = "All (*) fields are Required";
                                
                            }
                            else if($username != $username_trim){
                                $error = "Don't Use Spaces in Username";
                            }
                            else if(mysqli_num_rows($check_run) > 0){
                                $error = "Username or Email Already Exist";
                                
                            }
                            else{
                                $insert_query ="INSERT INTO `users` (`id`, `date`, `first_name`, `last_name`, `username`, `email`, `image`, `password`, `role`) VALUES (NULL, '$date', '$first_name', '$last_name', '$username', '$email', '$image', '$password', '$role')";
                                if(mysqli_query($connection,$insert_query)){
                                    $msg = "Successfully Added User";
                                    move_uploaded_file($image_tmp,"image/$image");
                                    $image_check = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                                    $image_run = mysqli_query($connection,$image_check);
                                    $image_row = mysqli_fetch_array($image_run);
                                    $check_image = $image_row['image'];
                                    
                                    $first_name = "";
                                    $last_name = "";
                                    $username = "";
                                    $email = "";
                                }
                                else{
                                    $error = "User has not been added";
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
                                <input type="text" name="first-name" id="first-name" class="form-control" value="<?php if(isset($first_name)) { echo $first_name; }?>" placeholder="First Name">
                            </div>
                            
                            <div class="form-group">
                                <label for="last-name">Last Name<small>*</small>:</label>
                                <input type="text" name="last-name" id="last-name" class="form-control" value="<?php if(isset($last_name)) { echo $last_name; }?>" placeholder="Last Name">
                            </div>
                            
                            <div class="form-group">
                                <label for="username">UserName<small>*</small>:</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?php if(isset($username)) { echo $username; }?>" placeholder="UserName">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email<small>*</small>:</label>
                                <input type="text" name="email" id="email" class="form-control" value="<?php if(isset($email)) { echo $email; }?>" placeholder="Email Address">
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Password<small>*</small>:</label>
                                <input type="text" name="password" id="password" class="form-control"  placeholder="Password">
                            </div>
                            
                            <div class="form-group">
                                <label for="role">Role:</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="author">Author</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="image">Profile Picture<small>*</small>:</label>
                                <input type="file" name="image" id="image">
                            </div>
                            
                            
                            <input type="submit" value="Add User" name="submit" class="btn btn-primary">
                        </form>
                            </div>
                            <div class="col-md-4">
                                
                                <?php
                                if(isset($check_image)){
                                    echo "img src='image/$check_image' width= '80%'";
                                }
                                ?>
                            </div>
                        </div>
                        
            </div>
        </div>
    </div>
    
    <?php require_once('include/footer.php');?>