(function () {
    'use strict';
    angular
        .module('app')
        .controller('ContactController', ContactController);

    ContactController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function ContactController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
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
