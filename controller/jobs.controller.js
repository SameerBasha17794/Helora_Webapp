(function () {
    'use strict';
    angular
        .module('app')
        .controller('Jobs', Jobs);

    Jobs.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function Jobs($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();

        function initController() {
        }

        $scope.instant = function() {
        }
    }

})();
