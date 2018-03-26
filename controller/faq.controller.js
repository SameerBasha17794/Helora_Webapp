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

        function loadCurrentUser() {
            UserService.GetByUsername($rootScope.globals.currentUser.username)
                .then(function (user) {
                    
        
            });
        }
       
        $scope.instant = function() {
        }
        
    }

})();
