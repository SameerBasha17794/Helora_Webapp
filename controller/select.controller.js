(function () {
    'use strict';
    angular
        .module('app')
        .controller('SelectController', SelectController);

    SelectController.$inject = ['$cookieStore','UserService','$route', '$rootScope','$scope','$http','$location','AuthenticationService'];
    function SelectController($cookieStore,UserService, $route, $rootScope, $scope,$http,$location,AuthenticationService) {
        var vm = this;
        vm.register = register;
        vm.login = login;
        $scope.getId = UserService.GetId();
        $('.modal-backdrop').remove();
        $('.dropdown-backdrop').remove();
        $('#myModal').modal('hide');
        initController();
        
        function login(){
            var path = "";
            AuthenticationService.Login(vm.uname, vm.password, path, function (response) {
            });
        }

        function register(){
            var path = "";
            AuthenticationService.Register(vm.fname,vm.lname,vm.email,vm.phone,vm.password, vm.promocode, path, function (response) {
            });
        }

        function initController(){
            var param = JSON.stringify({"procedure":UserService.getProcedureId()});
                $http({
                    url: getAverage,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json'}
                }).success(function (data, status, headers, config) {
                    if (data['status']!="0"){
                        $scope.averagePrice = data.data['averagePrice'];
                        $scope.catName = data.data['catName'];
                        $scope.cpt = data.data['cpt'];
                        $scope.desc = data.data['desc'];
                        $scope.image = data.data['image'];
                        $scope.covered = data.data['detail'];
                        $scope.insaurancePrice = data.data['insaurancePrice'];
                        $scope.name = data.data['name'];
                        $scope.saving = data.data['saving'];
                        $scope.savingPercent = data.data['savingPercent'];
                        $scope.sku = data.data['sku'];
                        $scope.doctorList = data.data['doctorPriceList'];
                    }else{
                        // alert("here");
                        $location.path('/norecord');
                    }
                }).error(function (data, status, headers, config) {
                    console.log("errorsss3");

                });
        }

        $scope.selectPlan = function(id){
          UserService.setPlan(id);
          $location.path('/reserve');
        }

    }

})();
