(function () {
    'use strict';
    angular
        .module('app')
        .controller('RegisterController', RegisterController);

    RegisterController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function RegisterController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();

        function initController() {
            // loadCurrentUser();
            
            // $location.path('/');
        }

        function loadCurrentUser() {
            UserService.GetByUsername($rootScope.globals.currentUser.username)
                .then(function (user) {
                    
                    // vm.user = $rootScope.globals.currentUser.username;
                    // vm.id = UserService.GetId();
                    // vm.name = UserService.GetName();
                    vm.user = "Testing"
                    vm.id = "123"
                    vm.name = "Testing"
                    $location.path('/');

  
            });
        }
       
        $scope.instant = function() {
        }
        // function setCredential() {
        //     alert('1');
        // }
    }

})();
