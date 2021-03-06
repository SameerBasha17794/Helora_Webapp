(function () {
    'use strict';
    
    angular
        .module('app', ['ngRoute', 'ngCookies','ngSanitize'])
        .config(config)
        .run(run);

    config.$inject = ['$routeProvider', '$locationProvider'];
    function config($routeProvider, $locationProvider) {
        $routeProvider
            .when('/', {
                controller: 'HomeController',
                templateUrl: 'views/home.view.html',
                controllerAs: 'vm',
                title: 'Welcome'
            })
            .when('/home', {
                controller: 'HomeController',
                templateUrl: 'views/home.view.html',
                controllerAs: 'vm',
                title: 'Welcome'
            })
            .when('/edit', {
                controller: 'Edit_Profile',
                templateUrl: 'views/edit_profile.view.html',
                controllerAs: 'vm',
                title: 'Edit profile'
            })
            .when('/jobs', {
                controller: 'Jobs',
                templateUrl: 'views/jobs.view.html',
                controllerAs: 'vm',
                title: 'Edit profile'
            })
            .when('/doctor', {
                controller: 'DoctorController',
                templateUrl: 'views/doctor.view.html',
                controllerAs: 'vm',
                title: 'Welcome'
            })
            .when('/provider-register', {
                controller: 'ProviderController',
                templateUrl: 'views/provider.view.html',
                controllerAs: 'vm',
                title: 'Provider-register'
            })
            .when('/listdoc', {
                controller: 'ListDoc',
                templateUrl: 'views/listdoc.view.html',
                controllerAs: 'vm',
                title: 'List Doctor'
            })
            .when('/search', {
                controller: 'SearchController',
                templateUrl: 'views/search.view.html',
                controllerAs: 'vm',
                title: 'Search'
            })
            .when('/healthtalks', {
                controller: 'Blog',
                templateUrl: 'views/blog.view.html',
                controllerAs: 'vm',
                title: 'Blog'
            })
            .when('/healthdetail/:key', {
                controller: 'BlogDetail',
                templateUrl: 'views/blogdetail.view.html',
                controllerAs: 'vm',
                title: 'Blog Detail'
            })
            .when('/searchdetail', {
                controller: 'SearchDetail',
                templateUrl: 'views/searchdetail.view.html',
                controllerAs: 'vm',
                title: 'Search'
            })
            .when('/norecord', {
                controller: 'NoRecord',
                templateUrl: 'views/norecord.view.html',
                controllerAs: 'vm',
                title: 'No Record'
            })
            .when('/category', {
                controller: 'CategoryController',
                templateUrl: 'views/category.view.html',
                controllerAs: 'vm',
                title: 'Category'
            })
            .when('/about', {
                controller: 'AboutController',
                templateUrl: 'views/about.view.html',
                controllerAs: 'vm',
                title: 'About'
            })
            .when('/forgot', {
                controller: 'ForgotController',
                templateUrl: 'views/forgot.view.html',
                controllerAs: 'vm',
                title: 'Forgot'
            })
            .when('/reset/:key', {
                controller: 'ResetController',
                templateUrl: 'views/reset.view.html',
                controllerAs: 'vm',
                title: 'Reset'
            })
            .when('/contact', {
                controller: 'ContactController',
                templateUrl: 'views/contact.view.html',
                controllerAs: 'vm',
                title: 'Contact'
            })
            .when('/history', {
                controller: 'HistoryController',
                templateUrl: 'views/history.view.html',
                controllerAs: 'vm',
                title: 'History'
            })
            .when('/reserve', {
                controller: 'ReserveController',
                templateUrl: 'views/reserve.view.html',
                controllerAs: 'vm',
                title: 'Contact'
            })
            .when('/success/:key', {
                controller: 'SuccessController',
                templateUrl: 'views/success.view.html',
                controllerAs: 'vm',
                title: 'Thank you!'
            })
            .when('/fail/:key', {
                controller: 'FailController',
                templateUrl: 'views/fail.view.html',
                controllerAs: 'vm',
                title: 'Contact'
            })
            .when('/confirm/:key', {
                controller: 'VerifyController',
                templateUrl: 'views/verify.view.html',
                controllerAs: 'vm',
                title: 'Verify'
            })
            .when('/select', {
                controller: 'SelectController',
                templateUrl: 'views/select.view.html',
                controllerAs: 'vm',
                title: 'select'
            })
            .when('/faq', {
                controller: 'FaqController',
                templateUrl: 'views/faq.view.html',
                controllerAs: 'vm',
                title: 'Faq'
            })
            .when('/myspeciality', {
                controller: 'SpecialityController',
                templateUrl: 'views/speciality.view.html',
                controllerAs: 'vm',
                title: 'Speciality'
            })
            .when('/docRegister', {
                controller: 'DocRegisterController',
                templateUrl: 'views/doc_register.view.html',
                controllerAs: 'vm',
                title: 'register'
            })
            .when('/register', {
                controller: 'RegisterController',
                templateUrl: 'views/register.view.html',
                controllerAs: 'vm',
                title: 'Search'
            })
           .when('/login', {
                controller: 'HomeController',
                templateUrl: 'views/home.view.html',
                controllerAs: 'vm',
                title: 'Login'
            })

            .when('/procedure', {
                controller: 'ProcedureController',
                templateUrl: 'views/procedure.view.html',
                controllerAs: 'vm',
                title: 'Procedure'
            })
            
            .otherwise({ redirectTo: '/login', title: 'Stay Healthy' });
            
//             enable HTML5mode to disable hashbang urls
             $locationProvider.html5Mode(true);
    }

    run.$inject = ['$rootScope', '$location', '$cookieStore', '$http','UserService'];
    function run($rootScope, $location, $cookieStore, $http,UserService) {
        var norestrict = '';
        $rootScope.globals = $cookieStore.get('globals') || {};
        if ($rootScope.globals.currentUser) {
            $http.defaults.headers.common['Authorization'] = 'Basic ' + $rootScope.globals.currentUser.authdata; // jshint ignore:line
        }

        $rootScope.$on('$locationChangeStart', function (event, next, current) {
            var str = $location.path();
           
            var res = str.split("/");
           

           
        });
         $rootScope.$on('$routeChangeSuccess', function (event, current, previous) {
//              $(".modal-box, .modal-overlay").fadeOut(500, function() {
//                $(".modal-overlay").remove();});
              $rootScope.actualLocation = $location.path();
                if (current.hasOwnProperty('$$route')) {
                    $rootScope.title = current.$$route.title;
                }
        });
         $rootScope.$watch(function () {return $location.path()}, function (newLocation, oldLocation) {
                
            });
    }

})();
