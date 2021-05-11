 <?php require_once('include/top.php');?>
  </head>
  <body>
   <!-- As a link -->
 <?php require_once('include/header.php');?>
 
 <div class="jumbotron">
     <div class="container">
         <div id="details" class="animated fadeInLeft">
             <h1>Contact <span>Us</span></h1>
             <p>Response time within a minute</p>
         </div>
         
     </div>
     <img src="image/B1.jpg" alt="Top Image">
 </div>
 
 <section>
     <div class="container">
         <div class="row">
             <div class="col-md-8">
            
              <div class="row">
                  <div class="col-md-12">
                      <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=100%&amp;height=400&amp;hl=en&amp;q=Jhikargacha%20Jhikargacha+(Jessore)&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> <a href='https://www.free-counters.org/'>Tareq Hossain</a> <script type='text/javascript' src='https://maps-generator.com/google-maps-authorization/script.js?id=be2a350684b82b7bff902bfc3d5d37b656f0cafd'></script>
                  </div>
                  <div class="col-md-12 contact-form">
                      <form action="">
                         <h2>Contact Form</h2>
                          <div class="form-group">
                              <label for="full-name">Full Name*:</label>
                              <input type="text" id="full-name" class="form-control" placeholder="Full Name">
                          </div>
                          
                          <div class="form-group">
                              <label for="email">Email*:</label>
                              <input type="text" id="email" class="form-control" placeholder="Email Address">
                          </div>
                          
                          <div class="form-group">
                              <label for="website">Website:</label>
                              <input type="text" id="website" class="form-control" placeholder="Your Website">
                          </div>
                          
                          <div class="form-group">
                              <label for="message">Message:</label>
                              <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Message Here"></textarea>
                          </div>
                          
                          <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                          
                          
                      </form>
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