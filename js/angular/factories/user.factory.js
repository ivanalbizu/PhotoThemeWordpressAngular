(function(){

    'use strict';

    angular.module('app')
        .factory('UserFactory', UserFactory);

        UserFactory.$inject = ['$http', 'URL_API'];
        function UserFactory($http, URL_API) {
            return {
                getUserData: getUserData
            };

            function getUserData(id) {
                return $http.get(URL_API.BASE_URL + '/wp/v2/users/' + id, {cache: 'true'}).success(function(res){
                    return res;
                });
            }

          };

})();
