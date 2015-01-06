/* Get JSON-formatted response from static page */
var url = "http://www.w3schools.com/website/Customers_JSON.php";

/* Get JSON-formatted response from dynamic PHP/MySQL page */
// var url = "http://www.w3schools.com/website/Customers_MYSQL.php";

/* Get JSON-formatted response from dynamic ASP.NET/SQL Server page */
// var url = "http://www.w3schools.com/website/Customers_MYSQL.aspx";

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    populateCustomersTable(xmlhttp.responseText);
  }
}

xmlhttp.open("GET", url, true);
xmlhttp.send();

function populateCustomersTable(response) {
  var arr = JSON.parse(response);
  var i;
  var out = "<table><tr><th>Name</th><th>City</th><th>Country</th></tr>";

  for(i = 0; i < arr.length; i++) {
    out += "<tr><td>" +
    arr [i].Name +
    "</td><td>" +
    arr[i].City +
    "</td><td>" +
    arr[i].Country +
    "</td></tr>";
  }

  out += "</table>"
  document.getElementById("customersTable").innerHTML = out;
}