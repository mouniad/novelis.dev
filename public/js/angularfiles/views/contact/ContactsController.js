var error = function(){
    alert('Error')
}

var initForm = function(){
    return {
        "firstname": "",
        "lastname": "",
        "group_contact_id": null,
        "emails": [],
        "phones": []
    }
}

var initPhone = function(){
    return {
        "number" : "",
        "phone_type_id" : null
    }
}

var initEmail = function(){
    return {
        "address": ""
    }
}
angular
    .module('app.controllers.contact', [])
    .controller('ContactsController', function($scope, Contact, Group, PhoneType){

        $scope.form = initForm();

        PhoneType.all().then(function(response){
            $scope.phonetypes = response.data.data
        }, error)
        Group.list().then(function(response){
            $scope.groups = response.data.data;
        }, error)

        Contact.list().then(function(response){
            if(response.data.status)
                $scope.contacts = response.data.data
            else
                alert(response.data.message)

            console.log($scope.contacts)
        },error);

        $scope.toggle = function(modalstate, id) {
            $scope.modalstate = modalstate;

            switch (modalstate) {
                case 'add':
                    $scope.form_title = "Add New Contact";
                    break;
                case 'edit':
                    $scope.form_title = "Contact Detail";
                    $scope.id = id;
                    break;
                default:
                    break;
            }
            console.log(id);
            $('#myModal').modal('show');
        };

        $scope.addPhoneInput = function(){
            var newPhone = initPhone();
            $scope.form.phones.push(newPhone);
        }

        $scope.addEmailInput = function(){
            var newEmail = initEmail()

            $scope.form.emails.push(newEmail)
        }

        //save new record / update existing record
        $scope.save = function(modalstate, id) {
                Contact.add($scope.form).then(function(response){
                if(response.data.status){
                    $scope.contacts.push(response.data.data);
                    $('#myModal').modal('hide');
                    $scope.form = initForm();
                }
            },error);

            //append contact id to the URL if the form is in edit mode
            if (modalstate === 'edit'){
               Contact.update($scope.form,id).then(function(response){
                    if(response.data.status)
                        $scope.contact = response.data.data
                    else
                        alert(response.data.message)
                        console.log($scope.contact)
                },error);
                $('#myModal').modal('show');
        }};

        //delete record
        $scope.confirmDelete = function(id) {
            var isConfirmDelete = confirm('Are you sure you want to delete this contact?');
            if (isConfirmDelete) {
                Contact.delete(id).then(function(response){
                    console.log("indexes")
                    var index = -1;
                    if(response.data.status){
                        for(var i = 0 ; i< $scope.contacts.length; i++)
                        {
                            console.log($scope.contacts[i])
                            if($scope.contacts[i].id == id)
                                index = i;
                        }
                        if (index > -1) {
                            $scope.contacts.splice(index, 1);
                        }
                    }
                    else
                        alert(response.data.message)
                        console.log($scope.contacts)
                },error);

            } else {
                return false;
            }
        }
    })
    .controller('ContactItemController', function ($scope, Contact, $routeParams) {
        $scope.item = {};
        Contact.item($routeParams.id).then(function (response) {
            console.log(response.data.data)
            $scope.item = response.data.data
        }, error)
    })
    .config(function ($routeProvider) {
        $routeProvider
            .when('/contacts', {
                templateUrl : 'js/angularfiles/views/contact/list.html',
                controller : 'ContactsController'
            })
            .when('/contact/:id', {
                templateUrl : 'js/angularfiles/views/contact/item.html',
                controller : 'ContactItemController'
            })

    })

