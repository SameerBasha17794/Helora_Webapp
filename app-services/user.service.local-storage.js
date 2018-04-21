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

        
//        service.getWalletBalance = getWalletBalance;
//        service.setWalletBalance = setWalletBalance;
        service.GetId = getId;
        service.SetId = setId;
        service.SetName = setName;
        service.GetName = getName;
        service.setEmail = setEmail;
        service.getEmail = getEmail;

        service.SetUserName = SetUserName;
        service.GetUserName = GetUserName;
        
        service.setSpeciality = setSpeciality;
        service.getSpeciality = getSpeciality;
        service.setProcedureId = setProcedureId;
        service.getProcedureId = getProcedureId;
        service.setDotClicked = setDotClicked;
        service.getDotClicked = getDotClicked;
        service.setBodyParts = setBodyParts;
        service.getBodyParts = getBodyParts;
        service.setCategoryList = setCategoryList;
        service.getCategoryList = getCategoryList;
        service.setPlan = setPlan;
        service.getPlan = getPlan;
        service.setSearchLastName = setSearchLastName;
        service.getSearchLastName = getSearchLastName;
        service.setSearchDoc = setSearchDoc;
        service.getSearchDoc = getSearchDoc;
        
         
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


        // private functions Ends

        // Our Functions

        function getUsers() {
            if(!localStorage.users){
                localStorage.users = JSON.stringify([]);
            }

            return JSON.parse(localStorage.users);
        }
        
        function setUsers(users) {
            localStorage.users = JSON.stringify(users);
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

        function SetUserName(username) {
            localStorage.username = JSON.stringify(username);
        }
        
        function GetUserName(){
            if(!localStorage.username){
                localStorage.username = JSON.stringify("");
            }
            return JSON.parse(localStorage.username);
        }

       function setSpeciality(specialityName) {
            localStorage.specialityName = JSON.stringify(specialityName);
        }
        
        function getSpeciality(){
            if(!localStorage.specialityName){
                localStorage.specialityName = JSON.stringify("");
            }
            return JSON.parse(localStorage.specialityName);
        }

        function setProcedureId(procedureId) {
            localStorage.procedureId = JSON.stringify(procedureId);
        }
        
        function getProcedureId(){
            if(!localStorage.procedureId){
                localStorage.procedureId = JSON.stringify("");
            }
            return JSON.parse(localStorage.procedureId);
        }

        function setDotClicked(dotClicked) {
            localStorage.dotClicked = JSON.stringify(dotClicked);
        }
        
        function getDotClicked(){
            if(!localStorage.dotClicked){
                localStorage.dotClicked = JSON.stringify("");
            }
            return JSON.parse(localStorage.dotClicked);
        }

        function setBodyParts(bodyParts) {
            localStorage.bodyParts = JSON.stringify(bodyParts);
        }
        
        function getBodyParts(){
            if(!localStorage.bodyParts){
                localStorage.bodyParts = JSON.stringify("");
            }
            return JSON.parse(localStorage.bodyParts);
        }
        function setCategoryList(categoryList) {
            localStorage.categoryList = JSON.stringify(categoryList);
        }
        
        function getCategoryList(){
            if(!localStorage.categoryList){
                localStorage.categoryList = JSON.stringify("");
            }
            return JSON.parse(localStorage.categoryList);
        }
        function setName(name){
             localStorage.name = JSON.stringify(name.charAt(0).toUpperCase() + name.slice(1));
        }
        function getName() {
            if(!localStorage.name){
                localStorage.name = JSON.stringify([]);
            }

            return JSON.parse(localStorage.name);
        }

        function setPlan(planid){
             localStorage.planid = JSON.stringify(planid);
        }
        function getPlan() {
            if(!localStorage.planid){
                localStorage.planid = JSON.stringify([]);
            }

            return JSON.parse(localStorage.planid);
        }


        function setSearchLastName(SearchLastName){
             localStorage.SearchLastName = JSON.stringify(SearchLastName);
        }
        function getSearchLastName() {
            if(!localStorage.SearchLastName){
                localStorage.SearchLastName = JSON.stringify([]);
            }
            return JSON.parse(localStorage.SearchLastName);
        }

        function setSearchDoc(SearchDoc){
             localStorage.SearchDoc = JSON.stringify(SearchDoc);
        }
        function getSearchDoc() {
            if(!localStorage.SearchDoc){
                localStorage.SearchDoc = JSON.stringify([]);
            }
            return JSON.parse(localStorage.SearchDoc);
        }

        
       
    }
})();