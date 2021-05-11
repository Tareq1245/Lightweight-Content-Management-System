<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">
      <div class="col-xs-3"><img src="image/wechat.png" alt="logo" width="30px"></div>
      <div class="col-xs-9">Tareq</div>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Pages
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          
          <a class="dropdown-item" href="../cms/Admin/index.php">Go to Admin</a>
          <div class="dropdown-divider"></div>
          
        </div>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
         <?php
            $query = "SELECT * FROM categories ORDER BY id ASC";
            $run = mysqli_query($connection,$query);
            if(mysqli_num_rows($run) > 0){
                while($row = mysqli_fetch_array($run)){
                    $category = ucfirst($row['category']);
                    $id = $row['id'];
                    echo "<a class='dropdown-item' href='index.php?cat=".$id."'>$category</a>";
                }
            }
            
            else{
                echo "<a class='dropdown-item' href='#'>Nothing Yet</a>";
            }
            ?>
            
        </div>
      </li>
      
     
       <li class="nav-item active">
        <a class="nav-link" href="contact_us.php">Contact Us <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    
  </div>
</nav>