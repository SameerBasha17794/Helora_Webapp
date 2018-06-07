(function () {
    'use strict';
    angular
        .module('app')
        .controller('ForgotController', ForgotController);

    ForgotController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','FlashService','$window'];
    function ForgotController($cookieStore,UserService, $rootScope, $scope,$http,$location,FlashService,$window) {
        var vm = this;
        initController();
        
        function initController() {
            $('.modal-backdrop').remove();
        $('.dropdown-backdrop').remove();            
                

        }
       
        $scope.instant = function() {
         //  $location.path('/');
           var param = JSON.stringify({"email":vm.email});
            $http({
                    url: forgot,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                   $window.alert("Password Reset Link has been sent to your registered Mail id !!!!!");
                   $location.path('/register');
                }).error(function (data, status, headers, config) {
                   FlashService.Error("Something went wrong. Please try again");   
                });
           }


        }
        
    }

)();
