(function () {
    'use strict';
    angular
        .module('app')
        .controller('Blog', Blog);

    Blog.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','FlashService'];
    function Blog($cookieStore,UserService, $rootScope, $scope,$http,$location,FlashService) {
        var vm = this;
        $scope.blogList = "";
        initController();
        function initController() {
            var param = JSON.stringify({});
                $http({
                    url: getBlogList,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    $scope.blogList = data.data['list'];
                   
                    
                }).error(function (data, status, headers, config) {
                    FlashService.Error("Something went wrong. Please try again");
                });
        }

    }

})();
