(function () {
    'use strict';
    angular
        .module('app')
        .controller('DocRegisterController', DocRegisterController);

    DocRegisterController.$inject = ['$cookieStore','UserService','AuthenticationService','$rootScope','$scope','$http','$location','FlashService'];
    function DocRegisterController($cookieStore,UserService, AuthenticationService,$rootScope, $scope,$http,$location,FlashService) {
    var vm = this;
    vm.register = register;
    vm.login = login;


    function login() {
        vm.dataLoading = true;
        var path="/";
        AuthenticationService.DocLogin(vm.uname, vm.password1, path, function (response) {
        });
    }

    function register() {
        vm.dataLoading = true;
        var path="/";
        AuthenticationService.DocRegister(vm.fname,vm.lname,vm.email,vm.phone,vm.password2, vm.fax,vm.degree_title,vm.mci, path, function (response) {
        });
    }
 
    }

})();
