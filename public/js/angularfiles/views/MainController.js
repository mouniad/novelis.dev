angular.module('app.controllers.main', [])

.controller('MainController', function($scope){
    $scope.names = ['Karimi khalid','Lassri karim','Karam siham'];
})

.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl : 'js/angularfiles/views/main.html',
            controller : 'MainController'
        })
})