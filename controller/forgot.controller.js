(function () {
    'use strict';
    angular
        .module('app')
        .controller('ForgotController', ForgotController);

    ForgotController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function ForgotController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();
        
        function initController() {
        }

        function loadCurrentUser() {
        }
       
        $scope.instant = function() {
        }
        
    }

})();
