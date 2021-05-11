 <?php require_once('include/top.php');
if(!isset($_SESSION['username'])){
    header('location:login.php');
    
}
else if(isset($_SESSION['username']) && $_SESSION['role'] == 'author'){
    header('location: index.php');
}
$session_username = $_SESSION['username'];

?>
 <?php

if(isset($_GET['del'])){
    $del_id  = $_GET['del'];
   $del_check_query = "SELECT * FROM comments WHERE id= $del_id";
   $del_check_run = mysqli_query($connection,$del_check_query);
    if(mysqli_num_rows($del_check_run)>0){
         $del_query = "DELETE FROM `comments` WHERE `comments`.`id` = $del_id";
    if(isset($_SESSION['username']) && $_SESSION['role'] == 'admin'){
        if(mysqli_query($connection,$del_query)){
        $msg = "Comments has been Deleted";
        
    }
    else{
        $error = "Comments has not been Deleted";
    }
    }
    }
    else{
        header('location: index.php');
    }
}



if(isset($_GET['approve'])){
    $approve_id  = $_GET['approve'];
   $approve_check_query = "SELECT * FROM comments WHERE id= $approve_id";
   $approve_check_run = mysqli_query($connection,$approve_check_query);
    if(mysqli_num_rows($approve_check_run) > 0 ){
         $approve_query = "UPDATE `comments` SET `status` = 'approve' WHERE `comments`.`id` = '$approve_id'";
    if(isset($_SESSION['username']) && $_SESSION['role'] == 'admin'){
        if(mysqli_query($connection,$approve_query)){
        $msg = "Comments has been Approved";
        
    }
    else{
        $error = "Comments has not been Approved";
    }
    }
    }
    else{
        header('location: index.php');
    }
}

if(isset($_GET['unapprove'])){
    $unapprove_id  = $_GET['unapprove'];
   $unapprove_check_query = "SELECT * FROM comments WHERE id= $unapprove_id";
   $unapprove_check_run = mysqli_query($connection,$unapprove_check_query);
    if(mysqli_num_rows($unapprove_check_run)>0){
         $unapprove_query = "UPDATE `comments` SET `status` = 'pending' WHERE `comments`.`id` = '$unapprove_id'";
    if(isset($_SESSION['username']) && $_SESSION['role'] == 'admin'){
        if(mysqli_query($connection,$unapprove_query)){
        $msg = "Comments has been Unapproved";
        
    }
    else{
        $error = "Comments has not been Unapproved";
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
           $bulk_del_query =  "DELETE FROM `comments` WHERE `comments`.`id` = $user_id";
           mysqli_query($connection, $bulk_del_query);
       }
       else if($bulk_option == 'approve'){
           $bulk_author_query = "UPDATE `comments` SET `status` = 'approve' WHERE `comments`.`id` = '$user_id'";
           mysqli_query($connection, $bulk_author_query);
       }
       else if($bulk_option == 'pending'){
           $bulk_admin_query = "UPDATE `comments` SET `status` = 'pending' WHERE `comments`.`id` = '$user_id'";
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
                <h1><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg>
                Comments
                <small>View All Comments</small>
                
                </h1>
                
                   <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">
                                Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Comments</li>
                        </ol>
                        <?php
                
                if(isset($_GET['reply'])){
                    $reply_id = $_GET['reply'];
                    
                    $reply_check = "SELECT * FROM comments WHERE post_id=$reply_id";
                    
                    $reply_check_run = mysqli_query($connection,$reply_check);
                    if(mysqli_num_rows($reply_check_run) > 0){
                        
                        if(isset($_POST['reply'])){
                            $comment_data = $_POST['comment'];
                            if(empty($comment_data)){
                                $comment_error  = "Must Fill This Form";
                            }
                            else{
                                $get_user_data_query = "SELECT * FROM users WHERE username='$session_username'";
                                $get_user_run = mysqli_query($connection,$get_user_data_query);
                                $get_user_row = mysqli_fetch_array($get_user_run);
                                $date = time();
                                $first_name = $get_user_row['first_name'];
                                $last_name = $get_user_row['last_name'];
                                $full_name = "$first_name $last_name";
                                $email = $get_user_row['email'];
                                $image = $get_user_row['image'];
                                
                                $insert_comment_query = "INSERT INTO comments(date,name,username,post_id,email,image,comment,status) VALUES('$date','$full_name','$session_username','$reply_id','$email','$image','$comment_data','approve')";
                                if(mysqli_query($connection,$insert_comment_query)){
                                    $comment_msg = "Comment has Been Submitted";
                                    header('location: comments.php');
                                }
                                else{
                                    $comment_error = "Comment has Not been Submitted";
                                }
                            }
                        }
                   
                        ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-812 col-md-6 col-lg-6">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="comment">Comments: </label>
                                        <?php
                                    if(isset($comment_error)){
                                    echo "<span class='float-right text-danger'>$comment_error</span>";
                                }
                                else if(isset($comment_msg)){
                                    echo "<span class='float-right text-success'>$comment_msg</span>";
                                    
                                }
                ?>
                                        
                                        <textarea style="overflow:auto;resize:none" name="comment" id="comment" cols="30" rows="10" placeholder="Your Comment Here" class="form-control"></textarea>
                                    </div>
                                    <input type="submit" name="reply" class="btn btn-primary" value="Reply">
                                </form>
                            </div>
                        </div>
                        <hr>
                        <?php
                         }
                            }
                        $query = "SELECT * FROM comments ORDER BY id ASC";
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
                                                <option value="approve">Approve</option>
                                                <option value="pending">Unapprove</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn btn-success" value="Apply">
                                            
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
                                    <th>Username</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    
                                    <th>Approve</th>
                                    
                                    <th>Unapprove</th>
                                    <th>Reply</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                while($row = mysqli_fetch_array($run)){
                                    $id = $row ['id'];
                                    $username = $row ['username'];
                                    $status = $row ['status'];
                                    $comment = $row ['comment'];
                                    $post_id = $row ['post_id'];
                                    $date = getdate($row ['date']);
                                    $day = $date['mday'];
                                    $month = substr($date['month'],0,3);
                                    $year = $date['year'];
                                    
                               
                                
                                ?>
                               
                                <tr>
                                   <th><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></th>
                                    <td><?php echo $id;?></td>
                                    <td><?php echo "$day $month $year";?></td>
                                    
                                    <td><?php echo $username;?></td>
                                   <td><?php echo $comment;?></td>
                                   <td><span style="color:<?php 
                                       if($status == 'approve'){
                                           echo 'green';
                                       }
                                    else if($status == 'pending'){
                                       echo 'red';
                                    }
                                    
                                       ?>"><?php echo ucfirst($status);?></span></td>
                                    <td><a href="comments.php?approve=<?php echo $id;?>">Approve</a></td>
                                   <td><a href="comments.php?unapprove=<?php echo $id;?>">Unapprove</a></td>
                                    
                                    
                                    <td><a href="comments.php?reply=<?php echo $post_id;?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-right-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2 1h12a1 1 0 0 1 1 1v11.586l-2-2A2 2 0 0 0 11.586 11H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z"/>
  <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg></a></td>
                                    <td><a href="comments.php?del=<?php echo $id;?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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