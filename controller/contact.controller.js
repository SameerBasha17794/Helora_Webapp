(function () {
    'use strict';
    angular
        .module('app')
        .controller('ContactController', ContactController);

    ContactController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','FlashService'];
    function ContactController($cookieStore,UserService, $rootScope, $scope,$http,$location,FlashService) {
        var vm = this;
        vm.instant = instant;
       
       function instant() {
           var param = JSON.stringify({"email":vm.email, "page":"Contact page","subject":"Contact Page Submit", "data":{
                                                "email":vm.email,
                                                "name":vm.name,
                                                "message":vm.message
                                                }});
                $http({
                    url: sendAllEmail,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    FlashService.Success("Thanks. We will get back to you soon.");
                    vm.email="";
                    vm.name="";
                    vm.message="";
                }).error(function (data, status, headers, config) {
                    FlashService.Error("Something went wrong. Please try again");
                });
       }
    
        
    }

})();
