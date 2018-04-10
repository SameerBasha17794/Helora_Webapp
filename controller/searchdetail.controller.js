(function () {
    'use strict';
    angular
        .module('app')
        .controller('SearchDetail', SearchDetail);

    SearchDetail.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','$routeParams'];
    function SearchDetail
    ($cookieStore,UserService, $rootScope, $scope,$http,$location,$routeParams) {
        var vm = this;
        if($routeParams.key){
             var key = $routeParams.key;
             key = key.trim();
        }
        initController();
        function initController() {
        }

        $scope.instant = function() {
        }
    }

})();
