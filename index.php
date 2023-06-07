<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require_once("init.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <link rel="stylesheet" type="text/css" href="css/style.css">
  
  <title>Luca Loaves Bakery</title>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
</head>
<body>
  
  <header>
    <nav class="navbar navbar-expand-sm fixed-top navbar-dark bg-dark">
      <div class="d-flex">
        <a class="navbar-brand mx-5" href="./#Home">
          <img src="assets/logo-white.png" alt="logo" style="width: 12%;">
        </a>
        
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link luca-text" aria-current="page" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link luca-text" href="aboutus.html">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link luca-text" href="careers.html">Careers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link luca-text" href="contactus.html">Contact</a>
          </li>
          <li class="nav-item btn btn-primary mx-1" style="--bs-btn-padding-y: 0rem; --bs-btn-padding-x: .1rem;">
            <a class="nav-link luca-text" href="shop.php">Order Now</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
  <main>
    <a name="Home"></a>
    <div class="d-flex align-items-center position-relative vh-100 cover hero">
      <div class="overlay"></div>
      <div class="container-fluid">
        <h1 class="text-white">Luca Loaves</h1>
        <div class="w-50">
          <h5 class="text-white">We make real bread from the best organic by hand, with dedication and with the best of care.</h5>
        </div>
        <br/>
        <a class="btn btn-primary text-white mr-2" href="shop.php" role="button" >Order Now</a>  
      </div>
    </div>
    
    <a name="Gallery"></a>
    <section>
      <div class="container-sm">
        <div class="my-5">
          <h1 style="text-align: center;"> Our Products</h1>
        </div>

        <div class="row">
          <?php
            $product_array = $db_handle->runQuery("SELECT * FROM product ORDER BY id ASC");
            if (!empty($product_array)) { 
              foreach($product_array as $key=>$value){
          ?>
          <div class="col-4 mb-4">
            <div class="card h-100">
              <img src="<?php echo $product_array[$key]["image"]; ?>" class="card-img-top" alt="<?php echo $product_array[$key]["name"]; ?>">
              <div class="card-body d-flex flex-column">
                <h4 class="card-text"><?php echo $product_array[$key]["name"]; ?></h4>
                <p><?php echo $product_array[$key]["description"]; ?></p>
                <div class="mt-auto">
                  <a href="shop.php" class="btn btn-primary">Order Now</a>
                </div>
              </div>
            </div>
          </div>
          <?php
              }
            }
          ?>
        </div>
    </section>
  </main>
  
  <footer>
    <div class="bg-dark mt-5">
      <div class="footer container-sm" style="text-align: center;">
        <br/>
        <a name="Contact" href="#">
          <img src="assets/logo.png" alt="logo" style="width:12%;">
        </a>
        <br/>
        <div class="mt-4">
          <h5 style="color: white;">
            123 Pitt Street, Sydney NSW 2000.<br>
            Mob. (Bakery) 02 9000 1234<br>
            <a href="mailto:info@lucasloaves.com.au" style="color: white">Email: info@lucasloaves.com.au</a> <br>
          </h5>
          <h5 style="text-align: center">
            @2021 Luca Loaves Bakery, All Rights Reserved
          </h5>
        </div>
      </div>
    </div>
  </footer>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>