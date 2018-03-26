(function () {
    'use strict';

    angular
        .module('app')
        .factory('UserService', UserService);

    UserService.$inject = ['$timeout', '$filter', '$q'];
    function UserService($timeout, $filter, $q) {

        var service = {};
        service.GetAll = GetAll;
        service.GetById = GetById;
        service.GetByUsername = GetByUsername;
        service.Create = Create;
        service.Update = Update;
        service.Delete = Delete;
        service.GetId = getId;
        service.SetId = setId;
        service.SetName = setName;
        service.GetName = getName;
        service.setDob = setDob;
        service.getDob = getDob;
        service.setSex = setSex;
        service.getSex = getSex;
        service.setLname = setLname;
        service.getLname = getLname;
        service.getFname = getFname;
        service.setFname = setFname;
        service.setDoctorType = setDoctorType; 
        service.getDoctorType = getDoctorType;
        service.setLoginMethod = setLoginMethod;
        service.getLoginMethod = getLoginMethod;
        service.setSlot = setSlot;
        service.getSlot = getSlot;
        service.setDocId = setDocId;
        service.getDocId = getDocId;
        service.setAppDate = setAppDate;
        service.getAppDate = getAppDate;
        service.setChildId = setChildId; 
        service.getChildId = getChildId;
        service.setSomeone = setSomeone; 
        service.getSomeone = getSomeone;
        service.setScheduleId = setScheduleId;
        service.getScheduleId = getScheduleId;
        service.getBookingType = getBookingType;
        service.setBookingType = setBookingType;
        service.setToken = setToken;
        service.getToken = getToken;
        service.setAuthKey = setAuthKey;
        service.getAuthKey = getAuthKey;
        service.setMyAppScheduleId = setMyAppScheduleId;
        service.getMyAppScheduleId = getMyAppScheduleId;
        service.setReschedule = setReschedule;
        service.getReschedule = getReschedule;
        service.setRescheduleID = setRescheduleID;
        service.getRescheduleID = getRescheduleID;
        service.getCoupon = getCoupon;
        service.setCoupon = setCoupon;
        service.setpolicyArray = setpolicyArray;
        service.getpolicyArray = getpolicyArray;
        
        service.setFillScheduleId = setFillScheduleId;
        service.getFillScheduleId = getFillScheduleId;
        service.setEmail = setEmail;
        service.getEmail = getEmail;
        service.setPhone = setPhone;
        service.getPhone = getPhone;
        service.setSchAppImage = setSchAppImage;
        service.getSchAppImage = getSchAppImage;
        service.setDoctorTypeName = setDoctorTypeName;
        service.getDoctorTypeName = getDoctorTypeName;
        service.setCancelId = setCancelId;
        service.getCancelId = getCancelId;
        service.setBookDocId = setBookDocId;
        service.getBookDocId = getBookDocId;
        service.setFollowUpSchId = setFollowUpSchId;
        service.getFollowUpSchId = getFollowUpSchId;
        service.setmandatecheck = setmandatecheck;
        service.getmandatecheck = getmandatecheck;
        service.setnotificationdata = setnotificationdata;
        service.getnotificationdata = getnotificationdata;
        service.setmessagedata = setmessagedata;
        service.getmessagedata = getmessagedata;
        service.setthreadid = setthreadid;
        service.getthreadid = getthreadid;
        service.setchatschid = setchatschid;
        service.getchatschid = getchatschid;
        service.setSlotChanged = setSlotChanged;
        service.getSlotChanged = getSlotChanged;
        service.SetOrderId = SetOrderId;
        service.GetOrderId = GetOrderId;
        service.SetRazorPayId = SetRazorPayId;
        service.GetRazorPayId = GetRazorPayId;

        service.SetRazorOrderId = SetRazorOrderId;
        service.GetRazorOrderId = GetRazorOrderId;
        service.SetRazorPaySignature = SetRazorPaySignature;
        service.GetRazorPaySignature = GetRazorPaySignature;

        service.setOtpUsername = setOtpUsername;
        service.getOtpUsername = getOtpUsername;
        service.getBusinessID= getBusinessID;
        service.setBusinessID = setBusinessID;
        service.getwebid= getwebid;
        service.setwebid= setwebid;
        service.settransno = settransno;
        service.gettransno = gettransno;
        service.getchecksum= getchecksum;
        service.setchecksum= setchecksum;
        service.getamount= getamount;
        service.setamount= setamount;
        service.getOfferId = getOfferId;
        service.setOfferId = setOfferId;
        service.getOfferType = getOfferType;
        service.setOfferType = setOfferType;
        service.getPolicyPrice = getPolicyPrice;
        service.setPolicyPrice = setPolicyPrice;
        service.getPolicyCoupon = getPolicyCoupon;
        service.setPolicyCoupon = setPolicyCoupon;
        service.setPolicyOfferType = setPolicyOfferType;
        service.getPolicyOfferType = getPolicyOfferType;
        service.setPolicyOfferPrice = setPolicyOfferPrice;
        service.getPolicyOfferPrice = getPolicyOfferPrice;
        service.setPolicyTrnsId = setPolicyTrnsId;
        service.getPolicyTrnsId = getPolicyTrnsId;
        service.setPolicyExist = setPolicyExist;
        service.getPolicyExist = getPolicyExist;
        service.setAlreadyBought = setAlreadyBought;
        service.getAlreadyBought = getAlreadyBought;
        service.setPolicyId = setPolicyId;
        service.getPolicyId = getPolicyId;
        service.setPolPrice = setPolPrice;
        service.getPolPrice = getPolPrice;
        service.setBuyBusinessId = setBuyBusinessId;
        service.getBuyBusinessId = getBuyBusinessId;
        service.setBusinessApiPaymentInit = setBusinessApiPaymentInit;
        service.getBusinessApiPaymentInit = getBusinessApiPaymentInit;
        service.getBusinessApiPaymentLoginKey = getBusinessApiPaymentLoginKey;
        service.setBusinessApiPaymentLoginKey = setBusinessApiPaymentLoginKey;
        service.getBusinessApiPaymentScheduleKey = getBusinessApiPaymentScheduleKey;
        service.setBusinessApiPaymentScheduleKey = setBusinessApiPaymentScheduleKey;
        service.getBusinessApiPaymentMerchantKey = getBusinessApiPaymentMerchantKey;
        service.setBusinessApiPaymentMerchantKey = setBusinessApiPaymentMerchantKey;

        service.getTaxAmount = getTaxAmount;
        service.setTaxAmount = setTaxAmount;
        service.getBaseAmount = getBaseAmount;
        service.setBaseAmount = setBaseAmount;

        service.getRealAmount = getRealAmount;
        service.setRealAmount = setRealAmount;
        
        service.getRealTax = getRealTax;
        service.setRealTax = setRealTax;
        
        service.getRealTotal = getRealTotal;
        service.setRealTotal = setRealTotal;
        
        service.getWalletBalance = getWalletBalance;
        service.setWalletBalance = setWalletBalance;
        
        service.getRedeemAmount = getRedeemAmount;
        service.setRedeemAmount = setRedeemAmount;
        
        service.getRealRedeemAmount = getRealRedeemAmount;
        service.setRealRedeemAmount = setRealRedeemAmount;
 

        service.getvayamTechId  =  getvayamTechId;
        service.setvayamTechId  =  setvayamTechId;

        service.getunique_key =   getunique_key;
        service.setunique_key  =  setunique_key;
        
        service.getaisectId   = getaisectId;
        service.setaisectId   = setaisectId;       
        
        
        service.setchannelName   = setchannelName;
        service.getchannelName   = getchannelName;   
        service.setmessagelist   = setmessagelist;
        service.getmessagelist   = getmessagelist;   
        
        
        
        service.setchatdoctor   = setchatdoctor;
        service.getchatdoctor   = getchatdoctor; 
        service.setchatdoctorid   = setchatdoctorid;
        service.getchatdoctorid   = getchatdoctorid; 
//        service.getWalletBalance = getWalletBalance;
//        service.setWalletBalance = setWalletBalance;
        
        

        return service;

        function GetAll() {
            var deferred = $q.defer();
            deferred.resolve(getUsers());
            return deferred.promise;
        }
        
        function GetById(id) {
            var deferred = $q.defer();
            var filtered = $filter('filter')(getUsers(), { id: id });
            var user = filtered.length ? filtered[0] : null;
            deferred.resolve(user);
            return deferred.promise;
        }

        function GetByUsername(username) {
            var deferred = $q.defer();
            var filtered = $filter('filter')(getUsers(), { username: username });
            var user = filtered.length ? filtered[0] : null;
            deferred.resolve(user);
            return deferred.promise;
        }
       

        function Create(user) {
            var deferred = $q.defer();

            // simulate api call with $timeout
            $timeout(function () {
                GetByUsername(user.username)
                    .then(function (duplicateUser) {
                        if (duplicateUser !== null) {
                            deferred.resolve({ success: false, message: 'Username "' + user.username + '" is already taken' });
                        } else {
                            var users = getUsers();

                            // assign id
                            var lastUser = users[users.length - 1] || { id: 0 };
                            user.id = lastUser.id + 1;

                            // save to local storage
                            users.push(user);
                            setUsers(users);

                            deferred.resolve({ success: true });
                        }
                    });
            }, 1000);

            return deferred.promise;
        }

        function Update(user) {
            var deferred = $q.defer();

            var users = getUsers();
            for (var i = 0; i < users.length; i++) {
                if (users[i].id === user.id) {
                    users[i] = user;
                    break;
                }
            }
            setUsers(users);
            deferred.resolve();

            return deferred.promise;
        }

        function Delete(id) {
            var deferred = $q.defer();

            var users = getUsers();
            for (var i = 0; i < users.length; i++) {
                var user = users[i];
                if (user.id === id) {
                    users.splice(i, 1);
                    break;
                }
            }
            setUsers(users);
            deferred.resolve();

            return deferred.promise;
        }

        // private functions

        function getUsers() {
            if(!localStorage.users){
                localStorage.users = JSON.stringify([]);
            }

            return JSON.parse(localStorage.users);
        }
        
        function setOtpUsername(OtpUsername) {
            localStorage.OtpUsername = JSON.stringify(OtpUsername);
        }
        
        function getOtpUsername() {
            if(!localStorage.OtpUsername){
                localStorage.OtpUsername = JSON.stringify("");
            }

            return JSON.parse(localStorage.OtpUsername);
        }
        function setUsers(users) {
            localStorage.users = JSON.stringify(users);
        }
        function setSlotChanged(slotchanged) {
           // alert("slot");
           // alert(slotchanged);
            localStorage.slotchanged = JSON.stringify(slotchanged);
        }
        
        function getSlotChanged() {
            if(!localStorage.slotchanged){
                localStorage.slotchanged = JSON.stringify([]);
            }

            return JSON.parse(localStorage.slotchanged);
        }
        function setId(id) {
           
            localStorage.id = JSON.stringify(id);
        }
        
        function getId() {
            if(!localStorage.id){
                localStorage.id = JSON.stringify([]);
            }
            return JSON.parse(localStorage.id);
        }

        function setEmail(email) {
           
            localStorage.email = JSON.stringify(email);
        }
        
        function getEmail() {
            if(!localStorage.email){
                localStorage.email = JSON.stringify("");
            }

            return JSON.parse(localStorage.email);
        }
        function setPhone(phone) {
           
            localStorage.phone = JSON.stringify(phone);
        }
        
        function getPhone() {
            if(!localStorage.phone){
                localStorage.phone = JSON.stringify("564649842");
            }

            return JSON.parse(localStorage.phone);
        }


        function SetOrderId(orderId) {
           
            localStorage.orderId = JSON.stringify(orderId);
        }
        
        function GetOrderId() {
            if(!localStorage.orderId){
                localStorage.orderId = JSON.stringify("");
            }

            return JSON.parse(localStorage.orderId);
        }
        function SetRazorPayId(tranId) {
           
            localStorage.tranId = JSON.stringify(tranId);
        }
        
        function GetRazorPayId() {
            if(!localStorage.tranId){
                localStorage.tranId = JSON.stringify("");
            }

            return JSON.parse(localStorage.tranId);
        }




        function SetRazorOrderId(RazorOrderId) {
           
            localStorage.RazorOrderId = JSON.stringify(RazorOrderId);
        }
        
        function GetRazorOrderId() {
            if(!localStorage.RazorOrderId){
                localStorage.RazorOrderId = JSON.stringify("");
            }

            return JSON.parse(localStorage.RazorOrderId);
        }


        function SetRazorPaySignature(RazorPaySignature) {
           
            localStorage.RazorPaySignature = JSON.stringify(RazorPaySignature);
        }
        
        function GetRazorPaySignature() {
            if(!localStorage.RazorPaySignature){
                localStorage.RazorPaySignature = JSON.stringify("");
            }

            return JSON.parse(localStorage.RazorPaySignature);
        }


        function setName(name){
             localStorage.name = JSON.stringify(name.charAt(0).toUpperCase() + name.slice(1));
        }
        function setmandatecheck(mandatecheck){
             localStorage.mandatecheck = JSON.stringify(mandatecheck);
        }
        function getmandatecheck(){
            if(!localStorage.mandatecheck){
                localStorage.mandatecheck = JSON.stringify(0);
            }
            return JSON.parse(localStorage.mandatecheck);
        }
        function setLoginMethod(loginmethod){
           
             localStorage.loginmethod = JSON.stringify(loginmethod);
        }
        
        function getLoginMethod(){
            if(!localStorage.loginmethod){
                localStorage.loginmethod = JSON.stringify([]);
            }
            return JSON.parse(localStorage.loginmethod);
        }
    
        function setFname(fname) {
           
            localStorage.fname = JSON.stringify(fname);
        }
        function getFname(){
            if(!localStorage.fname){
                localStorage.fname = JSON.stringify('');
            }

            return JSON.parse(localStorage.fname);
        }


        function setLname(lname) {
           
            localStorage.lname = JSON.stringify(lname);
        }
        function getLname(){
            if(!localStorage.lname){
                localStorage.lname = JSON.stringify('');
            }

            return JSON.parse(localStorage.lname);
        }
        function setDob(dob) {
           
            localStorage.dob = JSON.stringify(dob);
        }
        function getDob(){
            if(!localStorage.dob){
                localStorage.dob = JSON.stringify('');
            }

            return JSON.parse(localStorage.dob);
        }
        function setSex(sex) {
           
            localStorage.sex = JSON.stringify(sex);
        }
        function getSex(){
            if(!localStorage.sex){
                localStorage.sex = JSON.stringify('');
            }

            return JSON.parse(localStorage.sex);
        }


        function getName() {
            if(!localStorage.name){
                localStorage.name = JSON.stringify([]);
            }

            return JSON.parse(localStorage.name);
        }

        function setDoctorType(doctorType) {
           
            localStorage.doctorType = JSON.stringify(doctorType);
        }
        
        function getDoctorType(){
            if(!localStorage.doctorType){
                localStorage.doctorType = JSON.stringify([]);
            }
            return JSON.parse(localStorage.doctorType);
        }
        
        function setChildId(childId) {
            localStorage.childId = JSON.stringify(childId);
        }
        
        function getChildId(){
            if(!localStorage.childId){
                localStorage.childId = JSON.stringify(0);
            }
            return JSON.parse(localStorage.childId);
        }
        
        function setSomeone(status) {
            localStorage.status = JSON.stringify(status);
        }
        
        function getSomeone(){
            if(!localStorage.status){
                localStorage.status = JSON.stringify(0);
            }
            return JSON.parse(localStorage.status);
        }
        function setCoupon(coupon){
             localStorage.coupon = JSON.stringify(coupon);
        }

        function getCoupon(){
            if(!localStorage.coupon){
                localStorage.coupon = JSON.stringify('');
            }
            return JSON.parse(localStorage.coupon);
        }

        function setpolicyArray(policyArray){
             localStorage.policyArray = JSON.stringify(policyArray);
        }
        function getpolicyArray(){
            if(!localStorage.policyArray){
                localStorage.policyArray = JSON.stringify('null');
            }
            return JSON.parse(localStorage.policyArray);
        }


        function setSlot(slot) {
            localStorage.slot = JSON.stringify(slot);
        }
        function getSlot(){
            if(!localStorage.slot){
                localStorage.slot = JSON.stringify([]);
            }
            return JSON.parse(localStorage.slot);
        }
        
        function setDocId(docId) {
            localStorage.docId = JSON.stringify(docId);
        }
        function getDocId(){
            if(!localStorage.docId){
                localStorage.docId = JSON.stringify([]);
            }
            return JSON.parse(localStorage.docId);
        }
        
        function setAppDate(appDate) {
            localStorage.appDate = JSON.stringify(appDate);
        }
        function getAppDate(){
            if(!localStorage.appDate){
                localStorage.appDate = JSON.stringify([]);
            }
            return JSON.parse(localStorage.appDate);
        }
        function setScheduleId(scheduleId) {
            localStorage.scheduleId = JSON.stringify(scheduleId);
        }
        function getScheduleId(){
            if(!localStorage.scheduleId){
                localStorage.scheduleId = JSON.stringify('');
            }
            return JSON.parse(localStorage.scheduleId);
        }
        function setBookingType(bookingType) {
            localStorage.bookingType = JSON.stringify(bookingType);
        }
        function getBookingType(){
            if(!localStorage.bookingType){
                localStorage.bookingType = JSON.stringify(0);
            }
            return JSON.parse(localStorage.bookingType);
        }
        
        function setToken(token) {
            localStorage.token = JSON.stringify(token);
        }
        function getToken(){
            if(!localStorage.token){
                localStorage.token = JSON.stringify([]);
            }
            return JSON.parse(localStorage.token);
        }
        function setAuthKey(authKey) {
           
            localStorage.authKey = JSON.stringify(authKey);
        }
        function getAuthKey(){
            if(!localStorage.authKey){
                localStorage.authKey = JSON.stringify([]);
            }
            return JSON.parse(localStorage.authKey);
        }
        function setMyAppScheduleId(sId) {
            localStorage.sId = JSON.stringify(sId);
        }
        function getMyAppScheduleId(){
            if(!localStorage.sId){
                localStorage.sId = JSON.stringify(0);
            }
            return JSON.parse(localStorage.sId);
        }
        function setReschedule(rescheduleStatus) {
            localStorage.rescheduleStatus = JSON.stringify(rescheduleStatus);
        }
        function getReschedule(){
            if(!localStorage.rescheduleStatus){
                localStorage.rescheduleStatus = JSON.stringify(0);
            }
            return JSON.parse(localStorage.rescheduleStatus);
        }
        function setRescheduleID(rescheduleID) {
            localStorage.rescheduleID = JSON.stringify(rescheduleID);
        }
        function getRescheduleID(){
            if(!localStorage.rescheduleID){
                localStorage.rescheduleID = JSON.stringify(0);
            }
            return JSON.parse(localStorage.rescheduleID);
        }
        function setCancelId(cancelId) {
            localStorage.cancelId = JSON.stringify(cancelId);
        }
        function getCancelId(){
            if(!localStorage.cancelId){
                localStorage.cancelId = JSON.stringify(cancelId);
            }
            return JSON.parse(localStorage.cancelId);
        }
        function setFillScheduleId(fillSchId) {
            localStorage.fillSchId = JSON.stringify(fillSchId);
        }
        function getFillScheduleId(){
            if(!localStorage.fillSchId){
                localStorage.fillSchId = JSON.stringify(0);
            }
            return JSON.parse(localStorage.fillSchId);
        }
        function setSchAppImage(schImage) {
            localStorage.schImage = JSON.stringify(schImage);
        }
        function getSchAppImage(){
            if(!localStorage.schImage){
                localStorage.schImage = JSON.stringify('');
            }
            return JSON.parse(localStorage.schImage);
        }
        function setDoctorTypeName(docTypeName) {
            localStorage.docTypeName = JSON.stringify(docTypeName);
        }
        function getDoctorTypeName(){
            if(!localStorage.docTypeName){
                localStorage.docTypeName = JSON.stringify('');
            }
            return JSON.parse(localStorage.docTypeName);
        }
        function setBookDocId(bookDocId) {
            localStorage.bookDocId = JSON.stringify(bookDocId);
        }
        function getBookDocId(){
            if(!localStorage.bookDocId){
                localStorage.bookDocId = JSON.stringify("0");
            }
            return JSON.parse(localStorage.bookDocId);
        }
        function setFollowUpSchId(followUpSchId) {
            localStorage.followUpSchId = JSON.stringify(followUpSchId);
        }
        function getFollowUpSchId(){
            if(!localStorage.followUpSchId){
                localStorage.followUpSchId = JSON.stringify(0);
            }
            return JSON.parse(localStorage.followUpSchId);
        }
        function setnotificationdata(data) {
            localStorage.notificationdata = JSON.stringify(data);
        }
        function getnotificationdata(){
            if(!localStorage.notificationdata){
                localStorage.notificationdata = JSON.stringify(0);
            }
            return JSON.parse(localStorage.notificationdata);
        }
        function setmessagedata(data) {
            localStorage.messagedata = JSON.stringify(data);
        }
        function getmessagedata(){
            if(!localStorage.messagedata){
                localStorage.messagedata = JSON.stringify(0);
            }
            return JSON.parse(localStorage.messagedata);
        }
        function setthreadid(threadid) {
            localStorage.threadid = JSON.stringify(threadid);
        }
        function getthreadid(){
            if(!localStorage.threadid){
                localStorage.threadid = JSON.stringify('');
            }
            return JSON.parse(localStorage.threadid);
        }
        function setchatschid(chatschid) {
            localStorage.chatschid = JSON.stringify(chatschid);
        }
        function getchatschid(){
            if(!localStorage.chatschid){
                localStorage.chatschid = JSON.stringify('');
            }
            return JSON.parse(localStorage.chatschid);
        }
        

        function setBusinessID(id) {
            localStorage.bid = JSON.stringify(id);
        }
        
        function getBusinessID(){
            if(!localStorage.bid){
                localStorage.bid = JSON.stringify(0);
            }
            return JSON.parse(localStorage.bid);
        }
        
        function setwebid(id) {
            localStorage.webid = JSON.stringify(id);
        }
        
        function getwebid(){
            if(!localStorage.webid || localStorage.webid=='undefined' || localStorage.webid==null){
                localStorage.webid = JSON.stringify(0);
            }
            return JSON.parse(localStorage.webid);
        }
        
        function settransno(id) {
            localStorage.transno = JSON.stringify(id);
        }
        
        function gettransno(){
            if(!localStorage.transno || localStorage.transno=='undefined' || localStorage.transno==null){
                localStorage.transno = JSON.stringify('0');
            }
            return JSON.parse(localStorage.transno);
        }
        
        function setchecksum(id) {
            localStorage.checksum = JSON.stringify(id);
        }
        
        function getchecksum(){
            if(!localStorage.checksum || localStorage.checksum=='undefined' || localStorage.checksum==null){
                localStorage.checksum = JSON.stringify('0');
            }
            return JSON.parse(localStorage.checksum);
        }
        
        function setamount(amount) {
            localStorage.amount = JSON.stringify(amount);
        }
        
        function getamount(){
            if(!localStorage.amount){
                localStorage.amount = JSON.stringify(400);
            }
            return JSON.parse(localStorage.amount);
        }

        function getOfferId(){
            if(!localStorage.offerId){
                localStorage.offerId = JSON.stringify(null);
            }
            return JSON.parse(localStorage.offerId);
        }

        function setOfferId(id){
          localStorage.offerId = JSON.stringify(id);

        }

        function getOfferType(){
            if(!localStorage.offerType){
                localStorage.offerType = JSON.stringify(null);
            }
            return JSON.parse(localStorage.offerType);
        }

        function setOfferType(offerType){
          localStorage.offerType = JSON.stringify(offerType);

        }

        function getPolicyPrice(){
            if(!localStorage.policyPrice){
                localStorage.policyPrice = JSON.stringify(null);
            }
            return JSON.parse(localStorage.policyPrice);
        }

        function setPolicyPrice(policyPrice){
          localStorage.policyPrice = JSON.stringify(policyPrice);

        }

        function getPolicyCoupon(){
            if(!localStorage.policyCoupon){
                localStorage.policyCoupon = JSON.stringify(null);
            }
            return JSON.parse(localStorage.policyCoupon);
        }

        function setPolicyCoupon(policyCoupon){
          localStorage.policyCoupon = JSON.stringify(policyCoupon);

        }
        
        
//        kunal 
        
        function getPolicyOfferType(){
            if(!localStorage.PolicyOfferType){
                localStorage.PolicyOfferType = JSON.stringify(0);
            }
            return JSON.parse(localStorage.PolicyOfferType);
        }

        function setPolicyOfferType(PolicyOfferType){
          localStorage.PolicyOfferType = JSON.stringify(PolicyOfferType);

        }
        
        function getPolicyOfferPrice(){
            if(!localStorage.PolicyOfferPrice){
                localStorage.PolicyOfferPrice = JSON.stringify(0);
            }
            return JSON.parse(localStorage.PolicyOfferPrice);
        }

        function setPolicyOfferPrice(PolicyOfferPrice){
          localStorage.PolicyOfferPrice = JSON.stringify(PolicyOfferPrice);

        }
        
        function getPolicyTrnsId(){
            if(!localStorage.PolicyTrnsId){
                localStorage.PolicyTrnsId = JSON.stringify(0);
            }
            return JSON.parse(localStorage.PolicyTrnsId);
        }

        function setPolicyTrnsId(PolicyTrnsId){
          localStorage.PolicyTrnsId = JSON.stringify(PolicyTrnsId);

        }
       
        function getPolicyExist(){
            if(!localStorage.PolicyExist){
                localStorage.PolicyExist = JSON.stringify(0);
            }
            return JSON.parse(localStorage.PolicyExist);
        }

        function setPolicyExist(PolicyExist){
          localStorage.PolicyExist = JSON.stringify(PolicyExist);

        }
        
        function getAlreadyBought(){
            if(!localStorage.AlreadyBought){
                localStorage.AlreadyBought = JSON.stringify(0);
            }
            return JSON.parse(localStorage.AlreadyBought);
        }

        function setAlreadyBought(AlreadyBought){
          localStorage.AlreadyBought = JSON.stringify(AlreadyBought);
        }
        function getPolicyId(){
            if(!localStorage.PolicyId){
                localStorage.PolicyId = JSON.stringify(0);
            }
            return JSON.parse(localStorage.PolicyId);
        }

        function setPolicyId(PolicyId){
          localStorage.PolicyId = JSON.stringify(PolicyId);
        }
        function getPolPrice(){
            if(!localStorage.PolPrice){
                localStorage.PolPrice = JSON.stringify(0);
            }
            return JSON.parse(localStorage.PolPrice);
        }

        function setPolPrice(PolPrice){
          localStorage.PolPrice = JSON.stringify(PolPrice);
        }
        
        
        function getBuyBusinessId(){
            if(!localStorage.BuyBusinessId || localStorage.BuyBusinessId == 'undefined'){
                localStorage.BuyBusinessId = JSON.stringify(0);
            }
            return JSON.parse(localStorage.BuyBusinessId);
        }

        function setBuyBusinessId(BuyBusinessId){
          localStorage.BuyBusinessId = JSON.stringify(BuyBusinessId);
        }

        function getBusinessApiPaymentInit(){
            if(!localStorage.BusinessApiPaymentInit){
                localStorage.BusinessApiPaymentInit = JSON.stringify(0);
            }
            if(localStorage.BusinessApiPaymentInit=='undefined'){
                localStorage.BusinessApiPaymentInit = JSON.stringify(0);
            }
            return JSON.parse(localStorage.BusinessApiPaymentInit);
        }

        function setBusinessApiPaymentInit(BusinessApiPaymentInit){
          localStorage.BusinessApiPaymentInit = JSON.stringify(BusinessApiPaymentInit);
        }

        function getBusinessApiPaymentLoginKey(){
            if(!localStorage.BusinessApiPaymentLoginKey){
                localStorage.BusinessApiPaymentLoginKey = JSON.stringify(0);
            }
            if(localStorage.BusinessApiPaymentLoginKey=='undefined'){
                localStorage.BusinessApiPaymentLoginKey = JSON.stringify(0);
            }
            return JSON.parse(localStorage.BusinessApiPaymentLoginKey);
        }

        function setBusinessApiPaymentLoginKey(BusinessApiPaymentLoginKey){
          localStorage.BusinessApiPaymentLoginKey = JSON.stringify(BusinessApiPaymentLoginKey);
        }

        function getBusinessApiPaymentScheduleKey(){
            if(!localStorage.BusinessApiPaymentScheduleKey){
                localStorage.BusinessApiPaymentScheduleKey = JSON.stringify(0);
            }
            if(localStorage.BusinessApiPaymentScheduleKey=='undefined'){
                localStorage.BusinessApiPaymentScheduleKey = JSON.stringify(0);
            }
            return JSON.parse(localStorage.BusinessApiPaymentScheduleKey);
        }

        function setBusinessApiPaymentScheduleKey(BusinessApiPaymentScheduleKey){
          localStorage.BusinessApiPaymentScheduleKey = JSON.stringify(BusinessApiPaymentScheduleKey);
        }

        function getBusinessApiPaymentMerchantKey(){
            if(!localStorage.BusinessApiPaymentMerchantKey){
                localStorage.BusinessApiPaymentMerchantKey = JSON.stringify(0);
            }
            if(localStorage.BusinessApiPaymentLoginKey=='undefined'){
                localStorage.BusinessApiPaymentLoginKey = JSON.stringify(0);
            }
            return JSON.parse(localStorage.BusinessApiPaymentMerchantKey);
        }

        function setBusinessApiPaymentMerchantKey(BusinessApiPaymentMerchantKey){
          localStorage.BusinessApiPaymentMerchantKey = JSON.stringify(BusinessApiPaymentMerchantKey);
        }

        function getTaxAmount(){
            if(!localStorage.taxAmount){
                localStorage.taxAmount = JSON.stringify(0);
            }
            return JSON.parse(localStorage.taxAmount);
        }

        function setTaxAmount(taxAmount){
          localStorage.taxAmount = JSON.stringify(taxAmount);
        }

        function getBaseAmount(){
            if(!localStorage.baseAmount){
                localStorage.baseAmount = JSON.stringify(0);
            }
            return JSON.parse(localStorage.baseAmount);
        }

        function setBaseAmount(baseAmount){
          localStorage.baseAmount = JSON.stringify(baseAmount);
        }


        function getRealAmount(){
            if(!localStorage.RealAmount){
                localStorage.RealAmount = JSON.stringify(0);
            }
            return JSON.parse(localStorage.RealAmount);
        }

        function setRealAmount(RealAmount){
          localStorage.RealAmount = JSON.stringify(RealAmount);
        }


        function getRealTax(){
            if(!localStorage.RealTax){
                localStorage.RealTax = JSON.stringify(0);
            }
            return JSON.parse(localStorage.RealTax);
        }

        function setRealTax(RealTax){
          localStorage.RealTax = JSON.stringify(RealTax);
        }
        
        function getRealTotal(){
            if(!localStorage.RealTotal){
                localStorage.RealTotal = JSON.stringify(0);
            }
            return JSON.parse(localStorage.RealTotal);
        }

        function setRealTotal(RealTotal){
          localStorage.RealTotal = JSON.stringify(RealTotal);
        }
        
        function setWalletBalance(WalletBalance){
          localStorage.WalletBalance = JSON.stringify(WalletBalance);
        }

        function getWalletBalance(){
            if(!localStorage.WalletBalance || localStorage.WalletBalance == 'undefined'){
                localStorage.WalletBalance = JSON.stringify(0);
            }
            return JSON.parse(localStorage.WalletBalance);
        }


        
        
        function getRedeemAmount(){
            if(!localStorage.RedeemAmount){
                localStorage.RedeemAmount = JSON.stringify(0);
            }
            if(localStorage.RedeemAmount=='undefined'){
                localStorage.RedeemAmount = JSON.stringify(0);
            }
            return JSON.parse(localStorage.RedeemAmount);
        }

        function setRedeemAmount(RedeemAmount){
          localStorage.RedeemAmount = JSON.stringify(RedeemAmount);
        }
        
        
        function getRealRedeemAmount(){
            if(!localStorage.RealRedeemAmount){
                localStorage.RealRedeemAmount = JSON.stringify(0);
            }
            if(localStorage.RealRedeemAmount=='undefined'){
                localStorage.RealRedeemAmount = JSON.stringify(0);
            }
            return JSON.parse(localStorage.RealRedeemAmount);
        }

        function setRealRedeemAmount(RealRedeemAmount){
          localStorage.RealRedeemAmount = JSON.stringify(RealRedeemAmount);
        }


        function getvayamTechId(){
            if(!localStorage.vayamTechId){
                localStorage.vayamTechId = JSON.stringify(0);
            }
            if(localStorage.vayamTechId=='undefined'){
                localStorage.vayamTechId = JSON.stringify(0);
            }
            return JSON.parse(localStorage.vayamTechId);
        }

        function setvayamTechId(vayamTechId){
          localStorage.vayamTechId = JSON.stringify(vayamTechId);
        }


        function getunique_key(){
            if(!localStorage.unique_key){
                localStorage.unique_key = JSON.stringify(0);
            }
            if(localStorage.unique_key=='undefined'){
                localStorage.unique_key = JSON.stringify(0);
            }
            return JSON.parse(localStorage.unique_key);
        }

        function setunique_key(unique_key){

          localStorage.unique_key = JSON.stringify(unique_key);
          
        }



        function getaisectId(){
            if(!localStorage.aisectId){
                localStorage.aisectId = JSON.stringify(0);
            }
            if(localStorage.aisectId == 'undefined'){
                localStorage.aisectId = JSON.stringify(0);
            }


            return JSON.parse(localStorage.aisectId);
        }

        function setaisectId(aisectId){
          
          localStorage.aisectId = JSON.stringify(aisectId);
         
        }
        
        
        
        function getchannelName(){
            if(!localStorage.channelName){
                localStorage.channelName = JSON.stringify("");
            }
            if(localStorage.channelName == 'undefined' || localStorage.channelName == 0){
                localStorage.channelName = JSON.stringify("");
            }
            return JSON.parse(localStorage.channelName);
        }

        function setchannelName(channelName){
          localStorage.channelName = JSON.stringify(channelName);
        }
        
        function getmessagelist(){
            if(!localStorage.messagelist){
                localStorage.messagelist = JSON.stringify("");
            }
            if(localStorage.messagelist == 'undefined' || localStorage.messagelist == 0){
                localStorage.messagelist = JSON.stringify("");
            }
            return JSON.parse(localStorage.messagelist);
        }

        function setmessagelist(messagelist){
          localStorage.messagelist = JSON.stringify(messagelist);
        }
        
        
        function getchatdoctor(){
            if(!localStorage.chatdoctor){
                localStorage.chatdoctor = JSON.stringify("");
            }
            if(localStorage.chatdoctor == 'undefined' || localStorage.chatdoctor == 0){
                localStorage.chatdoctor = JSON.stringify("");
            }
            return JSON.parse(localStorage.chatdoctor);
        }

        function setchatdoctor(chatdoctor){
          localStorage.chatdoctor = JSON.stringify(chatdoctor);
        }
        
        function getchatdoctorid(){
            if(!localStorage.chatdoctorid){
                localStorage.chatdoctorid = JSON.stringify("");
            }
            if(localStorage.chatdoctorid == 'undefined' || localStorage.chatdoctorid == 0){
                localStorage.chatdoctorid = JSON.stringify("");
            }
            return JSON.parse(localStorage.chatdoctorid);
        }

        function setchatdoctorid(chatdoctorid){
          localStorage.chatdoctorid = JSON.stringify(chatdoctorid);
        }
       
    }
})();