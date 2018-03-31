(function () {
    'use strict';
    angular
        .module('app')
        .controller('RegisterController', RegisterController);

    RegisterController.$inject = ['$cookieStore','UserService','AuthenticationService','$rootScope','$scope','$http','$location','FlashService'];
    function RegisterController($cookieStore,UserService, AuthenticationService,$rootScope, $scope,$http,$location,FlashService) {
    var vm = this;
    vm.register = register;
    vm.login = login;


    function login() {
        vm.dataLoading = true;
            AuthenticationService.Login(vm.uname, vm.password, function (response) {
                alert("here1");
                console.log("here");
                console.log(response);
                if (response.status) {
                    AuthenticationService.SetCredentials(vm.username, vm.password,response.message);
                    $location.path('/');
                } else {
                    FlashService.Error(response.message);
                    console.log("error");
                }
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
