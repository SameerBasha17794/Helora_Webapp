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
       
    }
})();