(function () {
    'use strict';
    angular
        .module('app')
        .controller('ListDoc', ListDoc);

    ListDoc.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function ListDoc($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();

        function initController() {
        }

        $scope.instant = function() {
        }
    }

})();
