<!--Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark indigo sticky-top scrolling-navbar shadow-sm gradient">
<div class="container">
   <a class="navbar-brand d-flex align-items-center logo" href="<? base_url(); ?>" style="font-family: 'Fredoka One', cursive;">
   	<img src="<?= base_url(); ?>assets/img/logo.png" width="10%" height="10%" alt="DaniS Logo">
   	GestiónFCT
   </a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
      aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
      <ul class="navbar-nav mr-auto">
         <li class="nav-item">
            <a class="nav-link" href="home/test">Test</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="#" onclick="$('#modalErrores').modal();">Modal JS Call</a>
         </li>
      </ul>
      <ul class="nav navbar-nav ml-auto nav-flex-icons">
      	<li class="nav-item" role="presentation"><a class="nav-link active" href="index.html">Home</a></li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default"
               aria-labelledby="navbarDropdownMenuLink-333">
               <a class="dropdown-item" href="#">Action</a>
               <a class="dropdown-item" href="#">Another action</a>
               <a class="dropdown-item" href="#">Something else here</a>
            </div>
         </li>

         <li class="nav-item avatar dropdown">
            <a class="nav-link pt-0 dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
            <img src="<?= base_url(); ?>assets/img/avatar-2.jpg" class="rounded-circle z-depth-0"
               alt="avatar image" height="35">
            </a>
            <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
               aria-labelledby="navbarDropdownMenuLink-55">
               <a class="dropdown-item" href="#">Action</a>
               <a class="dropdown-item" href="#">Another action</a>
               <a class="dropdown-item" href="#">Something else here</a>
            </div>
         </li>
      </ul>
   </div>
</div>
</nav>
<!--/.Navbar -->