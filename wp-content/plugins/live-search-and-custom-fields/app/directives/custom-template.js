angular.module(angAppName)
    .directive('viewmodeCustom', function( customFilterService ) {
		
        return{
            
            restrict:"AE",
            scope:true,
            bindToController: true,
            controllerAs: 'vm',
            link:function( scope, elem, attrs ) {


				scope.directiveInfo.ready = function(){
					
				};					
					
				scope.directiveInfo.afterPostsLoadCallback = function(){};				

			},
			template: '<div ng-include="pluginSettings.filterSettings.theme.custom_template.url">'
		};
	});