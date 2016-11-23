(function(){

    'use strict';

    angular.module('app')

        .filter('isCheckedCategory', isCheckedCategory);

        function isCheckedCategory() {
            return function(values, term_id) {
                if(!term_id || term_id === 'all')
                    return values;

                var output = [];
                angular.forEach(values, function (value) {
                    for ( var i = 0; i < value.post_categories.length; i++ )
                        if (value.post_categories[i].term_id === term_id)
                            output.push(value);
                });

                return output;
              }
        };

})();
