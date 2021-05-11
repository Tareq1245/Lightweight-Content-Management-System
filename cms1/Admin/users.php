 <?php require_once('include/top.php');
if(!isset($_SESSION['username'])){
    header('location:login.php');
    
}
else if(isset($_SESSION['username']) && $_SESSION['role'] == 'author'){
    header('location: index.php');
}
?>
 <?php

if(isset($_GET['del'])){
    $del_id  = $_GET['del'];
   $del_check_query = "SELECT * FROM users WHERE id= $del_id";
   $del_check_run = mysqli_query($connection,$del_check_query);
    if(mysqli_num_rows($del_check_run)>0){
         $del_query = "DELETE FROM `users` WHERE `users`.`id` = $del_id";
    if(isset($_SESSION['username']) && $_SESSION['role'] == 'admin'){
        if(mysqli_query($connection,$del_query)){
        $msg = "Users has been Deleted";
        
    }
    else{
        $error = "Users has not been Deleted";
    }
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
           $bulk_del_query =  "DELETE FROM `users` WHERE `users`.`id` = $user_id";
           mysqli_query($connection, $bulk_del_query);
       }
       else if($bulk_option == 'author'){
           $bulk_author_query = "UPDATE `users` SET `role` = 'author' WHERE `users`.`id` = '$user_id'";
           mysqli_query($connection, $bulk_author_query);
       }
       else if($bulk_option == 'admin'){
           $bulk_admin_query = "UPDATE `users` SET `role` = 'admin' WHERE `users`.`id` = '$user_id'";
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
                <h1><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg>
                Users
                <small>View All Users</small>
                
                </h1>
                
                   <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">
                                Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Users</li>
                        </ol>
                        
                        <?php
                        
                        $query = "SELECT * FROM users ORDER BY id ASC";
                        $run = mysqli_query($connection,$query);
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
                                                <option value="author">Change to Author</option>
                                                <option value="admin">Change to Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn btn-success" value="Apply">
                                            <a href="add_user.php" class="btn btn-primary">Add New</a>
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
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    
                                    <th>Role</th>
                                    
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                while($row = mysqli_fetch_array($run)){
                                    $id = $row ['id'];
                                    $first_name = ucfirst($row ['first_name']);
                                    $last_name = ucfirst($row ['last_name']);
                                    $email = $row ['email'];
                                    $username = $row ['username'];
                                    $role = $row ['role'];
                                    $image = $row ['image'];
                                    $date = getdate($row ['date']);
                                    $day = $date['mday'];
                                    $month = substr($date['month'],0,3);
                                    $year = $date['year'];
                                    
                               
                                
                                ?>
                               
                                <tr>
                                   <th><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></th>
                                    <td><?php echo $id;?></td>
                                    <td><?php echo "$day $month $year";?></td>
                                    <td><?php echo "$first_name $last_name";?></td>
                                    <td><?php echo $username;?></td>
                                    <td><?php echo $email;?></td>
                                    <td><img src="image/<?php echo $image;?>" alt="Profile Picture" width="30px" class="avatar"></td>
                                  
                                    <td><?php echo ucfirst($role);?></td>
                                    
                                    <td><a href="edit_user.php?edit=<?php echo $id;?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg></a></td>
                                    <td><a href="users.php?del=<?php echo $id;?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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