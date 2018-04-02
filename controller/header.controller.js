(function () {
    'use strict';
    angular
        .module('app')
        .controller('Header', Header);
    
    Header.$inject = ['$location','UserService', '$rootScope','$scope', '$http','$window','$route','$timeout','$sce','$interval'];
    function Header($location,UserService, $rootScope, $scope, $http,$window,$route,$timeout,$sce,$interval){
        var vm = this;
        $scope.name = ""
        loadCurrentUser();
        function loadCurrentUser() {
            if (UserService.GetId()!=""){
                UserService.GetByUsername($rootScope.globals.currentUser.username)
                    .then(function (user) {
                    $scope.user = $rootScope.globals.currentUser.username;
                    $scope.id = UserService.GetId();
                    $scope.name = UserService.GetName();
                });
            }
        }
        $scope.logout = function(id) {
          localStorage.clear();
          $location.path('/');
        }
        
    }
})();