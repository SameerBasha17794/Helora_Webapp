(function () {
    'use strict';
    angular
        .module('app')
        .controller('ProviderController', ProviderController);

    ProviderController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function ProviderController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();

        function initController() {
        }

        $scope.instant = function() {
        }
    }

})();
