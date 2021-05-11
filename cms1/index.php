<?php require_once('include/top.php');?>
  </head>
  <body>
   <!-- As a link -->
<?php require_once('include/header.php');
      
      
      $number_of_posts = 2;
      
      if(isset($_GET['page'])){
          $page_id = $_GET['page'];
      }
      else{
          $page_id = 1;
      }
      
      if(isset($_GET['cat'])){
          $cat_id = ($_GET['cat']);
          $cat_query = "SELECT * FROM categories WHERE id=$cat_id";
          $cat_run = mysqli_query($connection,$cat_query);
          $cat_row = mysqli_fetch_array($cat_run);
          $cat_name = $cat_row['category'];
      }
      $all_posts_query = "SELECT * FROM posts WHERE status = 'publish'";
       if(isset($cat_name)){
                     $all_posts_query .= " and categories = '$cat_name'";
                 }
      $all_posts_run = mysqli_query($connection,$all_posts_query);
      $all_posts = mysqli_num_rows($all_posts_run);
      $total_pages = ceil($all_posts / $number_of_posts);
      $posts_start_from = ($page_id-1) * $number_of_posts;
      
      ?>
 
 <div class="jumbotron">
     <div class="container">
         <div id="details" class="animated fadeInLeft">
             <h1>Tareq Hossain<span>Blog</span></h1>
             <p>Big thing takes Times</p>
         </div>
         
     </div>
     <img src="image/B4.jpg" alt="Top Image">
 </div>
 
 <section>
     <div class="container">
         <div class="row">
             <div class="col-md-8">
             
             <?php
                 $slider_query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY id DESC LIMIT 5";
                     
                 $slider_run = mysqli_query($connection, $slider_query);
                 
                 if(mysqli_num_rows($slider_run) > 0){
                     
                     $count = mysqli_num_rows($slider_run);
                     ?>
           
             <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <?php
      for($i = 0; $i < $count; $i++){
          if($i == 0){
              echo "<li data-target='#carouselExampleCaptions' data-slide-to='".$i."' class='active'></li>";
          }
          
          else{
              echo "<li data-target='#carouselExampleCaptions' data-slide-to='".$i."' ></li>";
          }
      }
        
      ?>
  </ol>
  <div class="carousel-inner" role="listbox">
   <?php
                     $check = 0;
      while($slider_row = mysqli_fetch_array($slider_run)){
          $slider_id = $slider_row['id'];
          $slider_image = $slider_row['image'];
          $slider_title = $slider_row['title'];
          $check = $check + 1;
          if($check == 1){
              echo "<div class='carousel-item active'>";
          }
          else{
               echo "<div class='carousel-item'>";
          }
     
      
      ?>
   
     <a href="post.php?post_id=<?php echo $slider_id;?>"> <img src="image/<?php echo $slider_image;?>" class="d-block w-100" alt="Slider 1"></a>
      <div class="carousel-caption d-none d-md-block">
        <h5><?php echo $slider_title;?></h5>
      </div>
      
    </div>
       <?php 
        }
        ?>
  </div>
  
  
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
            
            <?php
               }  
                 ?> 
             <?php
                 
                 if(isset($_POST['search'])){
                     $search = $_POST['search-title'];
                     
                     $query = "SELECT * FROM posts WHERE status = 'publish'";
                     $query .= " and tags LIKE '%$search%'";
                     $query .= " ORDER BY id DESC LIMIT $posts_start_from,$number_of_posts";
                 }
                 else{
                     $query = "SELECT * FROM posts WHERE status = 'publish'";
                 if(isset($cat_name)){
                     $query .= " and categories = '$cat_name'";
                 }
                 
                 $query .= " ORDER BY id DESC LIMIT $posts_start_from,$number_of_posts";
                 }
                 $run = mysqli_query($connection, $query);
                 if(mysqli_num_rows($run) > 0){
                     while($row = mysqli_fetch_array($run)){
                         $id = $row ['id'];
                         $date = getdate($row ['date']);
                         $day = $date['mday'];
                         $month = $date['month'];
                         $year = $date['year'];
                         $title = $row ['title'];
                         $author = $row ['author'];
                         $author_image = $row ['author_image'];
                         $image = $row ['image'];
                         $categories = $row ['categories'];
                         $tags = $row ['tags'];
                         $post_data = $row ['post_data'];
                         $views = $row ['views'];
                         $status = $row ['status'];
                  
                 
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
                         <img src="image/<?php echo $author_image;?>" alt="profile-picture" class="rounded-circle" width="100%">
                     </div>
                 </div>
                 
                 <a href="post.php?post_id=<?php echo $id;?>"><img src="image/<?php echo $image;?>" alt="post image"></a>
                 <p class="description">
                     <?php echo substr($post_data,0,200).".....";?>
                 </p>
                 <a href="post.php?post_id=<?php echo $id;?>" class="btn btn-primary">Read More</a>
                 <div class="bottom">
                     <span class="first" ><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder2-open" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
</svg><a href="#"> <?php echo ucfirst($categories);?>   </a></span>
 
 <span class="second" ><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-right-dots-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
</svg><a href="#"> Comment</a></span>
                 </div>
                 
                 
     
             </div>
             
             <?php
                    }
                 }
                 
                 else{
                     echo"<center><h2>No post Yet</h2></center>";
                 }
                 ?>
             <nav aria-label="...">
  <ul class="pagination">
    <?php
      for($i = 1; $i <= $total_pages; $i++){
          echo "<li class='page-item ".($page_id == $i ? 'active' :"")."'><a class='page-link' href='index.php?page=".$i."&".(isset($cat_name) ?"cat=$cat_id" :"")."'>$i</a></li>";
      }
      ?>
  </ul>
</nav>
             </div>
           
             
             
             <div class="col-md-4">
                 <?php require_once('include/sidebar.php');?>
                   
                 </div>
                   
    
             </div>
         </div>
        
 </section>
  
 <?php require_once('include/footer.php');?>