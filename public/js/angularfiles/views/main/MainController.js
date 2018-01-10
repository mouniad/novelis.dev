angular.module('app.controllers.main', [])

.controller('MainController', function(){

})

.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl : 'js/angularfiles/views/main/main.html',
            controller : 'MainController'
        })
})