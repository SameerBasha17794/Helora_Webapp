(function () {
    'use strict';
    angular
        .module('app')
        .controller('LoginController', LoginController)
    LoginController.$inject = ['$routeParams','$location','$http','$cookieStore', 'AuthenticationService', 'UserService','FlashService','$scope'];
    function LoginController($routeParams ,$location, $http, $cookieStore , AuthenticationService,UserService, FlashService,$scope) {
        var vm = this;
        vm.login = login;
        (function initController() {
           
        })();     
        function login(){
            vm.dataLoading = true;
            AuthenticationService.Login(vm.username, vm.password, function (response) {
                if (response.ResponseCode) {
                    AuthenticationService.SetCredentials(vm.username, vm.password,response.MessageWhatHappen);
                } else {
                    FlashService.Error(response.MessageWhatHappen);
                    vm.dataLoading = false;
                }
            });
        };

        function register(){
            vm.dataLoading = true;
            AuthenticationService.Register(vm.username, vm.password, function (response) {
                if (response.ResponseCode) {
                    AuthenticationService.SetCredentials(vm.username, vm.password,response.MessageWhatHappen);
                    $location.path('/');
                } else {
                    FlashService.Error(response.MessageWhatHappen);
                    vm.dataLoading = false;
                }
            });
        };    
    }
})();
