(function () {
    'use strict';
    angular
        .module('app')
        .controller('RegisterController', RegisterController);

    RegisterController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function RegisterController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
    var vm = this;
    vm.register = register;
    vm.login = login;


    function login() {

        var parameters = JSON.stringify({
            "password" : vm.uname, 
            "user_name" :vm.lpassword,
        });

        $http({
            url: loginUrl,
            method: "POST",
            data: parameters,
            headers: { 'Content-Type': 'application/json' }
        }).success(function (data, status, headers, config) {
            $location.path('/myspeciality');
        }).error(function (data, status, headers, config) {
            console.log("error");
           
        });
    }


    function register() {
        var parameters = JSON.stringify({
            "user_name" : vm.name,
            "first_name" : vm.name,
            "last_name" : vm.name, 
            "email" :vm.email,
            "phone" :vm.phone,
            "password" :vm.password,
        });

        $http({
            url: registerUrl,
            method: "POST",
            data: parameters,
            headers: { 'Content-Type': 'application/json' }
        }).success(function (data, status, headers, config) {

            $location.path('/myspeciality');
            
        }).error(function (data, status, headers, config) {
            console.log("error");
           
        });
    }

        initController();

        function initController() {
            // loadCurrentUser();
            
            // $location.path('/');
        }

        function loadCurrentUser() {
            UserService.GetByUsername($rootScope.globals.currentUser.username)
                .then(function (user) {
                    
                    // vm.user = $rootScope.globals.currentUser.username;
                    // vm.id = UserService.GetId();
                    // vm.name = UserService.GetName();
                    vm.user = "Testing";
                    vm.id = "123";
                    vm.name = "Testing";
                    $location.path('/');

  
            });
        }
       
        $scope.instant = function() {
        };
        // function setCredential() {
        //     alert('1');
        // }
    }

})();
