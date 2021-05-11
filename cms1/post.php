<?php require_once('include/top.php');?>
</head>
  <body>
   <!-- As a link -->
<?php require_once('include/header.php');?>


 
 <div class="jumbotron">
     <div class="container">
         <div id="details" class="animated fadeInLeft">
             <h1>Post <span>Here</span></h1>
             <p>Post Anything you love.</p>
         </div>
         
     </div>
     <img src="image/B1.jpg" alt="Top Image">
 </div>
 
 <section>
     <div class="container">
         <div class="row">
             <div class="col-md-8">
            <?php
      if(isset($_GET['post_id'])){
          $post_id = $_GET['post_id'];
          
          $views_query =" UPDATE `posts` SET `views` = views + 1 WHERE `posts`.`id` = $post_id";
          mysqli_query($connection,$views_query);
          $query = "SELECT * FROM posts WHERE status = 'publish' and id=$post_id";
          $run = mysqli_query($connection,$query);
          
          if(mysqli_num_rows($run) > 0){
             $row = mysqli_fetch_array($run);
              $id = $row['id'];
              $date = getdate($row ['date']);
              $day = $date['mday'];
              $month = $date['month'];
              $year = $date['year'];
              $title = $row['title'];
              $image = $row['image'];
              $author_image = $row['author_image'];
              $author = $row['author'];
              $categories = $row['categories'];
              $post_data = $row['post_data'];
               }
         
           else{
              header('Location: index.php'); 
          }
      }
        
 
      ?>
              <div class="post">
                 <div class="row">
                     <div class="col-md-2 post-date">
                         <div class="day"><?php echo $day;?></div>
                         <div class="month"><?php echo $month;?></div>
                         <div class="year"><?php echo $year;?></div>
                     </div>
                     <div class="col-md-8 post-title">
                         <a href="post.php?post_id=<?php echo $id;?>"><h2><?php echo $title;?></h2></a>
                         <p>Written By: <span><?php echo ucfirst($author);?></span></p>
                     </div>
                     <div class="col-md-2 profile-picture">
                         <img src="image/<?php echo $author_image;?>"alt="profile-picture" class="rounded-circle">
                     </div>
                 </div>
                 
                 <a href="image/<?php echo $image;?>"><img src="image/<?php echo $image;?>" alt="post image"></a>
                 <div class="description">
                     <?php echo $post_data;?>
                 </div><br>
                 
                 <div class="bottom">
                     <span class="first" ><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder2-open" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
</svg><a href="#"><?php echo ucfirst($categories);?></a></span>
 
 <span class="second" ><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-right-dots-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
