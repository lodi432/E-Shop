<?php
require_once '../konfiguracija.php';
// include 'include/head.php';

$id = $_POST['id'];
$id = (int)$id;
$sql =$veza->prepare("SELECT * FROM products WHERE id = '$id';");
$sql->execute();
$product=$sql->fetch(PDO::FETCH_ASSOC);
$brand_id = $product['brand'];
$sql = $veza->prepare("SELECT brand FROM brand WHERE id = '$brand_id';");
$sql->execute();
$brand=$sql->fetch(PDO::FETCH_ASSOC);
$sizestring = $product['sizes'];
$sizestring = rtrim($sizestring,',');
$size_array = explode(',', $sizestring);



?>



<?php ob_start(); ?>

    <!-- <link rel="stylesheet" href="stylesheets/app2.css" > -->
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header" >
     <!-- <link rel="stylesheet" href="stylesheets/app.css" /> -->
     <!-- <link rel="stylesheet" href="stylesheets/app.css" />

     <script src="bower_components/modernizr/modernizr.js"></script> -->

    <button class="close" type="button"  onclick= "closeModal()" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title text-center"><?= $product['title']; ?></h4>

   </div>
   <div class="modal-body" >
    <div class="container-fluid"  >


     <div class="row">

       <span id="modal_errors" class="bg-danger"></span>





          <div class="col-sm-6">

        <?php $photos = explode(',',$product['image']);
        foreach($photos as $photo): ?>
       <img src="<?= $photo; ?>" alt="<?= $product['title']; ?>" class="details img-responsive">
     <?php endforeach; ?>

  </div>


      <div class="col-sm-6">
       <hr>
       <div class="large-8 columns">
         <ul class="tabs" data-tab>
           <li class="tab-title active"><a href="#panel1">Details</a></li>
           <li class="tab-title"><a href="#panel2">Specs</a></li>
           <li class="tab-title"><a href="#panel3">Support</a></li>
         </ul>
         <div class="tabs-content">
           <div class="content active" id="panel1"><br>
            <div class="price"><strong>Price: </strong> $<?= $product['price']; ?></div><br>


             <p><?= nl2br($product['description']); ?> </p>

           </div>
           <div class="content" id="panel2">
             <ul class="specs">
               <li><strong>Screen Size: </strong> 4.7 Inches</li>
               <li><strong>Storage: </strong>16GB</li>
               <li><strong>Colors:</strong> Silver, Black & White</li>
               <div><strong>Brand: </strong><?= $brand['brand']; ?></div>
             </ul>
           </div>
           <div class="content" id="panel3">
             <p>Email us at <strong>support@ecom.xxx</strong></p>
           </div>
         </div>
       </div>
      <br>
       <form action="add_cart.php" method="post" id="add_product_form">
         <input type="hidden" name ="product_id" value ="<?=$id;?>">
         <input type="hidden" name="available" id="available" value ="">
        <div class="form-group">
         <div class="large-3 columns">
          <label for="quantity">Quantity:</label>
          <input type="number" class="form-control" id="quantity" name="quantity">
         </div>
        </div>
        <div class="large-3 columns">
         <label for="size">Size:</label>
         <select name="size" id="size" class="form-control">
          <option value=""></option>
          <?php foreach($size_array as $string) {
           $string_array = explode(':', $string);
           $size = $string_array[0];
           $available = $string_array[1];
           echo '<option value="'.$size.'" data-available="'.$available.'">'.$size.' ('.$available.'Available)</option>';
          }?>

         </select>
        </div>
       </form>
      </div>
     </div>
    </div>
   </div>
   <div class="modal-footer">


    <button class="btn btn-default" onclick="closeModal()">Close</button>
    <button class="btn btn-warning" onclick="add_to_cart();return false;"><span class="glyphicon glyphicon-shopping-cart"></span>Add To Cart</button>
   </div>
  </div>
 </div>
</div>
<script>

jQuery('#size').change(function(){
  var available = jQuery('#size option:selected').data("available");
  jQuery('#available').val(available);
});






 function closeModal(){
  jQuery('#details-modal').modal('hide');
  setTimeout(function(){
   jQuery('#details-modal').remove();
   jQuery('modal-backdrop').remove();
  },500);
 }
</script>



<script>
var url = "js/app.js";
$.getScript(url);
</script>



<script>
var url = "bower_components/modernizr/modernizr.js";
$.getScript(url);
</script>

<?php echo ob_get_clean(); ?>
