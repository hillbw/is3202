var url = "http://www.w3schools.com/website/Customers_JSON.php";

function customersController($scope, $http) {
  $http.get(url).success(function(response) {$scope.names = response;});
}