</svg><a href="#"> Comment</a></span>
                 </div>
                 
                 
     
             </div>
             
             
             
             <div class="related-posts">
                <h3>Related Posts</h3><hr>
                 <div class="row">
                    
                     <?php
                     $r_query = "SELECT * FROM posts WHERE status='publish' AND title LIKE '%$title%' LIMIT 3";
                     
                     $r_run = mysqli_query($connection, $r_query);
                     while($r_row = mysqli_fetch_array($r_run)){
                         $r_id = $r_row['id'];
                          $r_title = $r_row['title'];
                          $r_image = $r_row['image'];
                     
                     ?>
                     <div class="col-sm-4">
                          <a href="post.php?post_id=<?php echo $r_id;?>">
                             <img src="image/<?php echo $r_image;?>">
                             <h4><?php echo $r_title;?></h4>
                         </a>
                     </div>
                     <?php 
                     }
                     ?>
                     
                 </div>
             </div>
             
             <div class="author">
                 <div class="row">
                     <div class="col-sm-3">
                         <img src="image/<?php echo $author_image;?>" alt="Author" >
                     </div>
                     <div class="col-sm-9">
                         <h4><?php echo ucfirst($author);?></h4>
                         <?php
                         $bio_query = "SELECT * FROM users WHERE username = '$author'";
                         $bio_run = mysqli_query($connection,$bio_query);
                         if(mysqli_num_rows($bio_run) > 0){
                             $bio_row = mysqli_fetch_array($bio_run);
                             $author_details = $bio_row['details'];
                         
                         ?>
                         
                         <p><?php echo $author_details?></p>
                     <?php
                         
                         }
                         ?>
                     </div>
                 </div>
             </div>
             
             <?php
                 $c_query ="SELECT * FROM comments WHERE status = 'approve' and post_id=$post_id ORDER BY id DESC";
                 $c_run = mysqli_query($connection,$c_query);
                 if(mysqli_num_rows($c_run) > 0){
    
                 ?>
             
             <div class="comment">
                <h3>Comment Here</h3>
                
                <?php
                 while($c_row = mysqli_fetch_array($c_run)){
                     $c_id = $c_row['id'];
                     $c_name = $c_row['name'];
                     $c_username = $c_row['username'];
                     $c_image = $c_row['image'];
                     $c_comment = $c_row['comment'];
                     
                 
                 
                 ?>
                <hr>
                 <div class="row single-comment">
                     <div class="col-sm-2">
                         <img src="image/<?php echo $c_image;?>" alt="Profile Picture" class="rounded-circle">
                     </div>
                     <div class="col-sm-10">
                         <h4><?php echo ucfirst($c_name);?></h4>
                         
                         <p><?php echo $c_comment;?></p>
                     </div>
                 </div>
                 <?php
                 }
                 ?>
                 
             </div>
             
             <?php
                 }
                 else{
                     echo "No comment Yet";
                 }
                 
                 if(isset($_POST['submit'])){
                     $cs_name = $_POST['name'];
                     $cs_email = $_POST['email'];
                     $cs_website = $_POST['website'];
                     $cs_comment = $_POST['comment'];
                     $cs_date = time();
                     if(empty($cs_name) or empty($cs_email) or empty($cs_comment)){
                         $error_msg = "All (*) fields are Required";
                     }
                     else{
                         $cs_query = "INSERT INTO `comments` (`id`, `date`, `name`, `username`, `post_id`, `email`, `website`, `image`, `comment`, `status`) VALUES (NULL, '$cs_date', '$cs_name', 'tareq', '$post_id', '$cs_email', '$cs_website', 'pf2.jpg', '$cs_comment', 'pending')";
                         
                         if(mysqli_query($connection, $cs_query)){
                             $msg = "Comment has Submitted to Database and Waiting for Approval";
                             $cs_name = "";
                             $cs_email = "";
                             $cs_website = "";
                             $cs_comment = "";
                             
                         }
                         else{
                             $error_msg = "Comment Has not Submitted";
                         }
                     }
                 }
                                          
                 ?>
             
             <div class="comment-box">
                 <div class="row">
                     <div class="col-md-12">
                         <form action="" method="post">
                             <div class="form-group">
                                 <label for="full-name">Full Name: </label>
                                 <input type="text" id="full-name" class="form-control" placeholder="Full Name" name="name" value="<?php if(isset($cs_name)) { echo $cs_name; }?>">
                             </div>
                             
                             <div class="form-group">
                              <label for="email">Email*:</label>
                              <input type="text" id="email" class="form-control" placeholder="Email Address" name="email" value="<?php if(isset($cs_email)) { echo $cs_email; }?>">
                          </div>
                          
                          <div class="form-group">
                              <label for="website">Website:</label>
                              <input type="text" id="website" class="form-control" placeholder="Your Website" name="website" value="<?php if(isset($cs_website)) { echo $cs_website; }?>">
                          </div>
                          
                          <div class="form-group">
                              <label for="comment">Comment*:</label>
                              <textarea name="comment" id="message" cols="30" rows="10" class="form-control" placeholder="Comment Here" ><?php if(isset($cs_comment)) { echo $cs_comment; }?></textarea>
                          </div>
                          
                          <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                          <?php
                             if(isset($error_msg)){
                                 echo "<span class='float-right text-danger'>$error_msg</span>";
                             }
                     else if(isset($msg)){
                         echo "<span class='float-right text-success'>$msg</span>";
                     }
                             ?>
                         </form>
                     </div>
                 </div>
             </div>
             </div>
           
             
             
             <div class="col-md-4">
                 <?php require_once('include/sidebar.php');?>
                   
                 </div>
                   
    
             </div>
         </div>
        
 </section>
 
 
  <?php require_once('include/footer.php');?>
 