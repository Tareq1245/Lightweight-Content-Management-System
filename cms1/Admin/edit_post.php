 <?php require_once('include/top.php');

if(!isset($_SESSION['username'])){
    header('location: login.php');
    
}

$session_username = $_SESSION['username'];
$session_role = $_SESSION['role'];
$session_author_image = $_SESSION['author_image'];

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
   if($session_role == 'admin'){
        $get_query = "SELECT * FROM posts WHERE id = $edit_id";
    $get_run = mysqli_query($connection,$get_query);
   }
    else if($session_role == 'author'){
         $get_query = "SELECT * FROM posts WHERE id = $edit_id and author='$session_username'";
    $get_run = mysqli_query($connection,$get_query);
    }
    
    if(mysqli_num_rows($get_run) > 0){
        $get_row = mysqli_fetch_array($get_run);
        $title = $get_row['title'];
        $post_data = $get_row['post_data'];
        $tags = $get_row['tags'];
        $image = $get_row['image'];
        $status = $get_row['status'];
        $categories = $get_row['categories'];
    }
    else{
        header('location: post.php');
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
                <h1><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg>
                Edit Posts
                <small>Edit Something from Posts</small>
                
                </h1>
                
               
                   <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">
                                Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Edit Posts</li>
                        </ol>
                        
                        
                        <?php
                
                if(isset($_POST['update'])){
                    
                    $up_title = mysqli_real_escape_string($connection,$_POST['title']);
                    $up_post_data = mysqli_real_escape_string($connection,$_POST['post-data']);
                    $up_categories = $_POST['categories'];
                    $up_tags = mysqli_real_escape_string($connection,$_POST['tags']);
                    $up_status = $_POST['status'];
                    $up_image = $_FILES['image']['name'];
                    $up_tmp_name = $_FILES['image']['tmp_name'];
                    
                    if(empty($up_image)){
                        $up_image = $image;
                    }
                    
                    if(empty($up_title) or empty($up_post_data) or empty($up_tags) or empty($up_image)){
                        $error = "All (*) Fields are Required";
                    }
                    else{
                        $update_query = "UPDATE posts SET title = '$up_title', image='$up_image', categories = '$up_categories', tags = '$up_tags' , post_data = '$up_post_data', status = '$up_status' WHERE id = $edit_id";
                        if(mysqli_query($connection,$update_query)){
                            $msg = "Post has been Updated";
                            $path = "image/$up_image";
                            header("location: edit_post.php?edit=$edit_id");
                           if(!empty($up_image)){
                                 if(move_uploaded_file($up_tmp_name, $path)){
                                copy($path,"../$path");
                                   }
                           }
                          
                        else{
                            $error = "Post has not been Updated";
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
                                        <select class="form-control" name="status" id="status">
                                            <option value="publish" <?php if(isset($status) and $status =='publish') {echo "selected";} ?>>Publish</option>
                                            <option value="draft" <?php if(isset($status) and $status =='draft') {echo "selected";} ?>>Draft</option>
                                        </select>
                                    </div>
                                        </div>
                                    </div>
                                    
                                    <input type="submit" class="btn btn-primary" value="Update Post" name="update">
                                </form>
                            </div>
                        </div>
                        
                
            </div>
        </div>
    </div>

     <?php require_once('include/footer.php');?>