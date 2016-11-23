(function(){

    'use strict';

    angular.module('app')
        .factory('PostFactory', PostFactory)
        .factory('SinglePostFactory', SinglePostFactory)
        .factory('CategoryPostFactory', CategoryPostFactory);

        PostFactory.$inject = ['$http', 'URL_API'];
        function PostFactory($http, URL_API) {
            var Contents = function() {
                this.items = [];
                this.busy = false;
                this.page = 1;
                this.posts_per_page = 3;
            }
            Contents.prototype.nextPage = function () {
                if(this.busy) return;
                this.busy = true;
                var url = URL_API.BASE_URL + '/wp/v2/posts?filter[posts_per_page]='+this.posts_per_page+'&page='+this.page;
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

        SinglePostFactory.$inject = ['$http', 'URL_API'];
        function SinglePostFactory($http, URL_API) {

            return {
                getPostData: getPostData,
                getLastsPostData: getLastsPostData
            };

            function getPostData(id) {
                return $http.get(URL_API.BASE_URL + '/wp/v2/posts/' + id, {cache: 'true'}).success(function(res){
                    return res;
                });
            };

            function getLastsPostData(number) {
                return $http.get(URL_API.BASE_URL + '/wp/v2/posts?per_page=' + number, {cache: 'true'}).success(function(res){
                    return res;
                });
            };

        };


        CategoryPostFactory.$inject = ['$http', 'URL_API'];
        function CategoryPostFactory($http, URL_API) {

            return {
                getCategoryData: getCategoryData
            }

            function getCategoryData() {
                return $http.get(URL_API.BASE_URL + '/wp/v2/categories', {cache: 'true'}).success(function(res){
                    return res;
                });
            }

        };

})();
