// Create a new object for custom validation of a custom field.
var myCustomFieldController = Marionette.Object.extend( {

	initialize: function() {
	
		// Listen to the render:view event for a field type. Example: Textbox field.
		this.listenTo( nfRadio.channel( 'textbox' ), 'render:view', this.renderView );
	},

	renderView: function( view ) {
		
		alert('formloaded');
	
		// Check if this is the right field. Example check for field key.
		if ( 'example_key' != view.model.get( 'key' ) ) return false;
		
		var el = jQuery( view.el ).find( '.nf-element' );
		
		// Do stuff.
	}


});

// On Document Ready...
jQuery( document ).ready( function( $ ) {

	// Instantiate our custom field's controller, defined above.
	new myCustomFieldController();
});
