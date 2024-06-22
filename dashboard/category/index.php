<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="../index.css?v=<?php echo time(); ?>">
  <title>Document</title>
</head>
 
<body>
  <?php
  spl_autoload_register(function($class){
    require "../../modules/".$class.=".php";
 });
 $con = new Connection();
 $category = new Category($con);
 $start=0;
 $page =1;
 $category_per_page = 5;
 $num_category = count($category->GetCategory());
 $num_pages = ceil($num_category/$category_per_page);
 
 if(isset($_GET['page'])){
  $page = $_GET['page'];
  $start = ($page-1)*$category_per_page;
 }
 $data = $category -> Get7Category($start,$category_per_page);
 $product = new product($con);
 if($_SERVER["REQUEST_METHOD"]=="POST"){
  if($category -> CheckCategory($_POST['category'])==0){
   $res= $category -> SetCategory($_POST["category"]);
   if($res){
    header("location:http://localhost/ecommerce_php/dashboard/category/?page=$page");
  }
}
  else{
    $err = "sorry can't add that category because it's already exist";
  }
}
?>
 <div class='container'>
  <div class='row'>
  <?php
  
   if(!isset($_SESSION['username'])){
    header('location:http://localhost/ecommerce_php/views/adminLogin.php');
  } require "../../views/sidebar.php";
  
   ?>
<div class="content col  mt-5 ">
  <h3 class="text-muted row">your categories </h3>

<?php //data 

?>
<ol class="list-group mt-3 row list-group-numbered">
    <?php
    foreach ($data as $key => $value) {
    echo "
  <li class='list-group-item mt-3 d-flex row  align-items-start'>
    <div class='ms-2   col-3'>
      <div class='fw-bold text-muted '>Category $value[category_id]</div>
      $value[category_name]
    </div>";
     $numofproduct = $category -> NumOfProducts($value['category_id']);
     $num = $numofproduct[0]['value'] ; 
     $productData = $product -> GetProductsByCat($value["category_id"]);
     $id = "hi$value[category_id]";
     $collapse = "coll$value[category_id]";
     $name = "name$value[category_id]";
     echo "<td>
    
     <span class='mx-3 mt-2 deltext col ' type='button' data-bs-toggle='modal' data-bs-target='#$name'>
     <i class='fa-solid fa-circle-minus'></i>
     </span>
     <div class='modal fade' id=$name tabindex='-1'   aria-labelledby=$name aria-hidden='true'>
       <div class='modal-dialog' >
         <div class='modal-content'>
           <div class='modal-header'>
             <h5 class='modal-title' id=$name>Alert</h5>
             <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                
             </button>
           </div>
           <div class='modal-body'>
             are you sure you want to delete the $value[category_name] category ?
           </div>
           <div class='modal-footer'>
             <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
             <a type='button' href='http://localhost/ecommerce_php/dashboard/category/delete.php?id=$value[category_id]' class='btn btn-danger'>Delete</a>
           </div>
         </div>
       </div>
     </div>";
   echo" 
   <div class='col col-6'>
   <div class='accordion accordion-flush ' id=$id>
  <div class='accordion-item'>
    <h2 class='accordion-header'>
      <span class='accordion-button collapsed' type='button'  data-bs-toggle='collapse' data-bs-target='#$collapse' aria-expanded='false' aria-controls='#$collapse'>
         <span class='badge   rounded-pill '>
   $num products </span>
      </span>
    </h2>
    <div id=$collapse class='accordion-collapse collapse' data-bs-parent='#$id'>
      <div class='accordion-body'> 
       <table class='table'>
       <tr>
       <th class='text-muted'>Product Name</th>
       <th class='text-muted'>Price</th>
       </tr>
      ";
      foreach ($productData as $key => $row) {
        echo"<tr>";
          
          echo "<td>$row[product_name]</td>";
          echo "<td>$$row[price]</td>";
       
         echo"</tr>";
      }

 
echo"</table>
      </div>
    </div>
  </div>
  </div>
   
  ";
   
    
  echo"</li>";
}
  ?>
</ol>


<button type='button' data-bs-toggle='modal' class='btn   row mt-5 addcat' data-bs-target='#name'>
  Add Category
</button>
<div class=' modal fade addform' id='name' tabindex='-1'   aria-labelledby='name' aria-hidden='true'>
  <div class='modal-dialog' >
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='name'>new Category</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
        </button>
      </div>
      <div class='modal-body'>
      <form class='form row w-100' id='form' method='post' >
      <div class='col-md-7'>
        <label for='inputEmail4' class='form-label mt-2'>Category Name</label>
        <input type='text' class='form-control' name='category' id='category' required>
      </div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
        <button type='submit' class='btn addcat'  >Add</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php
  echo "<div class=' buttonsdiv'><h5 class='text-center text-muted'>showing   $page  of  $num_pages  pages</h5>";?>
  <?php
  echo  "
    <ul class='pagination   justify-content-center ul'>
    ";
      if(isset($_GET['page']) && $_GET['page']>1){
        $page = $_GET['page']-1;
         
    echo" <li class='page-item'>
        <a class='page-link' href='?page=$page'><span aria-hidden='true'>&laquo;</span></a>
      </li> ";}
      else{
        echo "<li class='page-item'>
        <a class='page-link' href='#' > <span aria-hidden='true'>&laquo;</span></a>
      </li>";
      }
      
      ?>
      <?php
      for ($i=1; $i <=$num_pages ; $i++) { 
         echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
      }
      ?>
      <?php
      if(isset($_GET['page']) && $_GET['page']<$num_pages){
        $page = $_GET['page']+1;
    echo" <li class='page-item'>
        <a class='page-link' href='?page=$page'> <span aria-hidden='true'>&raquo;</span></a>
      </li>";
      }
      else{
        echo" <li class='page-item'>
        <a class='page-link' href=''> <span aria-hidden='true'>&raquo;</span></a>
      </li>";
      }?>
    </ul>
    </div>
    </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">

</script>
 

</html>