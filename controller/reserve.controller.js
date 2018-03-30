(function () {
    'use strict';
    angular
        .module('app')
        .controller('ReserveController', ReserveController);

    ReserveController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function ReserveController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        
        function initController() {
            // var param = JSON.stringify({"procedure":UserService.getProcedureId()});
            //     $http({
            //         url: getAverage,
            //         method: "POST",
            //         data: param,
            //         headers: { 'Content-Type': 'application/json' }
            //     }).success(function (data, status, headers, config) {
            //         $scope.averagePrice = data.data['averagePrice'];
            //         $scope.catName = data.data['catName'];
            //         $scope.cpt = data.data['cpt'];
            //         $scope.desc = data.data['desc'];
            //         $scope.image = data.data['image'];
            //         $scope.insaurancePrice = data.data['insaurancePrice'];
            //         $scope.name = data.data['name'];
            //         $scope.saving = data.data['saving'];
            //         $scope.sku = data.data['sku'];
            //         $scope.doctorList = data.data['doctorPriceList'];
            //     }).error(function (data, status, headers, config) {
            //         console.log("error")
                   
            //     });
        }

        function loadCurrentUser() {
            UserService.GetByUsername($rootScope.globals.currentUser.username)
                .then(function (user) {
                    
                   
            });
        }
        $scope.instant = function() {
          
        }
     
    }

})();
