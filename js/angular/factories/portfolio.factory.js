(function(){

    'use strict';

    angular.module('app')
        .factory('PortfolioFactory', PortfolioFactory)
        .factory('PortfolioIdsFactory', PortfolioIdsFactory)
        .factory('SinglePortfolioFactory', SinglePortfolioFactory)
        .factory('CategoryPortfolioFactory', CategoryPortfolioFactory);

        PortfolioFactory.$inject = ['$http', 'URL_API'];
        function PortfolioFactory($http, URL_API) {
            var Contents = function() {
                this.items = [];
                this.busy = false;
                this.page = 1;
                this.posts_per_page = 3;
            }
            Contents.prototype.nextPage = function () {
                if(this.busy) return;
                this.busy = true;
                var url = URL_API.BASE_URL + '/wp/v2/portfolio?filter[posts_per_page]='+this.posts_per_page+'&page='+this.page;
                $http.get(url, {cache: 'true'}).success(function(data) {
                    for (var i = 0; i < data.length; i++) {
                        this.items.push(data[i]);
                    };
                    if (data.length < this.posts_per_page) return;
                    this.page++;
                    this.busy = false;
                }.bind(this));
            };

            return Contents;

        };

        PortfolioIdsFactory.$inject = ['$http', 'URL_API'];
        function PortfolioIdsFactory($http, URL_API) {

            return {
                getIdsPostData: getIdsPostData
            };

            function getIdsPostData(types) {
                return $http.get(URL_API.BASE_URL + '/wp/v2/portfolio?filter[posts_per_page]=-1', {cache: 'true'}).success(function(res){
                    return res;
                });
            }
        };

        SinglePortfolioFactory.$inject = ['$http', 'URL_API'];
        function SinglePortfolioFactory($http, URL_API) {

            return {
                getPostData: getPostData,
                getLastsPostData: getLastsPostData
            };

            function getPostData(id) {
                return $http.get(URL_API.BASE_URL + '/wp/v2/portfolio/' + id, {cache: 'true'}).success(function(res){
                    return res;
                });
            };

            function getLastsPostData(number) {
                return $http.get(URL_API.BASE_URL + '/wp/v2/portfolio?per_page=' + number, {cache: 'true'}).success(function(res){
                    return res;
                });
            };

        };

        CategoryPortfolioFactory.$inject = ['$http', 'URL_API'];
        function CategoryPortfolioFactory($http, URL_API) {

            return {
                getCategoryData: getCategoryData
            }

            function getCategoryData() {
                return $http.get(URL_API.BASE_URL + '/wp/v2/portfolio_category', {cache: 'true'}).success(function(res){
                    return res;
                });
            }

        };

})();
