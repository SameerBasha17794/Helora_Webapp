(function () {
    'use strict';
    angular
        .module('app')
        .controller('BlogDetail', BlogDetail);

    BlogDetail.$inject = ['$cookieStore','UserService','$route', '$rootScope','$scope','$http','$location','AuthenticationService','$routeParams','$sce'];
    function BlogDetail($cookieStore,UserService, $route, $rootScope, $scope,$http,$location,AuthenticationService,$routeParams,$sce) {
        var vm = this;
        vm.register = register;
        vm.login = login;
        $scope.getId = UserService.GetId();
        
       // console.log(getId);
        $('.modal-backdrop').remove();
        $('.dropdown-backdrop').remove();
        $('#myModal').modal('hide');
       $scope.detail = "";
        if($routeParams.key){
             var key = $routeParams.key;
             key = key.trim();
        }
        initController();

        function login(){
            var path = "";
            AuthenticationService.Login(vm.uname, vm.password1, path, function (response) {
                // alert("testubg");
            });
        }

        function register(){
            var path = "";
            AuthenticationService.Register(vm.fname,vm.lname,vm.email,vm.phone,vm.password2, vm.promocode, path, function (response) {
                // alert("here");
            });
        }

        function initController() {
             var param = JSON.stringify({"url":key});
                $http({
                    url: getBlogDetail,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    $scope.detail = data.data;
                    $scope.desc=$sce.trustAsHtml(data.data['desc']);
                    
                }).error(function (data, status, headers, config) {
                    FlashService.Error("Something went wrong. Please try again");
                });

               var param1 = JSON.stringify({"url":key});
               $http({
                    url: getComment,
                    method: "POST",
                    data: param1,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    $scope.comment = data.data;
                    
                }).error(function (data, status, headers, config) {
                    FlashService.Error("Something went wrong. Please try again");
                });
        }

        $scope.instant = function(name) {
          UserService.setSpeciality(name);
          $location.path('/myspeciality');
        }

       $scope.addComment = function() {
            var param = JSON.stringify({        "desc":vm.desc,
                                                "url":key,
                                                "name": UserService.GetName(),
                                                "user_id": UserService.GetId()
                                                
                                            });
            console.log(param)
                
                $http({
                    url: addComment,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    console.log("inside")
                    if (data['status']=="1"){
                        console.log("here");
                          
                    }
                     
                    
                    
                }).error(function (data, status, headers, config) {
                    FlashService.Error("Something went wrong. Please try again");
                });
                $route.reload();
        }
    }

})();
