(function () {
    'use strict';
    angular
        .module('app')
        .controller('SelectController', SelectController);

    SelectController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function SelectController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();

        function initController() {
            // loadCurrentUser();
            
            // $location.path('/');
        }

        function loadCurrentUser() {
            UserService.GetByUsername($rootScope.globals.currentUser.username)
                .then(function (user) {
                    
                    // vm.user = $rootScope.globals.currentUser.username;
                    // vm.id = UserService.GetId();
                    // vm.name = UserService.GetName();
                    vm.user = "Testing"
                    vm.id = "123"
                    vm.name = "Testing"
                    $location.path('/');

  
            });
        }
        // $scope.setCredential = function(data,docTypeName,image) {
        //   // UserService.setDoctorType(data);
        //   // UserService.setBookingType(0);
        //   // UserService.setSchAppImage(image);
        //   // UserService.setDoctorTypeName(docTypeName);
        // }
        $scope.instant = function() {
          UserService.setSchAppImage('inner_medical');
          UserService.setDoctorType(1);
          UserService.setBookingType(1);
            var param = JSON.stringify({"businessId": UserService.getBusinessID(),"specialist":"1","date":formatDate(new Date()),"requestFrom":"1","token":UserService.getToken(),"instant":"1","doctorId":"0"});
            $('.loading').css("display", "block");
                $http({
                    url: freeTimeslot,
                    method: "POST",
                    data: param,
                    headers: {'Content-Type': 'application/json'}
                }).success(function (data, status, headers, config) {
                    $('.loading').css("display", "none");
                    if (data.data.length > 0) {
                        UserService.setSlot(data.data[0]['timeSlot']);
                        UserService.setDocId(data.data[0]['doctorId']);
                        UserService.setAppDate(formatDate(new Date()));
                        $location.path('/who-is-patient');
                    }else{
                        $("#instant_error").css("visibility", "visible");
                            setTimeout(function () {
                                $("#instant_error").css("visibility", "hidden");
                            }, 1000);
                    }
                }).error(function (data, status, headers, config) {
                    $('.loading').css("display", "none");
                    $("#instant_error").css("visibility", "visible");
                            setTimeout(function () {
                                $("#instant_error").css("visibility", "hidden");
                            }, 1000);
                    //$scope.status = status + ' ' + headers;
                });
        }
        // function setCredential() {
        //     alert('1');
        // }
    }

})();
