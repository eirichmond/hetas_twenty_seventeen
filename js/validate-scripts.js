(function ( $ ) {

	const isles_locations = {
		GY1:["49.45856","-2.53684"],
		GY2:["49.57871","-2.49362"],
		GY3:["49.52875","-2.45821"],
		GY4:["49.52875","-2.45821"],
		GY5:["49.4826","-2.58101"],
		GY6:["49.52875","-2.45821"],
		GY7:["49.52875","-2.45821"],
		GY8:["49.52875","-2.45821"],
		GY9:["49.57183","-2.28244"],
		IM1:["54.15048","-4.48174"],
		IM2:["54.17891","-4.46857"],
		IM3:["54.17219","-4.45155"],
		IM4:["54.18407","-4.53302"],
		IM5:["54.19316","-4.7065"],
		IM6:["54.28659","-4.58037"],
		IM7:["54.32613","-4.41041"],
		IM8:["54.278","-4.08474"],
		IM9:["54.09184","-4.68352"],
		JE1:["49.19094","-2.11961"],
		JE2:["49.20183","-2.10719"],
		JE3:["49.18581","-2.13418"],
		JE4:["49.19392","-2.09104"]
	}


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


	                form.submit();
				}

				check_isles(postcode);

				$.ajax(settings).done(function (response) {

					onSuccess(response.result, true)
				});
			}

		}
	);

	function check_isles(postcode) {

		if(postcode.indexOf('GY') != -1 || postcode.indexOf('IM') != -1 || postcode.indexOf('JE') != -1 ) {

			//console.log(postcode.substr(0,3));
			var lonLat = generate_isles_geo(postcode.substr(0,3));
			//console.log(lonLat);
			$('#geocode').prepend('<input type="hidden" name="lat" value="' + lonLat["0"] + '">');
			$('#geocode').prepend('<input type="hidden" name="lng" value="' + lonLat["1"] + '">');
			$('input[name="postcode"]').remove();

			document.getElementById("geocode").submit();
		}
	}

	function generate_isles_geo(keyValue) {

		return isles_locations[keyValue];
	}

}(jQuery));