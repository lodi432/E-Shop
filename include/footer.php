<div class="row footer">
    <div class="large-3 columns">
        <h4>Information</h4>
        <ul>
            <li><a href="#">About Us</a></li>
             <li><a href="#">Delivery Information</a></li>
             <li><a href="#">Privacy Policy</a></li>
             <li><a href="#">Terms & Conditions</a></li>
        </ul>
    </div>
    <div class="large-3 columns">
        <h4>Follow Us</h4>
        <ul>
         <li><a href="#">Facebook</a></li>
         <li><a href="#">Twitter</a></li>
         <li><a href="#">Instagram</a></li>
         <li><a href="#">RSS</a></li>
         <li><a href="#">Youtube</a></li>
       </ul>
    </div>
    <div class="large-3 columns">
       <h4>Your Account</h4>
       <ul>
         <li><a href="#">Orders</a></li>
         <li><a href="#">Returns</a></li>
         <li><a href="#">Credit Slips</a></li>
         <li><a href="#">Billing Information</a></li>
       </ul>
    </div>
    <div class="large-3 columns">
       <h4>Get In Touch</h4>
       <ul>
         <li><a href="#">Contact Us</a></li>
         <li>(888) 555-5555</li>
         <li><a href="#">support@eshop.com</a></li>
         <li><a href="#">Submit a Ticket</a></li>
       </ul>
    </div>
</div>

<br><br><br><br>
<footer class ="text-center" id="footer">&copy; All rights reserved </footer>

<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/foundation/js/foundation.min.js"></script> -->
<!-- <script src="js/app.js"></script> -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- Include all compiled plugins (below), or include individual files as needed -->

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->


<script>
function detailsmodal(id) {
var data = {"id" : id} ;
jQuery.ajax({
url : '/E-Shop/include/detailsmodal.php',
method : "post" ,
data : data,
success : function(data){
jQuery ('body').append(data);
jQuery ('#details-modal').modal('toggle');
},
 error: function(xhr, textStatus, errorThrown){
                   alert("fail "+errorThrown);
 }
 });
}

function update_cart(mode,edit_id,edit_size){
  var data = {"mode" : mode, "edit_id" : edit_id, "edit_size" : edit_size};
  jQuery.ajax({
    url : '/E-Shop/admin/parsers/update_cart.php',
    method : "post",
    data : data,

    success : function(vratioServer){
     console.log(vratioServer);
      location.reload();
    },

    error : function(){alert("Something went wrong.");},
  });
}

function add_to_cart(){
  jQuery('#modal_errors').html("");
  var size = jQuery('#size').val();
  var quantity = jQuery('#quantity').val();
  var available = jQuery('#available').val();
  var error = '';
  var data = jQuery("#add_product_form").serialize();
  if (size == '' || quantity == '' || quantity <= 0){
    error += '<p class= "bg-danger text-center">You must choose a size and quantity</p>';
    jQuery('#modal_errors').html(error);
    return;
  }else if (quantity>available){
    error += '<p class= "bg-danger text-center">There are only '+available+' available.</p>';
    jQuery('#modal_errors').html(error);
     return;
  }else{
    jQuery.ajax({
               url: '/E-Shop/admin/parsers/add_cart.php',
               method : 'post',
               data : data,
               success : function(vratioServer){
               	console.log(vratioServer);
                 location.reload();
               },
               error : function(){alert("Something went wrong");}

    });
  }
}
</script>




</body>
</html>
