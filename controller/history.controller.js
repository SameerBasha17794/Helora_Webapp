(function () {
    'use strict';
    angular
        .module('app')
        .controller('HistoryController', HistoryController);

    HistoryController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function HistoryController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        alert("test");
        function initController() {
        }

        $scope.instant = function() {
        }
    }

})();
