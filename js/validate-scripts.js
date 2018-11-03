(function ( $ ) {
	
	function error_check_on_search_form(element) {
		
		if($(element).hasClass('error')) {
			$(element).parent().addClass('has-error has-feedback');
		}
		if($(element).hasClass('valid')) {
			$(element).parent().removeClass('has-error has-feedback');
		}
	}
	
	
	jQuery.validator.addMethod('postcodeUK', function(value, element) {
		
		error_check_on_search_form(element);
		//console.log(element.parentElement.classList.toggle('has-error','has-feedback'));
		//return this.optional(element) || /^[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}$/i.test(value);
		return this.optional(element) || /^[A-Z]{1,2}[0-9]{1,2}|[A-Z]{1,2}[0-9]{1}[A-Z]{1} ?[0-9][A-Z]{2}$/i.test(value);
		//return this.optional(element) || /^([A-Z][A-Z0-9]?[A-Z0-9] ?[A-Z0-9] ?{1,2}[0-9][A-Z0-9]{2})$/i.test(value);
	}, '<label class="control-label" for="inputError2">Please specify a valid Postcode</label>');
		
	jQuery('#geocode').validate(
		
		{
			debug: true,
			submitHandler: function(form) {
				// some other code
				// maybe disabling submit button
				var postcode = $('input[name="postcode"]').val();
				var postcode = postcode.replace(/\s+/g, '');
				//var geocoder = new google.maps.Geocoder();
				

				var settings = {
					"async": true,
					"crossDomain": true,
					"url": "https://api.postcodes.io/postcodes/"+postcode,
					"method": "GET",
				}


	            var onSuccess = function(results, status) {

					var lat = results.latitude;
					var lng = results.longitude;

                    $(form).prepend('<input type="hidden" name="lat" value="' + lat + '">');
                    $(form).prepend('<input type="hidden" name="lng" value="' + lng + '">');
                    $('input[name="postcode"]').remove();
/*
	                if (status == google.maps.GeocoderStatus.OK) {
	                    result = results[0].geometry.location;	                    
	                    $(form).prepend('<input type="hidden" name="lat" value="' + result.lat() + '">');
	                    $(form).prepend('<input type="hidden" name="lng" value="' + result.lng() + '">');
	                    $('input[name="postcode"]').remove();
	                }
*/
	                
	                
	                //$(form).trigger('submit');
	                form.submit();
	            }
	            
				$.ajax(settings).done(function (response) {
					onSuccess(response.result, true)
				});
				//geocoder.geocode({ 'address': postcode }, onSuccess);
				
				// then:
/*
				form.submit(
					function (form) {
						var geocoder = new google.maps.Geocoder();
				        var that = $(this);
				        var addr;
				        var addrArray = [];
				        
						console.log(that);
						
						$(that).unbind('submit');
			            form.preventDefault();
			            
			            
			            
			            var onSuccess = function(results, status) {
			                if (status == google.maps.GeocoderStatus.OK) {
			                    result = results[0].geometry.location;
			                    $(that).prepend('<input type="hidden" name="lat" value="' + result.lat() + '">');
			                    $(that).prepend('<input type="hidden" name="lng" value="' + result.lng() + '">');
			                    $('input[name="postcode"]').remove();
			                }
			                $(that).trigger('submit');
			            }
			            geocoder.geocode({ 'address': $('input[name="postcode"]').val() }, onSuccess);
					}
				);
*/
			}
			
		}
	
	);

}(jQuery));