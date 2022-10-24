$( document ).ready(function() {
    $('.delete-product').click( function(event) {
		event.stopPropagation();
		 tc = $(this);
		 var cf = confirm("Are you sure!");
		if (cf == true) {
			url=tc.attr('href');
			$.ajax({
				url: url,
				method: 'post',
				success: function( data ) {
					if(data)
						tc.parent().parent().remove();
				},
			});
		}
		return false;
	});
});