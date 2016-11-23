(function(){

    'use strict';

    angular.module('app')
        .controller('SinglePortfolioCtrl', SinglePortfolioCtrl)
        .controller('ListPortfolioCtrl', ListPortfolioCtrl);

        SinglePortfolioCtrl.$inject = ['$routeParams', 'SinglePortfolioFactory', 'PortfolioIdsFactory', 'activePlugin'];
        function SinglePortfolioCtrl($routeParams, SinglePortfolioFactory, PortfolioIdsFactory, activePlugin) {

            var vm = this;

            vm.restApiActive    = activePlugin.rest_api;
            vm.acfActive        = activePlugin.acf;

            var id = $routeParams.id;

            function getPost(id) {
                SinglePortfolioFactory.getPostData(id).then(function(dataResponse) {
                    vm.item = dataResponse.data;
                });
            }

            function preNextPostLink(id) {
                var ids = [];
                vm.result = {};

                PortfolioIdsFactory.getIdsPostData().then(function(dataResponse) {
                    for (var i = 0; i < dataResponse.data.length; i++) {
                        ids.push(dataResponse.data[i].id);
                    }
                    var id_current = parseInt(id);
                    if( jQuery.inArray(id_current, ids) !== -1 ) {
                        var index = ids.indexOf(id_current);
                        if(index >= 0 && index <= ids.length - 1) {
                            if (index == 0) vm.result.previous = false;
                            else vm.result.previous = ids[index - 1];
                            if (index == ids.length - 1) vm.result.next = false;
                            else vm.result.next = ids[index + 1];
                        } else {
                            vm.result.previous = false;
                            vm.result.next = false;
                        }
                    }
                });
            }

            if (vm.restApiActive && vm.acfActive) {
                preNextPostLink(id);
                getPost(id);
            }

        };

        ListPortfolioCtrl.$inject = ['PortfolioFactory', 'CategoryPortfolioFactory', 'activePlugin'];
        function ListPortfolioCtrl (PortfolioFactory, CategoryPortfolioFactory, activePlugin) {

            var vm = this;

            vm.restApiActive    = activePlugin.rest_api;
            vm.acfActive        = activePlugin.acf;

            vm.chooseCategory   = chooseCategory;
            vm.selectedCategory = 'all';

            function chooseCategory(term_id) {
                vm.selectedCategory = term_id;
            }

            function getCategory() {
                CategoryPortfolioFactory.getCategoryData().then(function(dataResponse) {
                    vm.terms = dataResponse.data;
                });
            }

            if (vm.restApiActive && vm.acfActive) {
                getCategory();
                vm.contents = new PortfolioFactory();
            }

        };

})();
