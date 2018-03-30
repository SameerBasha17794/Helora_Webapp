(function () {
    'use strict';
    angular
        .module('app')
        .controller('SelectController', SelectController);

    SelectController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function SelectController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        vm.register = register;
        vm.login = login;
        $scope.username = UserService.GetUserName();

        function login() {

            var parameters = JSON.stringify({
                "name" : vm.uname, 
                "token" :vm.lpassword,
            });

            $http({
                url: loginUrl,
                method: "POST",
                data: parameters,
                headers: { 'Content-Type': 'application/json' }
            }).success(function (data, status, headers, config) {
                
                UserService.SetUserName(data.data['username']);
                $location.path('/select');

            }).error(function (data, status, headers, config) {
                console.log("error");
               
            });
        }


        function register() {

            var parameters = JSON.stringify({
                "name" : vm.name, 
                "email" :vm.email,
                "phone" :vm.phone,
                "password" :vm.password,
            });

            $http({
                url: registerUrl,
                method: "POST",
                data: parameters,
                headers: { 'Content-Type': 'application/json' }
            }).success(function (data, status, headers, config) {

                UserService.setName(data.data['name']);
                $location.path('/select');
                
            }).error(function (data, status, headers, config) {
                console.log("error");
               
            });
        }




        initController();



        function initController() {
            var param = JSON.stringify({"procedure":UserService.getProcedureId()});
                $http({
                    url: getAverage,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    $scope.averagePrice = data.data['averagePrice'];
                    $scope.catName = data.data['catName'];
                    $scope.cpt = data.data['cpt'];
                    $scope.desc = data.data['desc'];
                    $scope.image = data.data['image'];
                    $scope.insaurancePrice = data.data['insaurancePrice'];
                    $scope.name = data.data['name'];
                    $scope.saving = data.data['saving'];
                    $scope.sku = data.data['sku'];
                    $scope.doctorList = data.data['doctorPriceList'];
                }).error(function (data, status, headers, config) {
                    console.log("error")
                   
                });
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
