( function( api ) {

	// Extends our custom "campus-lite" section.
	api.sectionConstructor['fameuptheme'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );