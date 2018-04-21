(function () {
    'use strict';
    angular
        .module('app')
        .controller('DoctorController', DoctorController);

    DoctorController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function DoctorController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        
        initFun();
        $scope.showproc = 0;
        $scope.show=0;
        function initFun(){
            var param = JSON.stringify({"doctor_id":UserService.getSearchDoc()});
            // var param = JSON.stringify({"doctor_id":"5aaf29e054fcd32f8205fa05"});
            // var param = JSON.stringify({"doctor_id":"5ac7eadde2a6470641a4abda"});
            $http({
                url: getDoctorProcedure,
                method: "POST",
                data: param,
                headers: { 'Content-Type': 'application/json'}
            }).success(function (data, status, headers, config) {
                if (data['status']!="0"){
                    $scope.doctordetail = data.data['doctordetail'];
                    $scope.procedure = data.data['procedure'];
                    if ($scope.procedure.length >= 1){
                        $scope.showproc=1;
                    }
                    $scope.show=1;
                }else{
                    $scope.show=0;
                    // FlashService.Error("No doctor Listed, Please try another name");
                }
            }).error(function (data, status, headers, config) {
                console.log("errorsss3");

            });
        }

        $scope.selectPlan = function(id){
          UserService.setPlan(id);
          $location.path('/reserve');
        }
        
    }

})();
