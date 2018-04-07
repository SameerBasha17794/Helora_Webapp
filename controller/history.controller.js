(function () {
    'use strict';
    angular
        .module('app')
        .controller('HistoryController', HistoryController);

    HistoryController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function HistoryController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();
        function initController() {
            var param = JSON.stringify({"user_id":UserService.GetId()});
            $('.loading').css("display", "block");
            $http({
                url: getHistory,
                method: "POST",
                data: param,
                headers: { 'Content-Type': 'application/json' }
            }).success(function (data, status, headers, config) {
                $('.loading').css("display", "none");
                $scope.data = data.data['orderData'];
                $scope.email = data['email'];
                $scope.name = data['name'];
                $scope.phone = data['phone'];
            }).error(function (data, status, headers, config) {
                console.log("error")
               
            });
        }

    }

})();
