<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connCosmo = "localhost";
$database_connCosmo = "bhill";
$username_connCosmo = "bhill";
$password_connCosmo = "bhill";
$connCosmo = mysql_pconnect($hostname_connCosmo, $username_connCosmo, $password_connCosmo) or trigger_error(mysql_error(),E_USER_ERROR); 
?>			