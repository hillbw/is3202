<?php require_once('../Connections/connCosmo.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "admin";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO products (productName, price, `description`, inventory, vendorID, categoryID, image, onSale) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['productName'], "text"),
                       GetSQLValueString($_POST['price'], "double"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['inventory'], "text"),
                       GetSQLValueString($_POST['vendorID'], "int"),
                       GetSQLValueString($_POST['categoryID'], "int"),
                       GetSQLValueString($_POST['image'], "text"),
                       GetSQLValueString($_POST['onSale'], "int"));

  mysql_select_db($database_connCosmo, $connCosmo);
  $Result1 = mysql_query($insertSQL, $connCosmo) or die(mysql_error());

  $insertGoTo = "../index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_connCosmo, $connCosmo);
$query_rsVendors = "SELECT vendorID, vendorName FROM vendors ORDER BY vendorName ASC";
$rsVendors = mysql_query($query_rsVendors, $connCosmo) or die(mysql_error());
$row_rsVendors = mysql_fetch_assoc($rsVendors);
$totalRows_rsVendors = mysql_num_rows($rsVendors);

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

<link href="../styles/global.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../styles/twoColFixLtHdr.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>

<body class="twoColFixLtHdr">

<div id="container">
  <div id="header">
    <p><img src="../images/cosmo_logo.gif" alt="CosmoFarmer 2.0" width="476" height="90"/>    </p>
   <p id="tagline">Your online guide to apartment farming</p>
  <ul id="sitetools">
      <li><a href="../#">Contact Us</a></li>
<li><a href="../#">Subscribe</a> </li>
</ul>
  <ul id="mainNav" class="MenuBarHorizontal">
    <li><a href="../#">Home</a> </li>
    <li><a href="../#">Features</a></li>
<li><a class="MenuBarItemSubmenu" href="../#">Ask the Experts</a>
    <ul>
          <li><a href="../#">Pete</a> </li>
        <li><a href="../#">Dave</a> </li>
        <li><a href="../#">Nan</a></li>
      </ul>
    </li>
<li><a href="../index.php" class="MenuBarItemSubmenu">Cosmo Shop</a>
  <ul>
          <li><a href="../category.php?categoryID=1">Plants</a></li>
          <li><a href="../category.php?categoryID=2">Seeds</a></li>
        <li><a href="../category.php?categoryID=5">Clothing</a></li>
        <li><a href="../category.php?categoryID=4">Pest Control</a></li>
        <li><a href="../category.php?categoryID=5">Tools</a></li>
      </ul>
    </li>
    <li><a href="../#">Projects</a></li>
<li><a href="../#" class="MenuBarItemSubmenu">Horoscopes</a>
    <ul>
          <li><a href="../#">Aries</a></li>
        <li><a href="../#">Taurus</a></li>
        <li><a href="../#">Gemini</a></li>
        <li><a href="../#">Cancer</a></li>
        <li><a href="../#">Leo</a></li>
        <li><a href="../#">Virgo</a></li>
        <li><a href="../#">Libra</a></li>
        <li><a href="../#">Scorpio</a></li>
        <li><a href="../#">Sagitarrius</a></li>
        <li><a href="../#">Capricorn</a></li>
        <li><a href="../#">Aquarius</a></li>
        <li><a href="../#">Pisces</a></li>
      </ul>
    </li>
  </ul>
  <br class="clear" />
  </div>
  <div id="sidebar1">
<div class="related">
  <h2>Store Admin</h2>
  <ul>
    <li><a href="admin.php">Admin Home</a></li>
