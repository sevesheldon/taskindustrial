function lscfOrderFilterFields(){
	
	var self = this,
		$j = jQuery,
		interval;
	
	this.fieldsData;

	this.draggable = {};

	this.draggable.unbindOrder = function(){
		$j('.px-field-wrapper-container').sortable('destroy');
		$j('.lscf-filter-field').removeClass('lscf-draggable-field');

	}

	this.draggable.initFilterFields = function(){
		
		if ( 'undefined' === typeof capfData.settings.is_administrator || 1 !== capfData.settings.is_administrator ) {
			return false;
		}

		$j('.px-field-wrapper-container').sortable({
			axis:false,
			items:".lscf-filter-field",
			update:function( event, ui ) {
				self.orderFieldsData();
			}
		});

		interval = setInterval(function() {
			self.init();
		}, 300);

	};

	this.orderFieldsData = function(){
		
		var fieldsData = [];
		
		$j('.lscf-filter-field').each(function(){
			
			var index = parseInt( $j(this).attr('data-index') );
			fieldsData.push( self.fieldsData.fields[index] );

		});

		self.resetFieldsIndex();

		self.fieldsData.fields = fieldsData;


		self.updateFieldsDataOrder(function(data){});
	};

	this.updateFieldsDataOrder = function( callback ){
		
		$j.ajax({
			type:"POST",
			url:pxData.ajaxURL,
			data:{
				"action":"lscf-administrator-ajax",
				"section":"update-fields-order",
				"fields":angular.toJson( self.fieldsData.fields ),
				"filter_id":self.fieldsData.filterID
			},
			success:function( data ){
				callback( data );
			},
			dataType:"html"
		})
	}

	this.resetFieldsIndex = function(){

		$j('.lscf-filter-field').each(function(index){
			$j(this).attr({
				'data-index':index
			});
		});

	}

	this.init = function() {
		clearInterval( interval );
		$j('.lscf-filter-field').addClass('lscf-draggable-field');
	};

	
}
