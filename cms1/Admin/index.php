<?php require_once('include/top.php');

if(!isset($_SESSION['username'])){
    header('location:login.php');
    
}

 $session_role3 = $_SESSION['role'];

$comment_tag_query = "SELECT * FROM comments WHERE status = 'pending'";
$category_tag_query = "SELECT * FROM categories";
$users_tag_query = "SELECT * FROM users";
$posts_tag_query = "SELECT * FROM posts";

$c_tag_run = mysqli_query($connection,$comment_tag_query);
$cat_tag_run = mysqli_query($connection,$category_tag_query);
$user_tag_run = mysqli_query($connection,$users_tag_query);
$post_tag_run = mysqli_query($connection,$posts_tag_query);

$com_rows = mysqli_num_rows($c_tag_run);
$cat_rows = mysqli_num_rows($cat_tag_run);
$user_rows = mysqli_num_rows($user_tag_run);
$post_rows = mysqli_num_rows($post_tag_run);

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
                <h1><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cloud" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
</svg>
                Dashboard
                <small>Script Overview</small>
                
                </h1>
                
               <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">
                    Dashboard</li>
                    </ol>
                    <div class="row tag-boxes">
                       <?php 
                        if($session_role1 == 'admin'){
         
   
       ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-3 icon">
                                            <svg width="5em" height="3em" viewBox="0 0 16 16" class="bi bi-chat" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
</svg>
                                        </div>
                                        <div class="col-9">
                                            <div class="text-right huge"><?php echo $com_rows; ?></div>
                                            <div class="text-right huge1">New Comments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="comments.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View All Comments</span>
                                        <span class="pull-right"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-11.5.5a.5.5 0 0 1 0-1h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5z"/>
</svg></span>
                                   <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        <?php } ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-3 icon">
                                            <svg width="5em" height="3em" viewBox="0 0 16 16" class="bi bi-card-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path fill-rule="evenodd" d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
</svg>
                                        </div>
                                        <div class="col-9">
                                            <div class="text-right huge"><?php echo $post_rows; ?></div>
                                            <div class="text-right huge1">New Posts</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View All Posts</span>
                                        <span class="pull-right"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-11.5.5a.5.5 0 0 1 0-1h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5z"/>
</svg></span>
                                   <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                                       <?php 
                        if($session_role1 == 'admin'){
         
   
       ?>
                        
                        <div class="col-md-6 col-lg-3">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-3 icon">
                                            <svg width="5em" height="3em" viewBox="0 0 16 16" class="bi bi-tags-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 7.586 1H3zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
  <path d="M1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"/>
</svg>
                                        </div>
                                        <div class="col-9">
                                            <div class="text-right huge"><?php echo $cat_rows; ?></div>
                                            <div class="text-right huge1">All Categories</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="categories.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View All Categories</span>
                                        <span class="pull-right"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-11.5.5a.5.5 0 0 1 0-1h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5z"/>
</svg></span>
                                   <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-3 icon">
                                            <svg width="5em" height="3em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg>
                                        </div>
                                        <div class="col-9">
                                            <div class="text-right huge"><?php echo $user_rows; ?></div>
                                            <div class="text-right huge1">New Users</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="users.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View All Users</span>
                                        <span class="pull-right"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-11.5.5a.5.5 0 0 1 0-1h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5z"/>
</svg></span>
                                   <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <hr>
                    <?php
                  
                        if($session_role1 == 'admin'){
      
     
                $get_users_query = "SELECT * FROM users ORDER BY id DESC LIMIT 5";
                
                $get_users_run = mysqli_query($connection,$get_users_query);
                if(mysqli_num_rows($get_users_run)){
                    
                    ?>
                    <h3>New Users</h3>
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Serial Number </th>
                                <th>Date</th>
                                <th>Name </th>
                                <th>User Name </th>
                                <th>Role </th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                            while($get_users_row = mysqli_fetch_array($get_users_run)){
                                $get_id = $get_users_row['id'];
                               $get_date = getdate($get_users_row ['date']);
                                    $day = $get_date['mday'];
                                    $month = substr($get_date['month'],0,3);
                                    $year = $get_date['year'];
                                $get_first_name = $get_users_row['first_name'];
                                $get_last_name = $get_users_row['last_name'];
                                $get_username = $get_users_row['username'];
                                $get_role = $get_users_row['role'];
                            
                            ?>
                            <tr>
                                <td><?php echo $get_id;?> </td>
                                <td><?php echo "$day $month $year";?></td>
                                <td><?php echo "$get_first_name $get_last_name";?></td>
                                <td><?php echo ucfirst($get_username);?></td>
                                <td><?php echo $get_role;?></td>
                            </tr>
                           <?php
                            }
                            ?> 
                        </tbody>
                    </table>
                    <a href="users.php" class="btn btn-primary">View All Users</a><hr>
                    <?php
                }
                    ?>
                    
                      <?php
                
                $get_posts_query = "SELECT * FROM posts ORDER BY id DESC LIMIT 5";
                
                $get_posts_run = mysqli_query($connection,$get_posts_query);
                if(mysqli_num_rows($get_posts_run)){
                    
                    ?>
                    
                    <h3>New Posts</h3>
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Serial Number </th>
                                <th>Date</th>
                                <th>Post Title </th>
                                <th>Category </th>
                                <th>Views </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($get_posts_row = mysqli_fetch_array($get_posts_run)){
                                $get_posts_id = $get_posts_row['id'];
                               $get_posts_date = getdate($get_posts_row ['date']);
                                    $day = $get_posts_date['mday'];
                                    $month = substr($get_posts_date['month'],0,3);
                                    $year = $get_posts_date['year'];
                                $get_posts_title = $get_posts_row['title'];
                                $get_posts_category = $get_posts_row['categories'];
                                $get_posts_view = $get_posts_row['views'];
                                
                            
                            ?>
                            <tr>
                                <td><?php echo $get_posts_id;?> </td>
                                <td><?php echo "$day $month $year";?></td>
                                <td><?php echo ucfirst($get_posts_title);?></td>
                                <td><?php echo ucfirst($get_posts_category);?></td>
                                <td><i><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
</svg></i><?php echo $get_posts_view;?></td>
                            </tr>
                            
                              <?php
                            }
                            ?> 
                        </tbody>
                        
                </table>
                
                <a href="posts.php" class="btn btn-primary">View All Posts</a><hr>
                 <?php
                }
                        }
                    ?>
            </div>
        </div>
    </div>
    
     <?php require_once('include/footer.php');?>