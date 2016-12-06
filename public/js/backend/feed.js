
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
   $http.get("testing.php")
   .then(function (response) {$scope.names = response.data.records;});
});
