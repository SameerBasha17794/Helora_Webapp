(function () {
    'use strict';
    angular
        .module('app')
        .controller('FaqController', FaqController);

    FaqController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function FaqController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();

        function initController() {
        }

      $scope.instant = function() {
        }
        
    }

})();
