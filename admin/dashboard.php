<?php
// include '../app/core/init.php';
?>
<?php
error_reporting(0);

// ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Wanderlust</title>

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
     <link href="aassets/css/bootstrap-icons.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>                                        
    <!-- Custom styles for this template -->
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Wanderlust</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="logout.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="?page=data">
              <span data-feather="home"></span>
              <i class="bi bi-speedometer"></i>
              Dashboard
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link " aria-current="page" href="?page=users">
              <span data-feather="home"></span>
            <i class="bi bi-people"></i>
                Users
            </a>


 

          </li>
           <li class="nav-item">
              
            <a class="nav-link " aria-current="page" href="?page=destinations">
              <span data-feather="home"></span>
             <i class="bi bi-geo-alt-fill"></i>
              destinations
            </a>

          </li>
          <li class="nav-item">
    <a class="nav-link" href="?page=subscribe">
        <i class="bi bi-person-vcard-fill"></i>
        Subscribe Lists
    </a>
</li>
       <li class="nav-item">
    <a class="nav-link" href="?page=gallary">
          <i class="bi bi-images me-2"></i>
        Gallery Table
    </a>
</li>


           <li class="nav-item">
            <a class="nav-link " aria-current="page" href="?page=contact">
              <span data-feather="home"></span>
              <i class="bi bi-envelope-paper me-2"></i>
              contact
            </a>
          </li>
        
         

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>OTHER</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="../public/index.php">
              <span data-feather="file-text"></span>
              <i class="bi bi-house"></i>

              Front End
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>
      <div class="container">
      <?php
       

if (isset($_GET['page']) && $_GET['page'] == 'destinations') {
   include 'destinations.php';
}

?>
</div>

      
      <!-- // $section=$url[1] ?? 'dashboard';
      // echo $section; -->
      
      <!-- ?> -->
      <div class="container">
      <?php
if (isset($_GET['page']) && $_GET['page'] == 'users') {
   include 'all_user.php';
} 

?>
      </div>
            <div class="container">
      <?php
if (isset($_GET['page']) && $_GET['page'] == 'users') {
   include 'view_contact.php';
} 

?>
      </div>
         <div class="container">
      <?php
if (isset($_GET['page']) && $_GET['page'] == 'subscribe') {
   include 'sub.php';
} 

?>
      </div>
       <?php
   if (isset($_GET['page']) && $_GET['page'] == 'contact') {
   include 'view_contact.php';
}

?>
         <?php
   if (isset($_GET['page']) && $_GET['page'] == 'gallary') {
   include 'gallary.php';
}
?>
      <?php
      
            
   include 'data.php';
   ?>



      </div>


    </main>
  </div>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
