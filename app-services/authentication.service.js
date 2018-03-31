(function () {
    'use strict';

    angular
        .module('app')
        .factory('AuthenticationService', AuthenticationService);

    AuthenticationService.$inject = ['$http','FlashService', '$cookies', '$cookieStore', '$rootScope', '$timeout', 'UserService','$location'];
    function AuthenticationService($http, FlashService , $cookies, $cookieStore, $rootScope, $timeout, UserService,$location){
        var service = {};
        service.Login = Login;
        service.SetCredentials = SetCredentials;
        service.ClearCredentials = ClearCredentials;
        service.Register = Register;
        var submitHit=0;
        return service;
        function Login(username, password, callback) {
            if(submitHit==0){
               submitHit=1
                $http.post(loginUrl, {password: password, user_name :username})
                   .success(function (response) {
                    submitHit=0;
                       if(response.status){
                         var data = response.data[0]['fields'];
                         var json  = {"email": data.email, "phone": data.phone,"fname":data.fname,"lname":data.lname,"id":response.data[0].pk};
                         SetCredentials(username,password,json)
                         return true
                         // $location.path('/');
                       }else{
                        FlashService.Error(response.message);
                        return false
                       }
                   }).error(function (data, status, headers, config) {
                    // $('.loading').css("display", "none");
                    submitHit=0;
                    FlashService.Error('Something went wrong. Please try after sometime.');
                });
            }
        }
        
        function Register(email,fname,lname,phone,dob,sex,password,confirmpassword,check,authkey,otp) {
            if(submitHit==0){
                    submitHit=1
                    var register_success = false;
                    $http.post(newRegister, { 'otp':otp,authKey:authkey , email: email, fname: fname, lname : lname , phoneNumber : phone ,dob : dob ,sex: sex , password : password, confirmPassword : confirmpassword, check : check, businessId:$cookieStore.get('businessId'),policyId:$cookieStore.get('policyId')  })
                       .success(function (response) {
                        submitHit=0
                           if(response.status){
                             register_success = true;
                            $('.loading').css("display", "none");
                            $(".modal-overlay,.modal-box").hide();
                              var data = response.data[0]['fields'];
                              var json  = {"email": email,"businessId": data.business_id,"fname":fname,"lname":lname,"id":response.data[0].pk,"authkey":authkey,"token":response.token,"policyExist":response.policyExist,"alreadyBought":response.alreadyBought,"policyId":response.policyId,"policyPrice":response.policyPrice};
                              SetCredentials(data.email,password,json)
                              if(UserService.getBuyBusinessId()!=0 && UserService.getPolicyExist()!=0 && UserService.getAlreadyBought()!=1){
                                    $cookieStore.remove('businessId');
                                    $cookieStore.remove('policyId');
                                    $location.path("/purchase-policy");
                               }
                               else{
                                    $location.path('/');
                               }
                              $location.path('/');
                           }else{
                                  var register_success = false;
                                 $('#errmsg').html(response.message);
                                 $('.loading').css("display", "none");
                           }
                          
                       }).error(function (data, status, headers, config) {
                         var register_success = false;
                        $('.loading').css("display", "none");
                        FlashService.Error("Something went wrong. Please try after some time.");
                        
                    });
                }
           
            return register_success;
        }
        
        
        function SetCredentials(username,password,UserData) {
            var authdata = Base64.encode(username + ':' + password);
            //console.log(UserData);
            UserService.Create(UserData);
            UserService.setEmail(UserData.email);
            UserService.SetId(UserData.id);
            UserService.SetName(UserData.fname);
            // UserService.setAuthKey(UserData.authkey);
           
            $cookieStore.put('username', UserData.fname);
            $cookieStore.put('forsubdomain','ok');
            $rootScope.globals = {
                currentUser: {
                    username: username,
                    authdata: authdata
                }
            };

            $http.defaults.headers.common['Authorization'] = 'Basic ' + authdata; // jshint ignore:line
            $cookieStore.put('globals', $rootScope.globals);
        }

        function ClearCredentials() {
          
            $rootScope.globals = {};
            $cookieStore.remove('globals');
            $http.defaults.headers.common.Authorization = 'Basic';
            localStorage.clear();
        }
        
        
        }
        function signOut() {
           
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {

            });
        }
     
    
    // Base64 encoding service used by AuthenticationService
    var Base64 = {

        keyStr: 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=',

        encode: function (input) {
            var output = "";
            var chr1, chr2, chr3 = "";
            var enc1, enc2, enc3, enc4 = "";
            var i = 0;

            do {
                chr1 = input.charCodeAt(i++);
                chr2 = input.charCodeAt(i++);
                chr3 = input.charCodeAt(i++);

                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;

                if (isNaN(chr2)) {
                    enc3 = enc4 = 64;
                } else if (isNaN(chr3)) {
                    enc4 = 64;
                }

                output = output +
                    this.keyStr.charAt(enc1) +
                    this.keyStr.charAt(enc2) +
                    this.keyStr.charAt(enc3) +
                    this.keyStr.charAt(enc4);
                chr1 = chr2 = chr3 = "";
                enc1 = enc2 = enc3 = enc4 = "";
            } while (i < input.length);

            return output;
        },

        decode: function (input) {
            var output = "";
            var chr1, chr2, chr3 = "";
            var enc1, enc2, enc3, enc4 = "";
            var i = 0;

            // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
            var base64test = /[^A-Za-z0-9\+\/\=]/g;
            if (base64test.exec(input)) {
                window.alert("There were invalid base64 characters in the input text.\n" +
                    "Valid base64 characters are A-Z, a-z, 0-9, '+', '/',and '='\n" +
                    "Expect errors in decoding.");
            }
            input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

            do {
                enc1 = this.keyStr.indexOf(input.charAt(i++));
                enc2 = this.keyStr.indexOf(input.charAt(i++));
                enc3 = this.keyStr.indexOf(input.charAt(i++));
                enc4 = this.keyStr.indexOf(input.charAt(i++));

                chr1 = (enc1 << 2) | (enc2 >> 4);
                chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                chr3 = ((enc3 & 3) << 6) | enc4;

                output = output + String.fromCharCode(chr1);

                if (enc3 != 64) {
                    output = output + String.fromCharCode(chr2);
                }
                if (enc4 != 64) {
                    output = output + String.fromCharCode(chr3);
                }

                chr1 = chr2 = chr3 = "";
                enc1 = enc2 = enc3 = enc4 = "";

            } while (i < input.length);

            return output;
        }
    };

})();
