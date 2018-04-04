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
                $scope.total_amount = data.data['total_amount'];
                $scope.date_created = data.data['date_created'];
            }).error(function (data, status, headers, config) {
                console.log("error")
               
            });
        }

        $scope.instant = function() {
        }
    }

})();
