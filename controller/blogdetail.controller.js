(function () {
    'use strict';
    angular
        .module('app')
        .controller('BlogDetail', BlogDetail);

    BlogDetail.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','FlashService'];
    function BlogDetail($cookieStore,UserService, $rootScope, $scope,$http,$location,FlashService) {
        var vm = this;
        initController();
        function initController() {
        }

        $scope.instant = function() {
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
                }).error(function (data, status, headers, config) {
                    FlashService.Error("Something went wrong. Please try again");
                });
        }
    }

})();
