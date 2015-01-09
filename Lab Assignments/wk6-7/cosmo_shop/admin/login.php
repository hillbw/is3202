<?php require_once('../Connections/connCosmo.php'); ?>
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "access";
  $MM_redirectLoginSuccess = "admin.php";
  $MM_redirectLoginFailed = "denied.html";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_connCosmo, $connCosmo);
  	
  $LoginRS__query=sprintf("SELECT userEmail, password, access FROM users WHERE userEmail=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connCosmo) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'access');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Administrator Login</title>

<link href="../styles/global.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="../styles/twoColFixLtHdr.css" rel="stylesheet" type="text/css" />
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
<li><a href="add.php">Add Record</a></li>
<li><a href="delete.php">Delete Record</a></li>
<li><a href="edit.php">Edit Record</a></li>
  </ul>
</div>
<div class="natEx">
      <p><a href="http://www.nationalexasperator.com/"><img src="../images/ne.png" alt="National Exasperator" width="97" height="89" /></a></p>
      <p><a href="http://www.nationalexasperator.com/">Subscribe to the National Exasperator Today! </a></p>
    </div>
    <p>CosmoFarmer.com believes that your privacy is important. All monitoring that takes place as you visit our site is protected. Information collected is limited to our  network of 9,872 partner affiliates. Your information will only be shared among them, and as part of our network's anti-spam policy you will be limited to one e-mail per partner affiliate per day, not to exceed a total of 9,872 e-mails a day. If you wish to opt out of this program please call us between the hours of 9:01-9:03am GMT. </p>

  <!-- end #sidebar1 --></div>
  <div id="mainContent">
    <h1>Administrator Login  </h1>
    <form id="login" name="login" method="POST" action="<?php echo $loginFormAction; ?>">
      <p>
        <label for="username">User Name:</label>
        <input type="text" name="username" id="username" />
      </p>
      <p>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" />
      </p>
      <p>
        <input type="submit" name="button" id="button" value="Login" />
      </p>
    </form>
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
//-->
</script>
</body>
</html>
