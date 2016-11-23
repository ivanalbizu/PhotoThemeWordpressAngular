(function(){

    'use strict';

    angular.module('app', [
            'ngAnimate',
            'ngRoute',
            'ngSanitize',
            'infinite-scroll'
        ])
        .config(config)
        .constant('URL_API', {
            BASE_URL: localized.site_url + '/wp-json'
        })
        .value('activePlugin', {
            'rest_api': localized.state_plugin_rest_api,
            'acf': localized.state_plugin_acf
        })
        .run(run);

        function run($rootScope, $location, PortfolioIdsFactory) {
            var path = function() { return $location.path(); };
            $rootScope.$watch(path, function(newVal, oldVal){
                $rootScope.activetab = newVal;
            });
            $rootScope.selectedCategory = 'all';
        }

        function config($routeProvider) {
            $routeProvider
            .when('/', {
                templateUrl: localized.views + 'home.html',
                controller: 'HomeCtrl',
                controllerAs: 'vm'
            })
            .when('/posts', {
                templateUrl: localized.views + 'list-post.html',
                controller: 'ListPostCtrl',
                controllerAs: 'vm'
            })
            .when('/posts/:id', {
                templateUrl: localized.views + 'single-post.html',
                controller: 'SinglePostCtrl',
                controllerAs: 'vm'
            })
            .when('/portfolios', {
                templateUrl: localized.views + 'list-portfolio.html',
                controller: 'ListPortfolioCtrl',
                controllerAs: 'vm'
            })
            .when('/portfolios/:id', {
                templateUrl: localized.views + 'single-portfolio.html',
                controller: 'SinglePortfolioCtrl',
                controllerAs: 'vm'
            })
            .otherwise({
                redirectTo: '/'
            });
        };
})();