<li><a href="add.php">Add Records</a></li>
<li><a href="delete.php">Delete Records</a></li>
<li><a href="edit.php">Update Records</a></li>
<li><a href="<?php echo $logoutAction ?>">Log Out</a></li>
</ul>
</div>
<div class="natEx">
      <p><a href="http://www.nationalexasperator.com/"><img src="../images/ne.png" alt="National Exasperator" width="97" height="89" /></a></p>
      <p><a href="http://www.nationalexasperator.com/">Subscribe to the National Exasperator Today! </a></p>
    </div>
    <p>CosmoFarmer.com believes that your privacy is important. All monitoring that takes place as you visit our site is protected. Information collected is limited to our  network of 9,872 partner affiliates. Your information will only be shared among them, and as part of our network's anti-spam policy you will be limited to one e-mail per partner affiliate per day, not to exceed a total of 9,872 e-mails a day. If you wish to opt out of this program please call us between the hours of 9:01-9:03am GMT. </p>

  <!-- end #sidebar1 --></div>
  <div id="mainContent">
    <h1>Add Database Records   </h1>
    <div id="TabbedPanels1" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">Add Product</li>
        <li class="TabbedPanelsTab" tabindex="0">Add Category</li>
        <li class="TabbedPanelsTab" tabindex="0">Add Vendor</li>
      </ul>
      <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent">
          <p>&nbsp;</p>
          <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
            <table border="0" cellpadding="0" cellspacing="0">
              <tr valign="baseline">
                <th nowrap="nowrap" align="right">Product Name:</th>
                <td><input type="text" name="productName" value="" size="32" /></td>
              </tr>
              <tr valign="baseline">
                <th nowrap="nowrap" align="right">Price:</th>
                <td><input type="text" name="price" value="" size="32" /></td>
              </tr>
              <tr valign="baseline">
                <th nowrap="nowrap" align="right" valign="top">Description:</th>
                <td><textarea name="description" cols="50" rows="5"></textarea></td>
              </tr>
              <tr valign="baseline">
                <th nowrap="nowrap" align="right">Inventory Status:</th>
                <td valign="baseline"><table>
                  <tr>
                    <td><input type="radio" name="inventory" value="in stock" />
                      In stock</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="inventory" value="out of stock" />
                      Out of stock</td>
                  </tr>
                </table></td>
              </tr>
              <tr valign="baseline">
                <th nowrap="nowrap" align="right">Vendor:</th>
                <td><select name="vendorID">
                  <?php 
do {  
?>
                  <option value="<?php echo $row_rsVendors['vendorID']?>" ><?php echo $row_rsVendors['vendorName']?></option>
                  <?php
} while ($row_rsVendors = mysql_fetch_assoc($rsVendors));
?>
                </select></td>
              </tr>
              <tr> </tr>
              <tr valign="baseline">
                <th nowrap="nowrap" align="right">Category:</th>
                <td><select name="categoryID">
                  <?php 
do {  
?>
                  <option value="<?php echo $row_rsCategories['categoryID']?>" ><?php echo $row_rsCategories['categoryName']?></option>
                  <?php
} while ($row_rsCategories = mysql_fetch_assoc($rsCategories));
?>
                </select></td>
              </tr>
              <tr> </tr>
              <tr valign="baseline">
                <th nowrap="nowrap" align="right">Image File:</th>
                <td><input type="text" name="image" value="none.gif" size="32" /></td>
              </tr>
              <tr valign="baseline">
                <th nowrap="nowrap" align="right">On Sale:</th>
                <td valign="baseline"><table>
                  <tr>
                    <td><input type="radio" name="onSale" value="1" />
                      Yes</td>
                  </tr>
                  <tr>
                    <td><input type="radio" name="onSale" value="0" />
                      No</td>
                  </tr>
                </table></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">&nbsp;</td>
                <td><input type="submit" value="Insert record" /></td>
              </tr>
            </table>
            <input type="hidden" name="MM_insert" value="form1" />
          </form>
          <p>&nbsp;</p>
        </div>
        <div class="TabbedPanelsContent">
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </div>
        <div class="TabbedPanelsContent">
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
	<div id="footer">
    <p>Copyright 2006, CosmoFarmer.com</p>
  <!-- end #footer --></div>
<!-- end #container --></div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("mainNav", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
<?php
mysql_free_result($rsVendors);

mysql_free_result($rsCategories);
?>
