(function () {
    'use strict';
    angular
        .module('app')
        .controller('SuccessController', SuccessController);

    SuccessController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','$routeParams'];
    function SuccessController($cookieStore,UserService, $rootScope, $scope,$http,$location,$routeParams) {
        var vm = this;
        if($routeParams.key){
             var key = $routeParams.key;
             key = key.trim();
        }
        initController();
        function initController() {
            var param = JSON.stringify({"payment_id":key});
            $http({
                url: getOrder,
                method: "POST",
                data: param,
                headers: { 'Content-Type': 'application/json' }
            }).success(function (data, status, headers, config) {
                $scope.name = data.data['name'];
                $scope.doctor_name = data.data['doctor_name'];
                $scope.total_amount = data.data['total_amount'];
                $scope.balance = data.data['balance'];
                $scope.phone = data.data['phone'];
                $scope.fax = data.data['fax'];
                $scope.reserve_price = data.data['reserve_price'];
                $scope.date_created = data.data['date_created'];
                $scope.address1 = data.data['address1'];
                $scope.address2 = data.data['address2'];
                $scope.appartment = data.data['appartment'];
                $scope.city = data.data['city'];
                $scope.state = data.data['state'];
                $scope.zip = data.data['zip'];
                $scope.title = data.data['title'];
            }).error(function (data, status, headers, config) {
                console.log("error")
               
            });
        }

        $scope.instant = function() {
        }
    }

})();
