var url = "http://www.w3schools.com/website/Customers_HTML.php";
var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    document.getElementById("customersTable").innerHTML = 
      xmlhttp.responseText;
  }
}

xmlhttp.open("GET", url, true);
xmlhttp.send();