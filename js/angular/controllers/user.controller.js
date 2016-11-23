(function(){

    'use strict';

    angular.module('app')
        .controller('UserCtrl', UserCtrl);

        UserCtrl.$inject = ['UserFactory', 'activePlugin'];
        function UserCtrl(UserFactory, activePlugin) {

            var vm = this;

            vm.restApiActive    = activePlugin.rest_api;
            vm.acfActive        = activePlugin.acf;

            function getUser(id) {
                UserFactory.getUserData(id).then(function(dataResponse) {
                    vm.user = dataResponse.data;
                });
            }

            if (vm.restApiActive && vm.acfActive) {
                getUser('1');
            }

        };

})();
