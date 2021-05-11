<div class="widgets">
                    
                     <form class="form-inline my-2 my-lg-0" action="index.php" method="post">
                         
                          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search-title">
                          <input type="submit" value="Go" class="btn btn-primary" name="search">
                        </form>
                        
                 </div>
              
                 
                 <div class="widgets">
                     <div class="popular">
                        <h4>Recent Posts</h4>
                        <?php
                         $p_query = "SELECT * FROM  posts WHERE status='publish' ORDER BY id DESC LIMIT 3";
                         $p_run = mysqli_query($connection,$p_query);
                         if(mysqli_num_rows($p_run) > 0){
                             while($p_row = mysqli_fetch_array($p_run)){
                                 $p_id = $p_row['id'];
                                 $p_date = getdate($p_row ['date']);
                                 $p_day = $p_date['mday'];
                                 $p_month = $p_date['month'];
                                 $p_year = $p_date['year'];
                                 $p_title = $p_row['title'];
                                 $p_image = $p_row['image'];
                            
                        
                         
                         ?>
                        
                        <hr>
                         <div class="row">
                             <div class="col-xs-4">
                                 <a href="post.php?post_id=<?php echo $p_id;?>"><img src="image/<?php echo $p_image;?>" alt="image"></a>
                             </div>
                             <div class="col-xs-8 details">
                                 <a href="post.php?post_id=<?php echo $p_id;?>"><h4><?php echo $p_title;?></h4></a>
                                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
</svg><a> <?php echo "$p_day $p_month , $p_year";?></a>
                             </div>
                         </div>
                           <?php
                                  }
                          }
                         else{
                             echo "<h3>No Post Available</h3>";
                         }
                         ?>
                         
                     </div>
                 </div>
                 
                 <div class="widgets">
                     <div class="popular">
                        <h4>Popular Posts</h4>
                        <?php
                         $p_query = "SELECT * FROM  posts WHERE status='publish' ORDER BY views DESC LIMIT 3";
                         $p_run = mysqli_query($connection,$p_query);
                         if(mysqli_num_rows($p_run) > 0){
                             while($p_row = mysqli_fetch_array($p_run)){
                                 $p_id = $p_row['id'];
                                 $p_date = getdate($p_row ['date']);
                                 $p_day = $p_date['mday'];
                                 $p_month = $p_date['month'];
                                 $p_year = $p_date['year'];
                                 $p_title = $p_row['title'];
                                 $p_image = $p_row['image'];
                            
                        
                         
                         ?>
                        
                        <hr>
                         <div class="row">
                             <div class="col-xs-4">
                                 <a href="post.php?post_id=<?php echo $p_id;?>"><img src="image/<?php echo $p_image;?>" alt="Sidebar Image"></a>
                             </div>
                             <div class="col-xs-8 details">
                                 <a href="post.php?post_id=<?php echo $p_id;?>"><h4><?php echo $p_title;?></h4></a>
                                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
</svg><a> <?php echo "$p_day $p_month , $p_year";?></a>
                             </div>
                         </div>
                           <?php
                                  }
                          }
                         else{
                             echo "<h3>No Post Available</h3>";
                         }
                         ?>
                         
                     </div>
                 </div>
             
                                 <div class="widgets">
                     <div class="popular">
                        <h4>Categories</h4>
                        <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <ul>
                            <?php
                                $c_query = "SELECT * FROM categories";
                                $c_run = mysqli_query($connection, $c_query);
                                if(mysqli_num_rows($c_run) > 0){
                                    
                                    $count = 2;
                                    while($c_row = mysqli_fetch_array($c_run)){
                                        
                                        $c_id = $c_row['id'];
                                        $c_category = $c_row['category'];
                                        $count = $count + 1;
                                        
                                        if(($count % 2)== 1){
                                            echo "<li><a href='index.php?cat=".$c_id."'>".(ucfirst($c_category))."</a></li>";
                                        }
                                    }
                                }
                                else{
                                    echo "<p>No Categories Available</p>";
                                }
                                
                                ?>
                                
                            </ul>
                        </div>
                        <div class="col-xs-6">
                            <ul>
                               <?php
                                $c_query = "SELECT * FROM categories";
                                $c_run = mysqli_query($connection, $c_query);
                                if(mysqli_num_rows($c_run) > 0){
                                    
                                    $count = 2;
                                    while($c_row = mysqli_fetch_array($c_run)){
                                        
                                        $c_id = $c_row['id'];
                                        $c_category = $c_row['category'];
                                        $count = $count + 1;
                                        
                                        if(($count % 2)== 0){
                                            echo "<li><a href='index.php?cat=".$c_id."'>".(ucfirst($c_category))."</a></li>";
                                        }
                                    }
                                }
                                else{
                                    echo "<p>No Categories Available</p>";
                                }
                                
                                ?>
                                
                            </ul>
                        </div>
                    </div>
                
                        </div>
                     </div>