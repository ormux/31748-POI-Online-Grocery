<?php
include 'include/database.php';

if(isset($_GET['id'])) {
   $product_id = mysqli_real_escape_string($db_link, $_GET['id']);
   $query = "SELECT * FROM Products ";
   $query .= "WHERE product_id=".$product_id.";";

   $result = mysqli_query($db_link, $query);
?>
<link rel='stylesheet' href='css/main.css'/>
<table width='100%' class='view-table'>
   <thead>
      <tr>
         <th>Product ID</th>
         <th>Product Name</th>
         <th>Unit Price</th>
         <th>Unit Quantity</th>
         <th>In Stock</th>
      </tr>
   </thead>
   <tbody>
<?php 
   while($row = mysqli_fetch_assoc($result)) {

      print '<tr>';
      print '<td>'.$row['product_id'].'</td>';
      print '<td>'.$row['product_name'].'</td>';
      print '<td>'.$row['unit_price'].'</td>';
      print '<td>'.$row['unit_quantity'].'</td>';
      print '<td>'.$row['in_stock'].'</td>';
      print '</tr>';
   }
?>
   </tbody>
</table>

<br>

<script src="js/validate.js"></script>
<?php
   $query  = "SELECT in_stock FROM Products ";
   $query .= "WHERE product_id=".$_GET['id'].";";
   $result = mysqli_query($db_link, $query);
   $stock = mysqli_fetch_assoc($result)['in_stock'];
?>

<form 
   id="add-cart"
   action="cart.php?action=add&id=<?php print $_GET['id']; ?>" 
   method="POST" 
   target="cart" 
   onsubmit="return validateAdd(<?php print $stock?>)"
>
   <table class="view-add">
   <tr>
      <td colspan=3>
<?php 
   $query  = "SELECT image FROM Products ";
   $query .= "WHERE product_id=".$_GET['id'].";";
   $result = mysqli_query($db_link, $query);
   $image = "images/products/".mysqli_fetch_assoc($result)['image'];

   print '<img style="text-align:center;" height="10%" src="'.$image.'">';
?>
      </td>
   </tr>
   <tr>
      <td>Quantity:</td>
      <td><input type="text" id="quantity" name="quantity" value="1"/></td>
      <td><input type="submit" value="Add"/></td>
   </tr>
   </table>
</form>

<?php
} else {
   print '<h1 style="text-align: center;">';
   print 'No products selected...';
   print '</h1>';
}
?>

