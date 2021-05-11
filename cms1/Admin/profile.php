<?php require_once('include/top.php');

if(!isset($_SESSION['username'])){
    header('location:login.php');  
}
$session_username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE username= '$session_username'";
$run = mysqli_query($connection, $query);
$row = mysqli_fetch_array($run);

$image = $row['image'];
$id = $row['id'];
$date = getdate($row ['date']);
$day = $date['mday'];
$month = substr($date['month'],0,3);
$year = $date['year'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$username = $row['username'];
$email = $row['email'];
$role = $row['role'];
$details = $row['details'];


?>
  </head>
  <body id="profile">
   <div id="wrapper">
       <?php require_once('include/header.php');?>
    <div class="container-fluid body-section">
        <div class="row">
            <div class="col-md-3">
                
                <?php require_once('include/sidebar.php');?>
            </div>
            <div class="col-md-9">
                <h1><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
  <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
  <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
</svg>
                Profile
                <small>Personal Details</small>
                
                </h1>
                
               <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">
                                Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Profile</li>
                        </ol>
                    <div class="row">
                        <div class="col-md-12">
                            <center><img src="image/<?php echo $image;?>" alt="Profile Picture" id="profile-image" width="200px" class="rounded-circle img-thumbnail"><hr>
                            <a href="edit_profile.php?edit=<?php echo $id;?>" class="btn btn-primary float-right" >Edit Profile</a>
                    <h3>Profile Details</h3>
                    </center><br>
                    <table class="table table-hover table-bordered table-striped">
                        <tr>
                            <td width="20%"><b>User ID:</b></td>
                            <td width="30%"><?php echo $id;?></td>
                            <td width="20%"><b>Signup Date:</b></td>
                            <td width="30%"> <?php echo "$day $month $year";?></td>
                        </tr>
                         <tr>
                            <td width="20%"><b>First Name:</b></td>
                            <td width="30%"><?php echo $first_name;?></td>
                            <td width="20%"><b>Last Name:</b></td>
                            <td width="30%"><?php echo $last_name;?></td>
                        </tr>
                         <tr>
                            <td width="20%"><b>Username:</b></td>
                            <td width="30%"><?php echo $username;?></td>
                            <td width="20%"><b>Email:</b></td>
                            <td width="30%"><?php echo $email;?></td>
                        </tr>
                         <tr>
                            <td width="20%"><b>Role:</b></td>
                            <td width="30%"><?php echo $role;?></td>
                            <td width="20%"><b></b></td>
                            <td width="30%"></td>
                        </tr>
                        
                    </table>
                       <div class="row">
                           <div class="col-lg-8 col-sm-12">
                               <b>Details:</b>
                                <div><?php echo $details;?></div>
                           </div>
                       </div><br>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
    
     <?php require_once('include/footer.php');?>