(function () {
    'use strict';
    angular
        .module('app')
        .controller('SuccessController', SuccessController);

    SuccessController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','$routeParams'];
    function SuccessController($cookieStore,UserService, $rootScope, $scope,$http,$location,$routeParams) {
        var vm = this;
        alert("test");
        if($routeParams.key){
             var key = $routeParams.key;
             key = key.trim();
        }

        function initController() {
        }

        $scope.instant = function() {
        }
    }

})();
