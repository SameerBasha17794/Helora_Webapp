(function () {
    'use strict';
    angular
        .module('app')
        .controller('Footer', Footer);

    Footer.$inject = ['$cookieStore','UserService', '$rootScope','$scope','$http','$location','$window'];
    function Footer($cookieStore,UserService, $rootScope, $scope,$http,$location,$window) {
        var vm = this;
        $scope.footerLogo = function() {
          $window.scrollTo(0, 0);
        }
    }

})();
