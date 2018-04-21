(function () {
    'use strict';
    angular
        .module('app')
        .controller('SearchDetail', SearchDetail);

    SearchDetail.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','$routeParams','FlashService'];
    function SearchDetail
    ($cookieStore,UserService, $rootScope, $scope,$http,$location,$routeParams,FlashService) {
        var vm = this;
        // $scope.doctorList = "";
        
        search();
        $scope.instantSearch = function() {
          UserService.setSearchLastName(vm.enterlname);
          search();
        }

        function search(){
            FlashService.clearMessage();
            if(UserService.getSearchLastName().trim()==""){
                FlashService.Error("Enter last name.");
                $scope.doctorList = "";
            }else{
                var param = JSON.stringify({"last_name":UserService.getSearchLastName()});
                $http({
                    url: getDoctors,
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json'}
                }).success(function (data, status, headers, config) {
                    if (data['status']!="0"){
                        $scope.doctorList = data.data['doctorList'];
                    }else{
                        $scope.doctorList = "";
                        FlashService.Error("No doctor Listed, Please try another name");
                    }
                }).error(function (data, status, headers, config) {
                    console.log("errorsss3");

                });
            }
        }

        $scope.selectDoc = function(id){
          UserService.setSearchDoc(id);
          $location.path('/doctor');
        }
    }

})();
