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
        service.SocialRegister = SocialRegister;
        service.Register = Register;
        var submitHit=0;
        return service;
        function Login(username, password, callback) {
            /* Dummy authentication for testing, uses $timeout to simulate api call
             ----------------------------------------------*/
            // $timeout(function () {
            //     var response;
            //     UserService.GetByUsername(username)
            //         .then(function (user) {
            //             if (user !== null && user.password === password) {
            //                 response = { success: true };
            //             } else {
            //                 response = { success: false, message: 'Username or password is incorrect' };
            //             }
            //             callback(response);
            //         });
            // }, 1000);

            /* Use this for real authentication
             ----------------------------------------------*/
            $('.loading').css("display", "block");
            if(submitHit==0){
                submitHit=1
                $http.post(splashUrl, { deviceType: "1" })
                   .success(function (responseSplash) {
                       if(responseSplash.status){
                            $http.post(loginNewUrl, {password: password, authKey : responseSplash.authKey,userName :username, businessId:$cookieStore.get('businessId'),policyId:$cookieStore.get('policyId') })
                               .success(function (response) {
                                $('.loading').css("display", "none");
                                submitHit=0;
                                   if(response.status){
                                     var data = response.data[0]['fields'];

                                     var json  = {"walletAmount": response.walletAmount,"email": data.email, "phone": data.phone, "businessId": data.business_id,"fname":data.fname,"lname":data.lname,"id":response.data[0].pk,"authkey":responseSplash.authKey,"token":response.token,"policyExist":response.policyExist,"alreadyBought":response.alreadyBought,"policyId":response.policyId,"policyPrice":response.policyPrice};
                                     SetCredentials(username,password,json)
                                     if(UserService.getBuyBusinessId()!=0 && UserService.getPolicyExist()!=0 && UserService.getAlreadyBought()!=1){
                                        $cookieStore.remove('businessId');
                                        $cookieStore.remove('policyId');
                                        $location.path("/purchase-policy");
                                        }
                                     else{
                                        $location.path('/');
                                        }
                                   }else{
                                    FlashService.Error(response.message);
                                   }
                               }).error(function (data, status, headers, config) {
                                $('.loading').css("display", "none");
                                submitHit=0;
                                FlashService.Error('Something went wrong. Please try after sometime.');
                            });
                       }else{
                        $('.loading').css("display", "none");
                        submitHit=0;
                        alert('Something went wrong.');
                       }
                    }).error(function (data, status, headers, config) {
                        $('.loading').css("display", "none");
                        submitHit=0;
                        alert('Something went wrong. Please try after sometime.');
                        
                    });
            }
            // $http.post(loginUrl, { email: username, password: password, authkey : authkey })
            //    .success(function (response) {
            //        if(response.status){
            //         var data = response.data[0]['fields'];
                    
            //         var json  = {"fname":data.fname,"id":response.data[0].pk};
            //         SetCredentials(username,password,json)
            //          $location.path('/');
            //        }else{
            //         FlashService.Error(response.message);
            //        }
            //    });

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
        function SocialRegister(email,name,gender,method) {
//       alert("register");
        $('.loading').css("display", "block");
        if(method == "google"){
            var through = 2;
        }else{
                var through = 1;
        }
         $http.post(splashUrl, { deviceType: "1" })
               .success(function (responseSplash) {
                   if(responseSplash.status){

            $http.post(socialregisterUrl, { email: email, name: name, gender : gender ,authKey: responseSplash.authKey,through:through })
               .success(function (response) {
                $('.loading').css("display", "none");
                   if(response.status){
                    var data = response.data[0]['fields'];
                       SetSocialCredentials(data.email,data.fname,data.lname,data.user_id,method,response.token,responseSplash.authKey)
                       $location.path('/');
                   }else{
                    $('.loading').css("display", "none");
                   }
                  
               });

             }else{
                $('.loading').css("display", "none");
                alert("error");
            }
               });

        }
        
        function SetSocialCredentials(username, fname,lname,id,method,token,authkey) {
            var authdata = Base64.encode(username + ':' + fname);
            var name = fname + lname
            UserService.Create(username);
            UserService.SetId(id);
            UserService.SetName(name);
            UserService.setEmail(username);
            UserService.setLoginMethod(method);

            UserService.setAuthKey(authkey);
            UserService.setToken(token);
//            alert("setcredentials");
            $rootScope.globals = {
                currentUser: {
                    username: username,
                    authdata: authdata
                }
            };

            $http.defaults.headers.common['Authorization'] = 'Basic ' + authdata; // jshint ignore:line
            $cookieStore.put('globals', $rootScope.globals);
        }

        function SetCredentials(username,password,UserData) {
            var authdata = Base64.encode(username + ':' + password);
            //console.log(UserData);
            UserService.Create(UserData);
            UserService.setEmail(UserData.email);
            UserService.SetId(UserData.id);
            UserService.SetName(UserData.fname);
            UserService.setAuthKey(UserData.authkey);
            UserService.setBusinessID(UserData.businessId);
            UserService.setToken(UserData.token);
            UserService.setWalletBalance(UserData.walletAmount);
            $cookieStore.put('username', UserData.fname);
            $cookieStore.put('forsubdomain','ok');
//            UserService.setPolicyId(UserService.getPolicyId());
            if($cookieStore.get('businessId')!='0' && $cookieStore.get('businessId')!= 'undefined' && $cookieStore.get('policyId')!='0'  && $cookieStore.get('policyId')!='undefined' && UserData.policyId == $cookieStore.get('policyId')){
                UserService.setBuyBusinessId($cookieStore.get('businessId'));
                UserService.setPolicyId($cookieStore.get('policyId'));
                UserService.setPolicyExist(UserData.policyExist);
                UserService.setAlreadyBought(UserData.alreadyBought);
                UserService.setPolPrice(UserData.policyPrice);
            }
            if($cookieStore.get('webid')!='0' && $cookieStore.get('transno')!='0' && $cookieStore.get('checksum')!='0'){
                UserService.setwebid($cookieStore.get('webid'));
                UserService.settransno($cookieStore.get('transno'));
                UserService.setchecksum($cookieStore.get('checksum'));
            }
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
            // var method = UserService.getLoginMethod();
            // if(method == 'google'){
            //     console.log("method: "+method);
            //         signOut();
            //     }
            localStorage.clear();
        }
        
        
    }
        function signOut() {
           
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {

            });
      }
     
     function getMessages(id){
         
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
