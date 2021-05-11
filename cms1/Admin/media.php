 <?php require_once('include/top.php');?>
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
                <h1><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wallet-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542.637 0 .987-.254 1.194-.542.226-.314.306-.705.306-.958a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path d="M16 6.5h-5.551a2.678 2.678 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5c-.963 0-1.613-.412-2.006-.958A2.679 2.679 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6z"/>
</svg>
                Media
                <small>Media Files</small>
                
                </h1>
                
               <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">
                Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                Media</li>
               </ol>
               
               
               <?php
                
                if(isset($_POST['submit'])){
                    if(count($_FILES['media']['name']) > 0){
                        for($i = 0; $i< count($_FILES['media']['name']); $i++){
                            $image = $_FILES['media']['name'][$i];
                            $tmp_name = $_FILES['media']['tmp_name'][$i];
                            
                            $query = "INSERT INTO media (image) VALUES ('$image')";
                            
                            if(mysqli_query($connection,$query)){
                                $path = "media/$image";
                                if(move_uploaded_file($tmp_name,$path)){
                                    copy($path,"../$path");
                            }
                        }
                    }
                }
                }
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-4 col-8">
                            <input type="file" name="media[]" required multiple>
                        </div>
                        <div class="col-sm-4 col-4">
                            <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Add Media">
                        </div>
                    </div>
                </form><hr>
                
                <div class="row">
                    
                    <?php 
                    $get_query = "SELECT * FROM media ORDER BY id ASC";
                    $get_run = mysqli_query($connection,$get_query);
                    if(mysqli_num_rows($get_run) > 0){
                        while($get_row = mysqli_fetch_array($get_run)){
                            $get_image = $get_row['image'];
                      
                   
                    ?>
                    
                    <div class="col-lg-2 col-md-3 col-sm-3 col-8">
                        <a href="media/<?php echo $get_image;?>" class="thumbnail">
                            <img class="img-thumbnail" src="media/<?php echo $get_image;?>" style="width:100%" alt="">
                        </a>
                    </div>
                    
                    <?php
                      }
                     }
                    else{
                        echo "<center><h2>No Media Files Available</h2></center>";
                    }
                    
                    ?>

                </div>
            </div>
        </div>
    </div>
    
     <?php require_once('include/footer.php');?>