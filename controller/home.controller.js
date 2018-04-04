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
            var param = JSON.stringify({});
            $http({
                url: testing,
                method: "POST",
                data: param,
                headers: { 'Content-Type': 'application/json','Access-Control-Allow-Origin': '*' }
            }).success(function (data, status, headers, config) {
                console.log("success");
            }).error(function (data, status, headers, config) {
                console.log("error");

            });
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

        // $scope.iframe = function(name) {
        //   UserService.setSpeciality(name);
        //   $location.path('/myspeciality');
        // }
    }

})();
