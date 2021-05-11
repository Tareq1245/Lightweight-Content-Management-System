<?php

#check the role of the users
 $session_role1 = $_SESSION['role'];
#select all pending comments
$comment_tag_query = "SELECT * FROM comments WHERE status = 'pending'";
$category_tag_query = "SELECT * FROM categories";
$users_tag_query = "SELECT * FROM users";
$posts_tag_query = "SELECT * FROM posts";
$media_tag_query = "SELECT * FROM media";

#run the queries
$c_tag_run = mysqli_query($connection,$comment_tag_query);
$cat_tag_run = mysqli_query($connection,$category_tag_query);
$user_tag_run = mysqli_query($connection,$users_tag_query);
$post_tag_run = mysqli_query($connection,$posts_tag_query);
$media_tag_run = mysqli_query($connection,$media_tag_query);

$com_rows = mysqli_num_rows($c_tag_run);
$cat_rows = mysqli_num_rows($cat_tag_run);
$user_rows = mysqli_num_rows($user_tag_run);
$post_rows = mysqli_num_rows($post_tag_run);
$media_rows = mysqli_num_rows($media_tag_run);


?>
 
 <!-- create list Group -->

 <ul class="list-group">
  <a href="index.php" class="list-group-item list-group-item-action active">
   <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cloud" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
</svg>
    Dashboard
  </a>
  <a href="posts.php">
  <li class="list-group-item d-flex justify-content-between align-items-center">
   <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path fill-rule="evenodd" d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
</svg> Posts
    <span class="badge badge-primary badge-pill"><?php echo $post_rows; ?></span>
  </li>
  </a>
   <a href="media.php">
  <li class="list-group-item d-flex justify-content-between align-items-center">
   <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wallet-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542.637 0 .987-.254 1.194-.542.226-.314.306-.705.306-.958a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path d="M16 6.5h-5.551a2.678 2.678 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5c-.963 0-1.613-.412-2.006-.958A2.679 2.679 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6z"/>
</svg>
   
    Media
    <span class="badge badge-primary badge-pill"><?php echo $media_rows; ?></span>
       </li>
  </a>
  <?php
     
      #check role is it Admin or not 
     if($session_role1 == 'admin'){
         
   
       ?>
  <a href="comments.php">
  <li class="list-group-item d-flex justify-content-between align-items-center">
   <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-right-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2 1h12a1 1 0 0 1 1 1v11.586l-2-2A2 2 0 0 0 11.586 11H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z"/>
  <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg> Comments
  <span class="badge badge-primary badge-pill"><?php echo $com_rows; ?></span>
  </li>
  </a>
  <a href="categories.php">
  <li class="list-group-item d-flex justify-content-between align-items-center">
   <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tags-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 7.586 1H3zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
  <path d="M1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"/>
</svg>
    Categories
   <span class="badge badge-primary badge-pill"><?php echo $cat_rows; ?></span>
  </li>
  </a>
  <a href="users.php">
  <li class="list-group-item d-flex justify-content-between align-items-center">
  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg>
   
    Users
    <span class="badge badge-primary badge-pill"><?php echo $user_rows; ?></span>
  </li>
  </a>
  
  <?php 
     }
     ?>
     </ul>
