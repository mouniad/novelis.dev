angular.module('app.services', [])
    .factory('Contact', function($http){
        var base_url = "http://novelis.dev/api/contact/"
        return {
            list : function(){
                return $http.get(base_url + 'list')
            },
            item: function(id){
                return $http.get(base_url + id)
            },
            add : function(formData){
                return $http({
                    method: 'post',
                    url: base_url + 'store',
                    data: formData
                })
            },
            update: function(formData, id){
                return $http({
                    method: 'put',
                    url: base_url + 'update/'+id,
                    data: formData
                })
            },
            delete: function(id){
                return $http.delete(base_url+'delete/'+id)
            }
        }
    })
    .factory('Group', function($http){
        var base_url = "http://novelis.dev/api/contact/group/"
        return {
            list : function(){
                return $http.get(base_url + 'list')
            },
            item: function(id){
                return $http.get(base_url + id)
            },
            add : function(formData){
                return $http({
                    method: 'post',
                    url: base_url + 'store',
                    data: formData
                })
            },
            update: function(formData, id){
                return $http({
                    method: 'put',
                    url: base_url + 'update/'+id,
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    data: formData
                })
            },
            delete: function(id){
                return $http.delete(base_url+'delete/'+id)
            }
        }
    })

    .factory('PhoneType', function($http){
        var base_url = "http://novelis.dev/api/phone-types/"

        return {
            all: function(){
                return $http.get(base_url)
            }
        }
    })