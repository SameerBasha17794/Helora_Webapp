(function () {
    'use strict';
    angular
        .module('app')
        .controller('ProcedureController', ProcedureController);

    ProcedureController.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location'];
    function ProcedureController($cookieStore,UserService, $rootScope, $scope,$http,$location) {
        var vm = this;
        initController();

        function initController() {

            var param = JSON.stringify({"some_id":"Sample"});
            $('.loading').css("display", "block");
                $http({
                    url: getListing,
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

        function loadCurrentUser() {
            UserService.GetByUsername($rootScope.globals.currentUser.username)
                .then(function (user) {
                    
        
            });
        }
       

        $scope.instant = function() {
        };
        
    }

})();
