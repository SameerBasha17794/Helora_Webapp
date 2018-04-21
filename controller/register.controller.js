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
        var path="/";
        AuthenticationService.Login(vm.uname, vm.password1, path, function (response) {
        });
    }

    function register() {
        vm.dataLoading = true;
        var path="/";
        AuthenticationService.Register(vm.fname,vm.lname,vm.email,vm.phone,vm.password2, vm.promocode, path, function (response) {
        });
    }
 
    }

})();
