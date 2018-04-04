(function () {
    'use strict';
    angular
        .module('app')
        .controller('FailController', FailController);

    FailController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function FailController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();

        function initController() {
        }

        $scope.instant = function() {
        }
    }

})();
