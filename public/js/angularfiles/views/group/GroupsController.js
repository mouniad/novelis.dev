var error = function(){
    alert('Erro')
}

angular.module('app.controllers.group', [])

    .controller('GroupsController', function($scope, Group){
       Group.list().then(function(response){
           if(response.data.status)
               $scope.groups = response.data.data
           else
               alert(response.data.message)

           console.log($scope.groups)
        },error)
    })
    .controller('GroupsEditController', function($scope, $http){

    })

    .config(function($routeProvider){
        $routeProvider
            .when('/groups', {
                templateUrl: 'js/angularfiles/views/group/list.html',
                controller: 'GroupsController'
            })
            .when('/group/edit/:id?', {
                templateUrl: 'js/angularfiles/views/group/edit.html',
                controller: 'GroupsEditController'
            })
    })