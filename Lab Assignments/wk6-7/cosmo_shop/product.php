<?php session_start(); ?>
<?php require_once('Connections/connCosmo.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$varProduct_rsDetails = "1";
if (isset($_GET['productID'])) {
  $varProduct_rsDetails = $_GET['productID'];
}
mysql_select_db($database_connCosmo, $connCosmo);
$query_rsDetails = sprintf("SELECT products.productID, products.productName, products.price, products.`description`, products.inventory, products.image, vendors.vendorName FROM products, vendors WHERE products.vendorID = vendors.vendorID AND products.productID = %s", GetSQLValueString($varProduct_rsDetails, "int"));
$rsDetails = mysql_query($query_rsDetails, $connCosmo) or die(mysql_error());
$row_rsDetails = mysql_fetch_assoc($rsDetails);
$totalRows_rsDetails = mysql_num_rows($rsDetails);

mysql_select_db($database_connCosmo, $connCosmo);
$query_rsCategories = "SELECT * FROM categories ORDER BY categoryName ASC";
$rsCategories = mysql_query($query_rsCategories, $connCosmo) or die(mysql_error());
$row_rsCategories = mysql_fetch_assoc($rsCategories);
$totalRows_rsCategories = mysql_num_rows($rsCategories);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>The CosmoFarmer Store</title>

<link href="styles/global.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="styles/twoColFixLtHdr.css" rel="stylesheet" type="text/css" />
</head>

<body class="twoColFixLtHdr">

<div id="container">
  <div id="header">
    <p><img src="images/cosmo_logo.gif" alt="CosmoFarmer 2.0" width="476" height="90"/>    </p>
   <p id="tagline">Your online guide to apartment farming</p>
  <ul id="sitetools">
      <li><a href="#">Contact Us</a></li>
<li><a href="#">Subscribe</a> </li>
</ul>
  <ul id="mainNav" class="MenuBarHorizontal">
    <li><a href="#">Home</a> </li>
    <li><a href="#">Features</a></li>
<li><a class="MenuBarItemSubmenu" href="#">Ask the Experts</a>
    <ul>
          <li><a href="#">Pete</a> </li>
        <li><a href="#">Dave</a> </li>
        <li><a href="#">Nan</a></li>
      </ul>
    </li>
<li><a href="index.php" class="MenuBarItemSubmenu">Cosmo Shop</a>
  <ul>
          <li><a href="category.php?categoryID=1">Plants</a></li>
          <li><a href="category.php?categoryID=2">Seeds</a></li>
        <li><a href="category.php?categoryID=5">Clothing</a></li>
        <li><a href="category.php?categoryID=4">Pest Control</a></li>
        <li><a href="category.php?categoryID=5">Tools</a></li>
      </ul>
    </li>
    <li><a href="#">Projects</a></li>
<li><a href="#" class="MenuBarItemSubmenu">Horoscopes</a>
    <ul>
          <li><a href="#">Aries</a></li>
        <li><a href="#">Taurus</a></li>
        <li><a href="#">Gemini</a></li>
        <li><a href="#">Cancer</a></li>
        <li><a href="#">Leo</a></li>
        <li><a href="#">Virgo</a></li>
        <li><a href="#">Libra</a></li>
        <li><a href="#">Scorpio</a></li>
        <li><a href="#">Sagitarrius</a></li>
        <li><a href="#">Capricorn</a></li>
        <li><a href="#">Aquarius</a></li>
        <li><a href="#">Pisces</a></li>
      </ul>
    </li>
  </ul>
  <br class="clear" />
  </div>
  <div id="sidebar1">
<div class="related">
  <h2>Product 
    Categories</h2>
  <ul>
    <?php do { ?>
        <li><a href="category.php?categoryID=<?php echo $row_rsCategories['categoryID']; ?>"><?php echo $row_rsCategories['categoryName']; ?></a></li>
      <?php } while ($row_rsCategories = mysql_fetch_assoc($rsCategories)); ?>
</ul>
</div>
<div class="natEx">
      <p><a href="http://www.nationalexasperator.com/"><img src="images/ne.png" alt="National Exasperator" width="97" height="89" /></a></p>
      <p><a href="http://www.nationalexasperator.com/">Subscribe to the National Exasperator Today! </a></p>
    </div>
    <p>CosmoFarmer.com believes that your privacy is important. All monitoring that takes place as you visit our site is protected. Information collected is limited to our  network of 9,872 partner affiliates. Your information will only be shared among them, and as part of our network's anti-spam policy you will be limited to one e-mail per partner affiliate per day, not to exceed a total of 9,872 e-mails a day. If you wish to opt out of this program please call us between the hours of 9:01-9:03am GMT. </p>

  <!-- end #sidebar1 --></div>
  <div id="mainContent">
  
  <h1><?php echo $row_rsDetails['productName']; ?></h1>
  <img src="images/large/<?php echo $row_rsDetails['image']; ?>" alt="<?php echo $row_rsDetails['productName']; ?>" class="productImage" />
  <p><?php echo $row_rsDetails['description']; ?></p>
  <p>Price: $<?php echo $row_rsDetails['price']; ?></p>
  <p>Vendor: <?php echo $row_rsDetails['vendorName']; ?></p>
  <p>Inventory Status: <?php echo $row_rsDetails['inventory']; ?></p>
  <?php if (isset($_SESSION['MM_UserGroup']) && $_SESSION['MM_UserGroup']=='admin') { ?>
  <p><a href="admin/edit.php?productID=<?php echo $row_rsDetails['productID']; ?>">Edit This Information</a> | <a href="admin/delete.php?productID=<?php echo $row_rsDetails['productID']; ?>">Delete This Product</a></p>
  <?php } ?>
  
  </div>
	<div id="footer">
    <p>Copyright 2006, CosmoFarmer.com</p>
  <!-- end #footer --></div>
<!-- end #container --></div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("mainNav", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>
<?php
mysql_free_result($rsDetails);

mysql_free_result($rsCategories);
?>
