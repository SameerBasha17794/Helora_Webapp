(function () {
    'use strict';
    angular
        .module('app')
        .controller('SearchController', SearchController);

    SearchController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function SearchController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();

        function initController() {
            // loadCurrentUser();
            
            // $location.path('/');
        }

        
         $scope.instant = function(name) {
          UserService.setSpeciality(name);
          $location.path('/myspeciality');
        }
        
    }

})();
