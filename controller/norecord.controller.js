(function () {
    'use strict';
    angular
        .module('app')
        .controller('NoRecord', NoRecord);

    NoRecord.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function NoRecord($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();

        function initController() {
        }

        $scope.instant = function() {
        }
    }

})();
