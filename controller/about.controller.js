(function () {
    'use strict';
    angular
        .module('app')
        .controller('AboutController', AboutController);

    AboutController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function AboutController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
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
