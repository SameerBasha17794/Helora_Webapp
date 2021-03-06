(function () {
    'use strict';
    angular
        .module('app')
        .controller('Header', Header);
    
    Header.$inject = ['$location','UserService', '$rootScope','$scope', '$http','$window','$route','$timeout','$sce','$interval'];
    function Header($location,UserService, $rootScope, $scope, $http,$window,$route,$timeout,$sce,$interval){
        var vm = this;
        $scope.name = "";
        $window.scrollTo(0, 0);
// alert(name);
        // alert($rootScope.globals.currentUser.username);
        loadCurrentUser();
        // alert(UserService.GetId());
        function loadCurrentUser() {
            if (UserService.GetId()!=""){
                if (typeof $rootScope.globals.currentUser !== 'undefined') {
                    UserService.GetByUsername($rootScope.globals.currentUser.username)
                    .then(function (user) {
                    $scope.user = $rootScope.globals.currentUser.username;
                    $scope.id = UserService.GetId();
                    $scope.name = UserService.GetName();
                    $scope.Doc=0;
                    if (UserService.GetDegree()!="") {
                      $scope.Doc=1;
                      $scope.degree=UserService.GetDegree();

                    }
                    // alert(name);
                });
                }else{
                    // alert("d");
                    localStorage.clear();
                }
            }

        }
        $scope.logout = function(id) {
          localStorage.clear();
          $route.reload();
          $location.path('/');
        }
        $scope.edit = function(id) {
          $window.scrollTo(0, 0);
          //$route.reload();
          $location.path('/edit/');
        }
        $scope.logoClick = function(name) {
          $window.scrollTo(0, 0);
          $location.path('/');
        }
        $scope.headLink = function(name) {
          $window.scrollTo(0, 0);
          $location.path('/'+name);
        }
        
    }
})();
