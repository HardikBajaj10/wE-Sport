var app = angular.module('myApp', []);

app.controller('myController', function($scope, $http) {
    // Fetch JSON data
    $http.get("data.json").then(function(response) {
        $scope.products = response.data.products;
        $scope.tournaments = response.data.tournaments;
    });

    // Sorting function
    $scope.sortBy = 'price';
    $scope.setSort = function(column) {
        $scope.sortBy = column;
    };

    // Buy Now alert
    $scope.showMessage = function(productName) {
        alert("You selected: " + productName);
    };

    // Focus & Blur Effects (For Input Field)
    $scope.onFocus = function() {
        $scope.focusMessage = "You are entering your email...";
    };

    $scope.onBlur = function() {
        $scope.focusMessage = "You left the input field.";
    };

    // Subscribe function
    $scope.subscribe = function() {
        if ($scope.username && $scope.username.trim() !== "") {
            $http.post("http://localhost:3000/subscribe", { email: $scope.username })
                .then(function(response) {
                    alert(response.data.message);
                    $scope.username = ""; // Clears input after subscribing
                })
                .catch(function(error) {
                    alert("Error subscribing. Try again.");
                });
        } else {
            alert("Please enter your email before subscribing.");
        }
    };

    // Watching Changes in Username Input
    $scope.$watch("username", function(newValue, oldValue) {
        console.log("Username changed from", oldValue, "to", newValue);
    });

    // Broadcasting Event When Data is Loaded
    $scope.$broadcast("dataLoaded", { products: $scope.products, tournaments: $scope.tournaments });

    // Listening for Event
    $scope.$on("dataLoaded", function(event, data) {
        console.log("Data Loaded:", data);
    });

    // Emitting an Event Example
    $scope.$emit("appStarted", "App has started successfully!");
});
