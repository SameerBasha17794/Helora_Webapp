(function () {
    'use strict';
    angular
        .module('app')
        .controller('VerifyController', VerifyController);

    VerifyController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','$routeParams'];
    function VerifyController($cookieStore,UserService, $rootScope, $scope,$http,$location,$routeParams) {
        var vm = this;
        var key = "";
        if($routeParams.key){
             key = $routeParams.key;
             key = key.trim();
        }
        $scope.verify = 0;
        initController();

        function initController() {
            var param = JSON.stringify({"token":key});
                $http({
                    url: verifyToken,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json'}
                }).success(function (data, status, headers, config) {
                    if (data['status']!="0"){
                        $scope.verify = 1;
                    }else{
                        $scope.verify = 0;
                    }
                }).error(function (data, status, headers, config) {
                    // alert()
                    console.log("errorsss3");

                });
        }

        
    }

})();
