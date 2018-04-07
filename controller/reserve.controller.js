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
                    if (data['status']!="0"){
                        $scope.displayProcedure = data.data;
                        $scope.total = data.data['total'];
                        $scope.balance = data.data['balance'];
                        $scope.reservePrice = data.data['reservePrice'];
                        $scope.covered = data.data['proc_detail'];
                    }else{
                        // alert("here");
                        $location.path('/norecord');
                    }
                }).error(function (data, status, headers, config) {
                    console.log("error")
                   
                });
        }

        $scope.reserve = function(name) {
             var param = JSON.stringify({"temp": "1","total": $scope.total,"balance": $scope.balance,"reservePrice": $scope.reservePrice,"user_id": UserService.GetId(),"doctor_procedure": UserService.getPlan()});
                $http({
                    url: order,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    var url = redirect+"?placeOrderId="+data.data['placeOrderId'];
                    window.location.replace(url);
                }).error(function (data, status, headers, config) {
                    console.log("error")
                   
                });
           // 
        }

    }

})();
