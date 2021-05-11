 <?php require_once('include/top.php');

# check the valid username
if(!isset($_SESSION['username'])){
    header('location: login.php');
    
}

$session_username = $_SESSION['username'];
$session_author_image = $_SESSION['author_image'];

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
                <h1><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7.5 1.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V11a.5.5 0 0 0 1 0V9.5H10a.5.5 0 0 0 0-1H8.5V7z"/>
</svg>
                Add Posts
                <small>Add Some Posts</small>
                
                </h1>
                
               
                   <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">
                                Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Add Posts</li>
                        </ol>
                        
                        
                        <?php
                
                #if submit is clicked do this job
                if(isset($_POST['submit'])){
                    $date = time();
                    $title = mysqli_real_escape_string($connection,$_POST['title']);
                    $post_data = mysqli_real_escape_string($connection,$_POST['post-data']);
                    $categories = $_POST['categories'];
                    $tags = mysqli_real_escape_string($connection,$_POST['tags']);
                    $status = $_POST['status'];
                    $image = $_FILES['image']['name'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    #check all the fields are filled correctly
                    if(empty($title) or empty($post_data) or empty($tags) or empty($image)){
                        $error = "All Star Fields are Required";
                    }
                    else{
                        # insert the inputted data to the database
                        $insert_query = "INSERT INTO posts(date,title,author,author_image,image,categories,tags,post_data,views,status) VALUES ('$date','$title','$session_username','$session_author_image','$image','$categories','$tags','$post_data','0','$status')";
                        if(mysqli_query($connection,$insert_query)){
                            $msg = "Post has been Added";
                            $path = "image/$image";
                            $title = "";
                            $post_data = "";
                            $tags = "";
                            $status = "";
                            $categories = "";
                            if(move_uploaded_file($tmp_name, $path)){
                                copy($path,"../$path");
                        }
                        else{
                            $error = "Post has not been Added";
                        }
                    }
                    
                }
                }
                ?>
                        
                        <div class="row">
                            <div class="col-12">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="title">Title<small>*</small>: </label>
                                      <?php
                                      if(isset($error)){
                                    echo "<span class='float-right text-danger'>$error</span>";
                                }
                                else if(isset($msg)){
                                    echo "<span class='float-right text-success'>$msg</span>";
                                    
                                }
                               ?>
                                        <input type="text" name="title" placeholder="Type Post Title Here" value="<?php if(isset($title)) { echo $title; }?>" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                      <a href="media.php" class="btn btn-primary">Add Media: </a>
                                    </div>
                                    
                                    <div class="form-group">
                                       <textarea style="overflow:auto;resize:none" name="post-data" id="textarea" rows="10" class="form-control" ><?php if(isset($post_data)) { echo $post_data; }?></textarea>
                                       
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                              <div class="form-group">
                                        <label for="file">Post Image<small>*</small>: </label><hr>
                                       
                                        <input type="file" name="image">
                                    </div>
                                            
                                        </div>
                                        <div class="col-sm-6">
                                            
                                              <div class="form-group">
                                        <label for="categories">Categories: </label>
                                        <select class="form-control" name="categories" id="categories">
                                           <?php
                                            $cat_query = "SELECT * FROM categories ORDER BY id ASC";
                                            $cat_run = mysqli_query($connection,$cat_query);
                                            if(mysqli_num_rows($cat_run) > 0){
                                                while($cat_row = mysqli_fetch_array($cat_run)){
                                                   
                                                    $cat_name = $cat_row['category'];
                                                    echo "<option value='".$cat_name."' ".((isset($categories) and $categories == $cat_name)?"selected":"").">".ucfirst($cat_name)."</option>";
                                                }
                                                
                                                
                                            }
                                            else{
                                            echo "<center><h2>No Category Available</h2></center>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                              <div class="form-group">
                                        <label for="tags">Tags<small>*</small>: </label>
                                        <input type="text" name="tags" placeholder="Tags Here"  value="<?php if(isset($tags)) { echo $tags; }?>" class="form-control">
                                    </div>
                                            
                                        </div>
                                        <div class="col-sm-6">
                                            
                                              <div class="form-group">
                                        <label for="status">Status: </label>
                                        
                                        <!-- make the control form -->
                                        <select class="form-control" name="status" id="status">
                                            <option value="publish" <?php if(isset($status) and $status =='publish') {echo "selected";} ?>>Publish</option>
                                            <option value="draft" <?php if(isset($status) and $status =='draft') {echo "selected";} ?>>Draft</option>
                                        </select>
                                    </div>
                                        </div>
                                    </div>
                                    
                                    <input type="submit" class="btn btn-primary" value="Add Post" name="submit">
                                </form>
                            </div>
                        </div>
                        
                
            </div>
        </div>
    </div>

     <?php require_once('include/footer.php');?>