(function () {
    'use strict';
    angular
        .module('app')
        .controller('HomeController', HomeController);

    HomeController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function HomeController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        // angular.element('.loading').css("display", "none");
       // angular.element('#element').css('height', '100px');
        initController();
        function initController() {
            // alert("fasfa")s;
            // $('.loading').css("display", "none");
             // angular.element('.loading').css("display", "none");
        }
        function loadCurrentUser() {
            // UserService.GetByUsername($rootScope.globals.currentUser.username)
            //     .then(function (user) {
            // });
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
