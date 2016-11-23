(function(){

    'use strict';

    angular.module('app')
        .controller('SinglePostCtrl', SinglePostCtrl)
        .controller('ListPostCtrl', ListPostCtrl);

        SinglePostCtrl.$inject = ['$rootScope', '$routeParams', '$location', 'SinglePostFactory', 'CategoryPostFactory', 'activePlugin'];
        function SinglePostCtrl($rootScope, $routeParams, $location, SinglePostFactory, CategoryPostFactory, activePlugin) {

            var vm = this;

            vm.restApiActive    = activePlugin.rest_api;
            vm.acfActive        = activePlugin.acf;

            vm.getPost = getPost;

            var id = $routeParams.id;

            function getPost(id) {
                SinglePostFactory.getPostData(id).then(function(dataResponse) {
                    vm.item = dataResponse.data;
                });
            }

            //Common in ListPostCtrl
            vm.chooseCategory   = chooseCategory;
            $rootScope.selectedCategory = 'all';
            function chooseCategory(term_id) {
                $rootScope.selectedCategory = term_id;
                $location.path('/posts');
            };
            function getCategory() {
                CategoryPostFactory.getCategoryData().then(function(dataResponse) {
                    vm.terms = dataResponse.data;
                });
            };
            function getLastsPost(number) {
                SinglePostFactory.getLastsPostData(number).then(function(dataResponse) {
                    vm.items = dataResponse.data;
                });
            };

            if (vm.restApiActive && vm.acfActive) {
                getLastsPost(5);
                getCategory();
                vm.getPost(id);
            }

        };

        ListPostCtrl.$inject = ['$rootScope', 'PostFactory', 'SinglePostFactory', 'CategoryPostFactory', 'activePlugin'];
        function ListPostCtrl ($rootScope, PostFactory, SinglePostFactory,CategoryPostFactory, activePlugin) {

            var vm = this;

            vm.restApiActive    = activePlugin.rest_api;
            vm.acfActive        = activePlugin.acf;

            vm.chooseCategory   = chooseCategory;

            function chooseCategory(term_id) {
                $rootScope.selectedCategory = term_id;
            };

            function getCategory() {
                CategoryPostFactory.getCategoryData().then(function(dataResponse) {
                    vm.terms = dataResponse.data;
                });
            };

            function getLastsPost(number) {
                SinglePostFactory.getLastsPostData(number).then(function(dataResponse) {
                    vm.items = dataResponse.data;
                });
            };

            if (vm.restApiActive && vm.acfActive) {
                getLastsPost(5);
                getCategory();
                vm.contents = new PostFactory();
            }

        };

})();
