<div class="sidebar col-2   h-100  d-inline-block">
          <h3 class="navbar-brand fw-bolder  ">Dashboard</h3>
        <ul class="ul  ">
          <li><a href="http://localhost/ecommerce_php/dashboard/" class="nav-link">
          <i class="fa-solid fa-gauge-high"></i>
            <span class="nav-item">Dashboard</span>
          </a>
          </li>
          <li><a href="http://localhost/ecommerce_php/dashboard/customers/?page=1" class="nav-link">
            <i class="fas fas fa-user"></i>
            <span class="nav-item">Customers</span>
          </a>
          </li>
          <li><a href="http://localhost/ecommerce_php/dashboard/product?page=1" class="nav-link">
            <i class="fas fa-chart-bar"></i>
            <span class="nav-item">Products</span>
          </a>
          </li>
          <li><a href="http://localhost/ecommerce_php/dashboard/category?page=1" class="nav-link">
          <i class="fa-solid fa-layer-group"></i>
            <span class="nav-item">Category</span>
          </a>
          </li>
          <li><a href="http://localhost/ecommerce_php/dashboard/order" class="nav-link">
          <i class="fa-solid fa-bag-shopping"></i>
            <span class="nav-item">Orders</span>
          </a>
          </li>
          <?php 
          $con = new Connection();
          $admin = new Admin($con);
          if(isset($_SESSION['username'])){ 
          $value = $admin -> Check_Admin($_SESSION['username']);
          if($value){
         echo" <li><a href='http://localhost/ecommerce_php/dashboard/admin' class='nav-link'>
          <i class='fa-solid fa-user-tie'></i>
            <span class='nav-item'>Admins</span>
          </a>
          </li>";
        }}
          ?>
          <li><a href="http://localhost/ecommerce_php/views/" class="nav-link">
          <i class="fa-solid fa-window-maximize"></i>
            <span class="nav-item">website</span>
          </a>
          </li>
          <li><a href="http://localhost/ecommerce_php/dashboard/logout.php" class="nav-link mt-5">
          <i class="fa-solid fa-right-from-bracket"></i>
            <span class="nav-item">logout</span>
          </a>
          </li>
        </ul>
    </div>