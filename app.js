var app = angular.module('myApp', []);

app.controller('myController', function($scope, $http) {
    // Fetch JSON data
    $http.get("data.json").then(function(response) {
        $scope.products = response.data.products;
        $scope.tournaments = response.data.tournaments;
    });

    // Click function
    $scope.showMessage = function(productName) {
        alert("You selected: " + productName);
    };

    // Focus & Blur Effects
    $scope.onFocus = function() {
        $scope.focusMessage = "You are entering your name...";
    };

    $scope.onBlur = function() {
        $scope.focusMessage = "You left the input field.";
    };
// Define AngularJS app
var app = angular.module('myApp', []);

// Define the controller
app.controller('myController', function($scope) {
    // Subscribe function
    $scope.subscribe = function() {
        if ($scope.username && $scope.username.trim() !== "") {
            alert("Thank you, " + $scope.username + "! You have subscribed successfully.");
            $scope.username = ""; // Clears input field after subscribing
        } else {
            alert("Please enter your name before subscribing.");
        }
    };
});




});

