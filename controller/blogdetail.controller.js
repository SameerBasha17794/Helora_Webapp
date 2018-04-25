(function () {
    'use strict';
    angular
        .module('app')
        .controller('BlogDetail', BlogDetail);

    BlogDetail.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','FlashService','$routeParams'];
    function BlogDetail($cookieStore,UserService, $rootScope, $scope,$http,$location,FlashService,$routeParams) {
        var vm = this;
        $scope.detail = "";
        if($routeParams.key){
             var key = $routeParams.key;
             key = key.trim();
        }
        initController();
        function initController() {
             var param = JSON.stringify({"url":key});
                $http({
                    url: getBlogDetail,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    $scope.detail = data.data;
                    
                }).error(function (data, status, headers, config) {
                    FlashService.Error("Something went wrong. Please try again");
                });
        }

        $scope.instant = function() {
        }
    }

})();
