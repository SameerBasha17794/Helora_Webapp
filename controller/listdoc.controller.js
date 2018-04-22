(function () {
    'use strict';
    angular
        .module('app')
        .controller('ListDoc', ListDoc);

    ListDoc.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','FlashService'];
    function ListDoc($cookieStore,UserService, $rootScope, $scope,$http,$location,FlashService) {
        var vm = this;
        vm.Email="";
        vm.Name="";
        vm.Phone="";
        vm.Address="";
        vm.DoctorName="";
        vm.DoctorCity="";
        vm.DoctorEmail="";
        vm.DoctorPhone="";
        vm.DoctorFax="";
        vm.Note="";
        initController();
        function initController() {
        }

        $scope.instant = function() {
            if (vm.Email.trim()==""){
                FlashService.Error("Please Enter Your Email");
            }else if(vm.Name.trim()==""){
                FlashService.Error("Please Enter Your Name");
            }else if(vm.DoctorName.trim()==""){
                FlashService.Error("Please Enter Doctor Name");
            }else if(vm.DoctorCity.trim()==""){
                FlashService.Error("Please Enter Doctor City");
            }else{
                var param = JSON.stringify({"email":vm.Email, "page":"Add My Doctor","subject":"List My Doctor", "data":{
                                                "UserEmail":vm.Email,
                                                "UserName":vm.Name,
                                                "UserPhone":vm.Phone,
                                                "UserAddress":vm.Address,
                                                "DoctorName":vm.DoctorName,
                                                "DoctorCity":vm.DoctorCity,
                                                "DoctorEmail":vm.DoctorEmail,
                                                "DoctorPhone":vm.DoctorPhone,
                                                "DoctorFax":vm.DoctorFax,
                                                "UserNote":vm.Note
                                                }});
                $http({
                    url: sendAllEmail,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    FlashService.Success("Thanks for refrence. We will get back to you soon.");
                    vm.Email="";
                    vm.Name="";
                    vm.Phone="";
                    vm.Address="";
                    vm.DoctorName="";
                    vm.DoctorCity="";
                    vm.DoctorEmail="";
                    vm.DoctorPhone="";
                    vm.DoctorFax="";
                    vm.Note="";
                    
                }).error(function (data, status, headers, config) {
                    FlashService.Error("Something went wrong. Please try again");
                });
            }
        }
    }

})();
