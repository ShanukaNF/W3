<?php 
  session_start();
  require_once('./../../controller/user/userController.php'); 
  require_once('./header.php');
  require_once('./../../controller/contract/quotationController.php');
  require_once('./../../controller/contract/itemController.php');
  require_once('./search.php');
  $quo = new Quotation();
  $result = $quo->getAllQuotation();

  $_SESSION['item_add'] = 'none';

  if (isset($_GET['quo_con_id'])) {
    $a = $_GET['quo_con_id'];
  }

  if(isset($_POST['quotation_add'])){
    $item_no = $_POST['q_itemno'];
    $name = $POST['q_name'];
    $description = $POST['q_desc'];
    $quantity = $POST['q_quantity'];
    $discount = $POST['q_discount'];
    $con_id = $_GET['quo_con_id'];
    $quo->addQuotation($item_no,$name,$description,$quantity,$discount,$con_id);
    
  }

  if(isset($_POST['add_item'])){
    $item_name = $_POST['item_name'];
    $item_cat = $_POST['item_category'];
    $unit_price = $_POST['unit_price'];
    $item_con = new Item();

    $item_con->addItem($item_name,$item_cat,$unit_price);
    
  }
?>

<div class="container"> 
  <h1>Add New Quotation</h1>  
  <!-- searching -->
  <?php if(($_SESSION['item_add']) == 'success'): ?>
					<div class="alert alert-success" style="background-color: green;">
						<a href="./user/userProfile.php" style="text-decoration: none; color: white;">Item added successfully</a>
					</div>
	<?php endif; ?>
  <!-- Form Starts -->
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    <div class="form-group field">
      <input type="text" class="form-field" name="q_itemno" id="q_itemno" autocomplete="off">
      <label for="q_itemno" class="form-label">Furniture Item Code</label>
      <small id="" class="form-text text-muted">select the furniture item model</small>
      <!-- select items -->
      <div id="output">
      
      </div>
      <h6 style="margin: 0x">If you haven't a furniture item code. Add a new item here</h6>
      <!-- Add new Item to Quotation -->
      <a class="btn btn-warning" onclick="document.getElementById('id01').style.display='block'">Add new Item</a>
    </div>
    <div class="form-group field">
      <input type="text" class="form-field" id="q_name" name="q_name">
      <label for="q_name" class="form-label">Quotation Name</label>
      <small id="" class="form-text text-muted">Provide a suitable quotation name </small>
    </div>
    <div class="form-group field">
      <input type="text" class="form-field" name="q_desc" id="q_desc">  
      <label for="q_desc" class="form-label">Quotation Description</label>
    </div>
    <div class="form-group field">
      <input type="text" class="form-field" id="q_quantity" name="q_quantity">
      <label for="q_budget" class="form-label">Quantity</label>
    </div>
    <div class="form-group field">
      <input type="text" class="form-field" id="q_discount" name="q_discount">
      <label for="q_discount" class="form-label">Discount</label>
    </div>
    <div class="right">
      <button type="submit" class="btn btn-primary" name ="quotation_add">Add Quotation</button>
    </div>
  </form>
  <!-- Form Ends -->
</div> 
<script type="text/javascript">
    $(document).ready(function(){
       $("#q_itemno").keyup(function(){
          var query = $(this).val();
          if (query != "") {
            $.ajax({
              url: './search.php',
              method: 'POST',
              data: {query:query},
              success: function(data){
 
                $('#output').html(data);
                $('#output').css('display', 'block');
 
                $("#q_itemno").focusout(function(){
                    $('#output').css('display', 'none');
                });
                $("#q_itemno").focusin(function(){
                    $('#output').css('display', 'block');
                });
              }
            });
          } else {
          $('#output').css('display', 'none');
        }
      });
    });
  </script>   
<!-- Prompt Box -->
<div id="id01" class="confirm-box">
      <div class="right" style="margin-right:25px;">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      </div>
      
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        <h1>Add new Item</h1>
        <div class="form-group field">
          <input type="text" class="form-field" name="item_name" id="item_name" >
          <label for="item_name" class="form-label" placeholder="I0001">Item Name</label>
          <small id="" class="form-text text-muted">Provide a suitable item name eg:- bed_model#4</small>
        </div>
        <div class="form-group field">
          <input type="text" class="form-field" name="item_category" id="item_category" >
          <label for="q_budget" class="form-label">Item Category</label>
        </div>
        <div class="form-group field">
          <input type="text" class="form-field" name="unit_price" id="unit_price">  
          <label for="unit_price" class="form-label">Unit Price</label>
        </div>
        <div class="form-group field">
          <input type="file" class="form-field" id="image" name="image">
          <label for="q_budget" class="form-label">Image</label>
        </div>
        
        <div class="clearfix right">
          <button type="button" class="btn btn-secondary" onclick="document.getElementById('id01').style.display='none'">Cancel</button>
          <button type="submit" name="add_item" class="btn btn-primary">Add Item</button>
        </div>
      </form>
    </div>
    <!-- End Prompt Box -->
    
<?php
  require_once('leftSidebar.php'); 
  require_once('footer.php'); 
?>	