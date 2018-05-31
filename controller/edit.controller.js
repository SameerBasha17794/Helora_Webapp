(function () {
    'use strict';
    angular
        .module('app')
        .controller('Edit_Profile', Edit_Profile);

    Edit_Profile.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','FlashService'];
    function Edit_Profile($cookieStore,UserService, $rootScope, $scope,$http,$location,FlashService) {
        var vm = this;
        initController();

        function initController() {
            var param1 = JSON.stringify({"_id":UserService.GetId()});
               $http({
                    url: edata,
                    method: "POST",
                    data: param1,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    vm.email = data.data["email"];

                    vm.first_name = data.data["first_name"]
                    vm.last_name=data.data["last_name"]
                    vm.phone = data.data["phone"]
                     vm.address_line1 =data.data["address_line1"]
                    vm.address_line2 =data.data["address_line2"]
                    vm.appartment =data.data["appartment"]                
                    vm.state =data.data["state"]
                    vm.city =data.data["city"]
                    vm.zipcode = data.data["zipcode"]
                    vm.company = data.data["company"](function () {
    'use strict';
    angular
        .module('app')
        .controller('Edit_Profile', Edit_Profile);

    Edit_Profile.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$route','$http','$location','FlashService'];
    function Edit_Profile($cookieStore,UserService, $rootScope, $scope,$route,$http,$location,FlashService) {
        var vm = this;
        initController();

        function initController() {
            var param1 = JSON.stringify({"_id":UserService.GetId()});
               $http({
                    url: edata,
                    method: "POST",
                    data: param1,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    vm.email = data.data["email"];

                    vm.first_name = data.data["first_name"]
                    vm.last_name=data.data["last_name"]
                    vm.phone = data.data["phone"]
                    vm.address_line1 =data.data["address_line1"]
                    vm.address_line2 =data.data["address_line2"]
                    vm.appartment =data.data["appartment"]                
                    vm.state =data.data["state"]
                    vm.city =data.data["city"]
                    vm.zipcode = data.data["zipcode"]
                    vm.company = data.data["company"]
                    // $scope.details = data.data;

                    
                }).error(function (data, status, headers, config) {
                    FlashService.Error("Something went wrong. Please try again");
                });      
        }

        $scope.instant = function() {
            var param = JSON.stringify({
                                        "_id":UserService.GetId(),
                                        "email":vm.email,
                                        
                                        "first_name":vm.first_name,
                                        "last_name":vm.last_name,
                                        "phone":vm.phone,
                                        "address_line1":vm.address_line1,
                                        "address_line2":vm.address_line2,
                                        "appartment":vm.appartment,
                                        "city":vm.city,
                                        "state":vm.state,
                                        "zipcode":vm.zipcode,
                                        "company":vm.company,

                                     });
            $http({
                url: edit,
                method: "POST",
                data: param,
                headers: { 'Content-Type': 'application/json'}
            }).success(function (data, status, headers, config) {
                $route.reload();
                FlashService.Success("Successfully edited");
                
            }).error(function (data, status, headers, config) {
                console.log("errorsss3");

            });
        }
    }

})();

                    // $scope.details = data.data;

                    
                }).error(function (data, status, headers, config) {
                    FlashService.Error("Something went wrong. Please try again");
                });      
        }

        $scope.instant = function() {
            var param = JSON.stringify({
                                        "_id":UserService.GetId(),
                                        "email":vm.email,
                                        
                                        "first_name":vm.first_name,
                                        "last_name":vm.last_name,
                                        "phone":vm.phone,
                                        "address_line1":vm.address_line1,
                                        "address_line2":vm.address_line2,
                                        "appartment":vm.appartment,
                                        "city":vm.city,
                                        "state":vm.state,
                                        "zipcode":vm.zipcode,
                                        "company":vm.company,

                                     });
            $http({
                url: edit,
                method: "POST",(function () {
    'use strict';
    angular
        .module('app')
        .controller('Edit_Profile', Edit_Profile);

    Edit_Profile.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$route','$http','$location','FlashService'];
    function Edit_Profile($cookieStore,UserService, $rootScope, $scope,$route,$http,$location,FlashService) {
        var vm = this;
        initController();

        function initController() {
            var param1 = JSON.stringify({"_id":UserService.GetId()});
               $http({
                    url: edata,
                    method: "POST",
                    data: param1,
                    headers: { 'Content-Type': 'application/json' }
                }).success(function (data, status, headers, config) {
                    vm.email = data.data["email"];

                    vm.first_name = data.data["first_name"]
                    vm.last_name=data.data["last_name"]
                    vm.phone = data.data["phone"]
                    vm.address_line1 =data.data["address_line1"]
                    vm.address_line2 =data.data["address_line2"]
                    vm.appartment =data.data["appartment"]                
                    vm.state =data.data["state"]
                    vm.city =data.data["city"]
                    vm.zipcode = data.data["zipcode"]
                    vm.company = data.data["company"]
                    // $scope.details = data.data;

                    
                }).error(function (data, status, headers, config) {
                    FlashService.Error("Something went wrong. Please try again");
                });      
        }

        $scope.instant = function() {
            var param = JSON.stringify({
                                        "_id":UserService.GetId(),
                                        "email":vm.email,
                                        
                                        "first_name":vm.first_name,
                                        "last_name":vm.last_name,
                                        "phone":vm.phone,
                                        "address_line1":vm.address_line1,
                                        "address_line2":vm.address_line2,
                                        "appartment":vm.appartment,
                                        "city":vm.city,
                                        "state":vm.state,
                                        "zipcode":vm.zipcode,
                                        "company":vm.company,

                                     });
            $http({
                url: edit,
                method: "POST",
                data: param,
                headers: { 'Content-Type': 'application/json'}
            }).success(function (data, status, headers, config) {
                $route.reload();
                FlashService.Success("Successfully edited");
                
            }).error(function (data, status, headers, config) {
                console.log("errorsss3");

            });
        }
    }

})();

                data: param,
                headers: { 'Content-Type': 'application/json'}
            }).success(function (data, status, headers, config) {
                FlashService.Success("Successfully edited");
                
            }).error(function (data, status, headers, config) {
                console.log("errorsss3");

            });
        }
    }

})();
