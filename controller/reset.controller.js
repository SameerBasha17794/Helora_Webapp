(function () {
    'use strict';
    angular
        .module('app')
        .controller('ResetController', ResetController);

    ResetController.$inject = ['$cookieStore','UserService', '$rootScope','$routeParams','$scope','$http','$location','FlashService','$window'];
    function ResetController($cookieStore,UserService, $rootScope,$routeParams, $scope,$http,$location,FlashService,$window) {
        var vm = this;
        var key = "";
        if($routeParams.key){
             key = $routeParams.key;
             key = key.trim();
        }
        $scope.reset = 0;
        initController();
        
        function initController() {
            var param = JSON.stringify({"token":key});
            $http({
                    url: verifyToken,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    if (data['status']!="0"){
                        $scope.reset = 1;
                    }else{
                        $scope.reset = 0;
                    }
                   // $location.path('/reset/key');
                }).error(function (data, status, headers, config) {
                   FlashService.Error("Something went wrong. Please try again");   
                });
                

        }
        $scope.instant = function() {
            var param = JSON.stringify({"password":vm.password2,"token":key});
            if(vm.password2!=vm.password)
            {
                FlashService.Error("Password didn't matched");
            }
            else
            {
            $http({
                    url: reset,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    FlashService.success("You have successfully changed password");
                   $location.path('/register');
                }).error(function (data, status, headers, config) {
                   FlashService.Error("Something went wrong. Please try again");   
                });
         //  $location.path('/');
            }
           }


        }
        
    }

)();
