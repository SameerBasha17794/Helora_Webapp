(function () {
    'use strict';
    angular
        .module('app')
        .controller('CategoryController', CategoryController);

    CategoryController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','$sce'];
    function CategoryController($cookieStore,UserService, $rootScope, $scope,$http,$location,$sce) {
        var vm = this;
        initController();

        function initController() {

           
        }

       

       $scope.instant = function(name) {
          UserService.setSpeciality(name);
          $location.path('/myspeciality');
        }

    
    }

})();
