(function () {
    'use strict';
    angular
        .module('app')
        .controller('ReserveController', ReserveController);

    ReserveController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function ReserveController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();
        function initController() {
            var param = JSON.stringify({"doctorProcedureId": UserService.getPlan()});
                $http({
                    url: finalPrice,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    $scope.displayProcedure = data.data;
                }).error(function (data, status, headers, config) {
                    console.log("error")
                   
                });
        }

    }

})();
