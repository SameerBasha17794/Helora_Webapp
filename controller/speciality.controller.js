(function () {
    'use strict';
    angular
        .module('app')
        .controller('SpecialityController', SpecialityController);

    SpecialityController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function SpecialityController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();

        function initController() {
            var param = JSON.stringify({"speciality": "Gastroenterology"});
                $http({
                    url: getProcedure,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    $scope.displayProcedure = data.data['procedure'];
                }).error(function (data, status, headers, config) {
                    console.log("error")
                   
                });
        }
        $scope.showProcedure = function(id) {
          UserService.setProcedureId(id);
          $location.path('/select');
        }

        
    }

})();
