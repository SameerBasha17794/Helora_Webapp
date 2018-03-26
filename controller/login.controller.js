(function () {
    'use strict';
    angular
        .module('app')
        .controller('LoginController', LoginController)
    LoginController.$inject = ['$routeParams','$location','$http','$cookieStore', 'AuthenticationService', 'UserService','FlashService','$scope'];
    function LoginController($routeParams ,$location, $http, $cookieStore , AuthenticationService,UserService, FlashService,$scope) {
        var vm = this;
        vm.login = login;
        (function initController() {
            if($cookieStore.get('businessId') == 'undefined' || $cookieStore.get('businessId') == null ||
               $cookieStore.get('policyId') == 'undefined' || $cookieStore.get('policyId') == null)
            {

                var date = new Date();
                var minutes = 30;
                date.setTime(date.getTime() + (minutes * 60 * 1000));
              $cookieStore.put('businessId', 0 ,{expires: date });
              $cookieStore.put('policyId', 0 ,{expires: date });
            }
            if($routeParams.webid != null){
                var date = new Date();
                var minutes = 30;
                date.setTime(date.getTime() + (minutes * 60 * 1000));
                $cookieStore.put('webid', $routeParams.webid,{expires: date });
                $cookieStore.put('transno', $routeParams.transno,{expires: date });
                $cookieStore.put('checksum', $routeParams.checksum,{expires: date });

                

                $http.post(payworldUrl, { merchantName: "Payworld" })
                   .success(function (response) {
                     if(response.status =="1" ){
                        var data = response.data[0];
                        UserService.setBusinessID(data.businessId);
                        $cookieStore.put('businessId',data.businessId);                   
                        } else {
                        FlashService.Error(response.message);
                       }
                   }).error(function (data, status, headers, config) {
                        $('.loading').css("display", "none");
                        FlashService.Error('Something went wrong. Please try after sometime.');
                    });   


            }

            if($routeParams.merchantName != null && $routeParams.merchantName != "vayamtech" && $routeParams.merchantName != "aisect"){
                var date = new Date();
                var minutes = 30;
                date.setTime(date.getTime() + (minutes * 60 * 1000));
                $cookieStore.put('offerId', $routeParams.merchantName,{expires: date });
                $cookieStore.put('offerType', $routeParams.merchantChecksum,{expires: date });
            }

            if( $routeParams.merchantName == "vayamtech"){
            
                $http.post(vayamUrl, { checksum: $routeParams.merchantChecksum })
                   .success(function (response) {
                     if(response.status =="1" ){
                        var data = response.data[0];
                        AuthenticationService.SetCredentials(data.email,'temp_password',data);

                        UserService.setvayamTechId($routeParams.merchantChecksum);
                        UserService.setunique_key(data.unique_key);
                        UserService.setBusinessID(data.businessId);
                        $location.path('/');
                     } else {
                        FlashService.Error(response.message);
                       }
                   }).error(function (data, status, headers, config) {
                        $('.loading').css("display", "none");
                        FlashService.Error('Something went wrong. Please try after sometime.');
                    });     
                }

            if( $routeParams.merchantName == "aisect"){

               
                $http.post(aisectUrl, { checksum: $routeParams.merchantChecksum })
                   .success(function (response) {
                     if(response.status =="1" ){
                        var data = response.data[0];
                        AuthenticationService.SetCredentials(data.email,'temp_password',data);
                        UserService.setaisectId($routeParams.merchantChecksum);
                        UserService.setunique_key(data.kiosk_identifier);
                        UserService.setBusinessID(data.businessId);
              
                        $location.path('/');
                     } else {
                        FlashService.Error(response.message);
                       }
                   }).error(function (data, status, headers, config) {
                        $('.loading').css("display", "none");
                        FlashService.Error('Something went wrong. Please try after sometime.');
                    });     
                }


        })();     
        function login(){
            vm.dataLoading = true;
            AuthenticationService.Login(vm.username, vm.password, function (response) {
                if (response.ResponseCode) {
                    //var userData = JSON.parse(response.MessageWhatHappen);
                    AuthenticationService.SetCredentials(vm.username, vm.password,response.MessageWhatHappen);
                    $location.path('/');
                } else {
                    FlashService.Error(response.MessageWhatHappen);
                    vm.dataLoading = false;
                }
            });
        };   
    }
})();
