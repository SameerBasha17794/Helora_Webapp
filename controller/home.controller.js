(function () {
    'use strict';
    angular
        .module('app')
        .controller('HomeController', HomeController);

    HomeController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function HomeController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();

        function initController() {
            // loadCurrentUser();
            
            // $location.path('/');
        }

        function loadCurrentUser() {
            UserService.GetByUsername($rootScope.globals.currentUser.username)
                .then(function (user) {
            
            });
        }
        $scope.instant = function(name) {
          UserService.setSpeciality(name);
          $location.path('/myspeciality');
        }
    }

})();
