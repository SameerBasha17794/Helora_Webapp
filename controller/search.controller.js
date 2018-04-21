(function () {
    'use strict';
    angular
        .module('app')
        .controller('SearchController', SearchController);

    SearchController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','AuthenticationService','FlashService'];
    function SearchController($cookieStore,UserService, $rootScope, $scope,$http,$location,AuthenticationService,FlashService) {
        var vm = this;
        vm.register = register;
        vm.login = login;
        vm.enterlname = ""
        $('.modal-backdrop').remove();
        $('.dropdown-backdrop').remove();
        $('#myModal').modal('hide');
        loadCurrentUser();
        // alert(UserService.GetId());
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

        function login(){
            var path = "/searchdetail";
            $('.modal-backdrop').remove();
            $('.dropdown-backdrop').remove();
            $('#myModal').modal('hide');
            UserService.setSearchLastName(vm.enterlname);
            AuthenticationService.Login(vm.uname, vm.password1, path, function (response) {
            });
        }

        function register(){
            var path = "/searchdetail";
            $('.modal-backdrop').remove();
            $('.dropdown-backdrop').remove();
            $('#myModal').modal('hide');
            UserService.setSearchLastName(vm.enterlname);
            AuthenticationService.Register(vm.fname,vm.lname,vm.email,vm.phone,vm.password2, vm.promocode, path, function (response) {
            });
        }
        
        $scope.instantSearch = function() {
          if (vm.enterlname.trim()!=""){
            UserService.setSearchLastName(vm.enterlname);
            $location.path('/searchdetail');
          }else{
            FlashService.Error("Enter last name.");
          }
          
        }
        
    }

})();
