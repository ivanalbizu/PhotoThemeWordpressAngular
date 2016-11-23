(function(){

    'use strict';

    angular.module('app')
        .controller('HomeCtrl', HomeCtrl);

        HomeCtrl.$inject = ['SinglePostFactory', 'SinglePortfolioFactory', 'activePlugin'];
        function HomeCtrl (SinglePostFactory, SinglePortfolioFactory, activePlugin) {

            var vm = this;

            vm.restApiActive   = activePlugin.rest_api;
            vm.acfActive       = activePlugin.acf;

            function getLastsPost(number) {
                SinglePostFactory.getLastsPostData(number).then(function(dataResponse) {
                    vm.posts = dataResponse.data;
                });
            };

            function getLastsPortfolio(number) {
                SinglePortfolioFactory.getLastsPostData(number).then(function(dataResponse) {
                    vm.portfolios = dataResponse.data;
                });
            };

            if (vm.restApiActive && vm.acfActive) {
                getLastsPost(2);
                getLastsPortfolio(5);
            }
        };

})();
