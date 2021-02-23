(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	jQuery(document).ready(function($){
		var ajaxurl = rexetsy_obj.ajaxurl;
		/**
		 * Submit consumer key, secret
		 * @since 1.0.0
		 */
		$('#etsy_submit').on('click', function(e){
			e.preventDefault();
			 var consumer_key =  $("input[name=consumer_key]").val(),
				consumer_secret =  $("input[name=consumer_secret]").val(),
				payload = {
					'key' 		: consumer_key,
					'secret' 	: consumer_secret,
				};
			   var result = validation_consumer_key_secret(consumer_key,consumer_secret);
			   if(result === 'return_false'){
				  	 	return false;
					}
				wpAjaxHelperRequest('authorize', payload)
				.success(function (response) {
					if (response.url != null) {
						console.log("Successfull..");
						$("#show_response").attr("disabled", true);
						$("#show_response").css({"display":"block","font-size":"15px",'background-color':'green'});
						$("#w3s").attr("href", response.url);
						$('#show_error').hide();
					}
				})
				.error(function (response) {
						console.log("Failed..");
						$("#show_response").hide()
						$('#show_error').css('color','red')
						$('#show_error').html("Failed to generate authorization url")
						setTimeout(function() {
							$('#show_error').hide();
						}, 3000);
						$('#show_error').show();
				});

		});

		/**
		 * Send selected products
		 * @since 1.0.0
		 */
		$(document).on('click', '#send_selectd_data' , function(e) {
			e.preventDefault();
			var $payload = {
				selected: $('.bc-product-search').val(),
				who_made: $('#who_made').val(),
				when_made: $('#when_made').val(),
				shipping_id: $('#shipping_template_id').val(),
				texonomy_id: $('#texonomy_id').val(),
			}

			var result = validate_send_products_form();
			if(result === 'return_false'){
				return false;
			}

			wpAjaxHelperRequest('send_to_etsy', $payload)
				.success(function (response) {
					if (response) {
						console.log("Success..")
						$('#success_mesage').text(response.message);
						setTimeout(function() {
							$("#success_mesage").hide();
						}, 3000);
						$('#success_mesage').show();

					}
				})
				.error(function (response) {
					console.log("Failed..")
					$('#success_mesage').html("Failed to send data");
					setTimeout(function() {
						$("#success_mesage").hide();
					}, 3000);
					$('#success_mesage').hide();

				});
		});


		/**
		 * send all woocommerce product
		 * @since 1.0.0
		 */
		$("#send_all_data").on('click', function(e) {
			e.preventDefault();
			var all_product_ids = $('.product_ids').val()
			 var $payload = {
			 	 selected: $('.product_ids').val(),
				 who_made: $('#who_made').val(),
				 when_made: $('#when_made').val(),
				 shipping_id: $('#shipping_template_id').val(),
				 texonomy_id: $('#texonomy_id').val(),
			}

			var result = validate_send_products_form();
			if(result === 'return_false'){
				return false;
			}

			wpAjaxHelperRequest('send_to_etsy', $payload)
				.success(function (response) {
					console.log("Success..");
					if (response) {
						$('#success_mesage_all_data').text(response.message);
						setTimeout(function() {
							$("#success_mesage_all_data").hide();
						}, 3000);
						$('#success_mesage_all_data').show();

					}
				})
				.error(function (response) {
					console.log("Failed..");
					$('#success_mesage_all_data').html("Failed to send data");
					setTimeout(function() {
						$("#success_mesage_all_data").hide();
					}, 3000);
					$('#success_mesage_all_data').hide();

				});

		});


		/**
		 * delete all woocommerce product
		 */
		$("#delete_all_data").on('click', function(e) {
			e.preventDefault();
			var all_product_ids = $('.product_ids').val()

			wpAjaxHelperRequest('delete_from_etsy', all_product_ids)
				.success(function (response) {
					if (response) {
						$('#show_delete_status').text(response.message);
						setTimeout(function() {
							$("#show_delete_status").hide();
						}, 3000);
						$('#show_delete_status').show();

					}
				})
				.error(function (response) {
					$('#show_delete_status').html("Failed to send data");
					setTimeout(function() {
						$("#show_delete_status").hide();
					}, 3000);
					$('#show_delete_status').hide();

				});

		});


		/**
		 * Ajax search by select two
		 * @since 1.0.0
		 */
		$('.bc-product-search').select2({ ajax: {
			url: ajaxurl,
				data: function (params) {
					return {
						term: params.term,
						action: 'woocommerce_json_search_products_and_variations',
						security: $(this).attr('data-security'),
					};
				},
				processResults: function( data )
				{
					var terms = [];
					if ( data ) {
						$.each( data, function( id, text )
						{
							terms.push( { id: id, text: text } );
						});
					}
					return { results: terms };
					},
				cache: true }
		});


		/**
		 * stop background processing for clearing batch
		 * @since 1.0.0
		 *
		 */
		$("#clear_batch").on('click', function(e) {
			e.preventDefault();
			var clear_batch = 'clear_batch'
			wpAjaxHelperRequest('clear_etsy_batch', clear_batch)
				.success(function (response) {
					console.log("Success...")
					if (response) {
						$('#batch_clear_msg').text("Batch cleared successfully");
						setTimeout(function() {
							$("#batch_clear_msg").hide();
						}, 3000);
						$('#batch_clear_msg').show();
					}
				})
				.error(function (response) {
					console.log("Failed...")
					$('#batch_clear_msg').html("Failed to clear batch");
					setTimeout(function() {
						$("#batch_clear_msg").hide();
					}, 3000);
					$('#batch_clear_msg').hide();

				});
		});


		/**
		 * Create shipping template id
		 * @since 1.0.0
		 */
		$("#create_shippping_id").on('click', function(e) {
			e.preventDefault();
			//get val
			var $shipping_data = {
				shipping_title : $('#shipping_title').val(),
				origin_country_id : $('#origin_country_id').val(),
				primary_cost : $('#primary_cost').val(),
				secondary_cost : $('#secondary_cost').val(),
				min_processing_days :$('#min_processing_days').val(),
				max_processing_days : $('#max_processing_days').val()
			}

			var result = validatte_shipping_template_form();
			if(result === 'return_false'){
				return false;
			}

			wpAjaxHelperRequest('get_shipping_template_id',$shipping_data)
				.success(function (response) {
					console.log("Success...")
					if (response.data.status=='success') {
						if (response.data.shipping_infos.length>0) {
							var row=""
							for (let i = 0; i < response.data.shipping_infos.length; i++) {
								row += '<tr>' +
									'<td>' + response.data.shipping_infos[i].shipping_title + '</td>' +
									'<td>' + response.data.shipping_infos[i].shipping_template_id + '</td>' +
									'<td><input value="' + response.data.shipping_infos[i].shipping_template_id + '" type="hidden" class="delete_shipping_id" ><button class="delete_shipping" ><svg  width="22px" height="22px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" color="red"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></td>' +
									'</tr>';

								var table = '<table class="table">\n' +
									'            <thead>\n' +
									'            <tr>\n' +
									'                <th>Shipping title</th>\n' +
									'                <th>Shipping template id</th>\n' +
									'                <th>Action</th>\n' +
									'            </tr>\n' +
									'            </thead>\n' +
									'            <tbody>\n' +
									'            ' + row + '' +
									'            </tbody>\n' +
									'        </table>';
								;

							}
							$('#generate_shipping_template_id').html("Shipping Template id generated successfully");
							setTimeout(function() {
								 		$("#generate_shipping_template_id").hide();
								 	}, 3000);
							$('#generate_shipping_template_id').show();

							$("#shipping_table").css('visibility','hidden');
							$("#shipping_table").html(table);
							$("#shipping_table").css('visibility','visible');
						}
						else if(response.data.shipping_infos.length==0){

							$("#shipping_table").css('visibility','hidden');
							$("#shipping_table").html("no shipping infos");
							$("#shipping_table").css('visibility','visible');
						}
					}
					if(response.data.status=='failed'){
						$('#generate_shipping_template_id').css('color','red');
						$('#generate_shipping_template_id').html("Shipping title must be unique");
						setTimeout(function() {
							$("#generate_shipping_template_id").hide();
						}, 3000);
						$('#generate_shipping_template_id').show();
					}

				})
				.error(function (response) {
					console.log("Failed...")
					$('#generate_shipping_template_id').html("Failed!!Please try again");
					setTimeout(function() {
						$("#generate_shipping_template_id").hide();
					}, 3000);
					$('#generate_shipping_template_id').show();

				});
		});


		/**
		 * Delete shipping template id for clearing batch
		 * @since 1.0.0
		 */
		$(document).on('click', '.delete_shipping' , function() {
			//code here ....
			let connect_btn = $(this);
			let parent = connect_btn.parent('td');
			var shipping_id = parent.find(".delete_shipping_id").val();

			//var shipping_id = parent.find("input[name='delete_shipping_id']").val();

			console.log(parent, shipping_id,$(this) )

			// if(shipping_id==null){
			// 	return false;
			// }

			var $shipping_id = {
				shipping_id : shipping_id,
			}
			wpAjaxHelperRequest('delete_shipping_template_id',$shipping_id)
				.success(function (response) {
					console.log("Success...")
					console.log(response)
					if (response) {
						if (response.data.shipping_infos.length>0) {
							var row=""
							for (let i = 0; i < response.data.shipping_infos.length; i++) {
								row += '<tr>' +
									'<td>' + response.data.shipping_infos[i].shipping_title + '</td>' +
									'<td>' + response.data.shipping_infos[i].shipping_template_id + '</td>' +
									'<td><input value="' + response.data.shipping_infos[i].shipping_template_id + '" type="hidden" class="delete_shipping_id" ><button class="delete_shipping" ><svg  width="22px" height="22px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" color="red"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></td>' +
									'</tr>';

								var table = '<table class="table">\n' +
									'            <thead>\n' +
									'            <tr>\n' +
									'                <th>Shipping title</th>\n' +
									'                <th>Shipping template id</th>\n' +
									'                <th>Action</th>\n' +
									'            </tr>\n' +
									'            </thead>\n' +
									'            <tbody>\n' +
									'            ' + row + '' +
									'            </tbody>\n' +
									'        </table>';
								;

							}
							$('#shipping_id_delete_status').html("Shipping id deleted successfully.");
							setTimeout(function() {
								$("#shipping_id_delete_status").hide();
							}, 3000);
							$('#shipping_id_delete_status').show();

							$("#shipping_table").css('visibility','hidden');
							$("#shipping_table").html(table);
							$("#shipping_table").css('visibility','visible');
						}
						else if(response.data.shipping_infos.length==0){

							$("#shipping_table").css('visibility','hidden');
							$("#shipping_table").html("no shipping infos");
							$("#shipping_table").css('visibility','visible');
						}
					}
				})
				.error(function (response) {
					console.log("Failed...")
					$('#shipping_id_delete_status').html("Failed!!Please try again");
					setTimeout(function() {
						$("#shipping_id_delete_status").hide();
					}, 3000);
					$('#shipping_id_delete_status').show();

				});
		});


		/**
		 * get shipping template id infos after refresh interval
		 * @since 1.0.0
		 */
		$("#show_all_shipping_template_id").on('click', function(e) {
			e.preventDefault();
			var $shipping_info= 'shipping';
			wpAjaxHelperRequest('get_shipping_infos', $shipping_info)
				.success(function (response) {
					console.log("Success...")
					if (response.data.shipping_infos.length>0) {
						var row=""
						for (let i = 0; i < response.data.shipping_infos.length; i++) {
							 row += '<tr>' +
								 '<td>' + response.data.shipping_infos[i].shipping_title + '</td>' +
								'<td>' + response.data.shipping_infos[i].shipping_template_id + '</td>' +
								'<td><input value="' + response.data.shipping_infos[i].shipping_template_id + '" type="hidden" class="delete_shipping_id" ><button class="delete_shipping" ><svg  width="22px" height="22px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" color="red"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></td>' +
								'</tr>';

							var table = '<table class="table">\n' +
								'            <thead>\n' +
								'            <tr>\n' +
								'                <th>Shipping title</th>\n' +
								'                <th>Shipping template id</th>\n' +
								'                <th>Action</th>\n' +
								'            </tr>\n' +
								'            </thead>\n' +
								'            <tbody>\n' +
								'            ' + row + '' +
								'            </tbody>\n' +
								'        </table>';
							;

						}

						 $("#shipping_table").css('visibility','hidden');
						 $("#shipping_table").html(table);
						 $("#shipping_table").css('visibility','visible');
					}
					else if(response.data.shipping_infos.length==0){

						$("#shipping_table").css('visibility','hidden');
						$("#shipping_table").html("no shipping infos");
						$("#shipping_table").css('visibility','visible');
					}

				})
				.error(function (response) {
					console.log("Failed...")
					$('#refresh_result').html("Failed to refresh");
					setTimeout(function() {
						$("#refresh_result").hide();
					}, 3000);
					$('#refresh_result').show();

				});
		});


		/**
		 * Remove notice and update sending status
		 * @since 1.0.0
		 */
		$("#remove_notice").on('click', function(e) {
			$('.remove_notice').hide();
			var $sending_status='nothing'
			wpAjaxHelperRequest('update_sending_status',$sending_status)
				.success(function (response) {
					console.log("Success...")
				})
				.error(function (response) {
					console.log("Failed...")
				});
		});

		/**
		 * Remove notice and update sending status
		 * @since 1.0.0
		 */
		$("body").on('click',"#remove_all_notice .notice-dismiss", function(e) {
			var $remove_notice='remove_notice'

			wpAjaxHelperRequest('remove_admin_notice',$remove_notice)
				.success(function (response) {
					console.log("Success...")
				})
				.error(function (response) {
					console.log("Failed...")

				});

		});

		/**
		 * Chaneg view based on select option
		 * @since 1.0.0
		 */
		$('#select_all_selected').change(function() {
			//Use $option (with the "$") to see that the variable is a jQuery object
			var $option = $(this).find('option:selected');
			var value = $option.val();
			if(value == 'send_all'){
				$("#send_all_product_button").css('display','block')
				$("#send_selected_product_button").css('display','none')
				$("#search_field").css('display','none')

			}else if(value == 'send_selected'){
				$("#send_selected_product_button").css('display','block')
				$("#send_all_product_button").css('display','none')
				$("#search_field").css('display','block')
			}
		});

		/**
		 * Settings api tab
		 * @since 1.0.0
		 **/
		$('ul.rex-etsy-api-setting__tabs-area li').click(function () {
			var tab_id = $(this).attr('data-tab');

			$('ul.rex-etsy-api-setting__tabs-area li').removeClass('active');
			$('.rex-etsy-api-setting__tab-content .tab-content').removeClass('active');

			$(this).addClass('active');
			$("#" + tab_id).addClass('active');
		});

		//** validation functions starst **//
		/**
		 * Validation for etsy consumer key secret form submit
		 * @param consumer_key
		 * @param consumer_secret
		 * @returns {string}
		 * @since 1.0.0
		 */
		function validation_consumer_key_secret(consumer_key,consumer_secret){
			if(consumer_key.trim().length == 0 || consumer_secret.trim().length == 0){
				if(consumer_key.trim().length == 0) {
					$("#rex-etsy-consumer-key_validatioin").html("Please Fill Consumer Key!!")
					setTimeout(function () {
						$("#rex-etsy-consumer-key_validatioin").hide();
					}, 4000);
					$("#rex-etsy-consumer-key_validatioin").show();
				}

				if(consumer_secret.trim().length == 0){
					$("#rex-etsy-consumer-secret_validatioin").html("Please Fill Consumer secret!!")
					setTimeout(function() {
						$("#rex-etsy-consumer-secret_validatioin").hide();
					}, 4000);
					$("#rex-etsy-consumer-secret_validatioin").show();
				}
				return 'return_false';
			}
		}

		/**
		 * validation for generate shipping template id
		 * @returns {string}
		 * @since 1.0.0
		 */
		function validatte_shipping_template_form(){
			var shipping_title = $('#shipping_title').val(),
				origin_country_id= $('#origin_country_id').val(),
				primary_cost = $('#primary_cost').val(),
				secondary_cost = $('#secondary_cost').val(),
				min_processing_days = $('#min_processing_days').val(),
				max_processing_days = $('#max_processing_days').val()

			if(shipping_title.trim().length == 0 || origin_country_id.trim().length == 0|| primary_cost.trim().length == 0
				|| secondary_cost.trim().length == 0|| min_processing_days.trim().length == 0 || max_processing_days.trim().length == 0){
				if(shipping_title.trim().length == 0) {
					$("#validate_shipping_title").html("Please Fill Consumer Key!!")
					setTimeout(function () {
						$("#validate_shipping_title").hide();
					}, 4000);
					$("#validate_shipping_title").show();
				}
				if(origin_country_id.trim().length == 0){
					$("#validate_shipping_country").html("Please select Consumer secret!!")
					setTimeout(function() {
						$("#validate_shipping_country").hide();
					}, 4000);
					$("#validate_shipping_country").show();
				}
				if(primary_cost.trim().length == 0){
					$("#validate_shipping_primary_cost").html("Please Fill Consumer secret!!")
					setTimeout(function() {
						$("#validate_shipping_primary_cost").hide();
					}, 4000);
					$("#validate_shipping_primary_cost").show();
				}
				if(secondary_cost.trim().length == 0){
					$("#validate_shipping_additional_cost").html("Please Fill Consumer secret!!")
					setTimeout(function() {
						$("#validate_shipping_additional_cost").hide();
					}, 4000);
					$("#validate_shipping_additional_cost").show();
				}

				if(min_processing_days.trim().length == 0){
					$("#validate_min_processign_days").html("Please Fill Consumer secret!!")
					setTimeout(function() {
						$("#validate_min_processign_days").hide();
					}, 4000);
					$("#validate_min_processign_days").show();
				}

				if(max_processing_days.trim().length == 0){
					$("#validate_max_processign_days").html("Please Fill Consumer secret!!")
					setTimeout(function() {
						$("#validate_max_processign_days").hide();
					}, 4000);
					$("#validate_max_processign_days").show();
				}
				return 'return_false';
			}
		}

		/**
		 * validate send products form
		 * since 1.0.0
		 * @returns {string}
		 */
		function validate_send_products_form(){
				var who_made= $('#who_made').val(),
				when_made= $('#when_made').val(),
				shipping_id= $('#shipping_template_id').val(),
				texonomy_id = $('#texonomy_id').val()


			if(who_made.trim().length == 0 || when_made.trim().length == 0|| shipping_id.trim().length == 0
				|| texonomy_id.trim().length == 0){

				if(who_made.trim().length == 0) {
					$("#validate_who_made").html("Select Who Made!!")
					setTimeout(function () {
						$("#validate_who_made").hide();
					}, 4000);
					$("#validate_who_made").show();
				}
				if(when_made.trim().length == 0){
					$("#validate_when_made").html("Select When Made!!")
					setTimeout(function() {
						$("#validate_when_made").hide();
					}, 4000);
					$("#validate_when_made").show();
				}
				if(shipping_id.trim().length == 0){
					$("#validation_shipping_id").html("Select Shipping id!!")
					setTimeout(function() {
						$("#validation_shipping_id").hide();
					}, 4000);
					$("#validation_shipping_id").show();
				}
				if(texonomy_id.trim().length == 0){
					$("#validate_texonomy_id").html("Please Fill Category Id!!")
					setTimeout(function() {
						$("#validate_texonomy_id").hide();
					}, 4000);
					$("#validate_texonomy_id").show();
				}

				return 'return_false';
			}

		}

		/**
		 * redirect url if url contains oauth token and verifire
		 * since 1.0.0
		 */
		function redirect_url() {
			// window.location.reload(false);
			var $mainstring= window.location.href
			var $substringone = 'oauth_token'
			var $substringtwo = 'oauth_verifier'

			if($mainstring.includes($substringone) && $mainstring.includes($substringtwo)){
				window.location='admin.php?page=etsy-api-settings'
			}
		}
		window.onload= redirect_url

	});


})( jQuery );


function myFunction() {
	alert("You pressed a key inside the input field");
}

