/* 2.0.0 */
(function (window, document, $, msSetInCartConfig) {

	var msSetInCart = msSetInCart || {};

	msSetInCart.options = {
		active_class: 'active'
	};


	msSetInCart.setup = function () {
		msSetInCart.$doc = $(document);
		msSetInCart.$win = $(window);

		msSetInCart.Product.form = '.ms2_form';
		msSetInCart.Product.cost = '.mssetincart-cost';
		msSetInCart.Product.mass = '.mssetincart-mass';
		msSetInCart.Product.prefix = '.mssetincart-';

		msSetInCart.Set.product = '.mssetincart-product';
		msSetInCart.Set.activeInput = 'input[name="mssetincart_active[]"]';
	};


	msSetInCart.initialize = function () {
		msSetInCart.setup();
		msSetInCart.miniShop2.initialize();

		msSetInCart.$doc.on('change', msSetInCart.Product.form, function (e) {
			var $form = $(this);
			var action = $form.find(miniShop2.action).val();

			switch (action) {
				case undefined:
				case 'undefined':
				case 'cart/add':
					msSetInCart.Set.handle();
					break;

				case 'order/submit':
					break;
			}

			return true;
		});

		/* handle set on document ready */
		msSetInCart.$doc.ready(function () {
			msSetInCart.Set.handle();
		});

		msSetInCart.$doc.on('click', msSetInCart.Product.form, function (e) {
			var form = $(this);
			var activeInput = form.find(msSetInCart.Set.activeInput);

			if (activeInput.length < 1) {
				return true;
			}

			if (activeInput.get(0).type == 'hidden') {
				return true;
			}

			if (!msSetInCart.Tools.inArray(e.target.tagName, ['SELECT', 'INPUT'])) {
				if (activeInput.is(':checked')) {
					activeInput.prop('checked', false).change();
				}
				else {
					activeInput.prop('checked', true).change();
				}
			}
			return true;
		});

	};

	msSetInCart.Set = {
		getData: function (json) {
			var data = [];
			$(msSetInCart.Product.form).each(function () {
				var form = $(this);
				data.push(form.serialize());

				var activeInput = form.find(msSetInCart.Set.activeInput);
				if (activeInput.is(':checked')) {
					activeInput.closest(msSetInCart.Set.product).addClass(msSetInCart.options.active_class);
				}
				else {
					activeInput.closest(msSetInCart.Set.product).removeClass(msSetInCart.options.active_class);
				}
			});
			return json ? JSON.stringify(data) : data;
		},

		handle: function () {
			msSetInCart.Product.action('set/get', msSetInCart.Set.getData(true));
		},

	};


	msSetInCart.Product = {

		action: function (action, data) {

			var formData = new FormData();
			formData.append('action', action);
			formData.append('ctx', msSetInCartConfig.ctx);
			formData.append('data', data);

			$.ajax({
				type: 'POST',
				url: msSetInCartConfig.actionUrl,
				dataType: 'json',
				data: formData,
				async: true,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					return true;
				},
				success: function (response) {

					msSetInCart.$doc.trigger('mssetincart_action', [action, data, response]);

					if (response.success && response.data) {

						var data = response.data;
						var errors = [];

						if (!msSetInCart.Tools.empty(data.errors)) {
							errors.push(data.errors);
						}


						if (!msSetInCart.Tools.empty(data.sets)) {
							['cost', 'mass'].filter(function (key) {
								if (msSetInCart.Product[key]) {
									var rows = data.sets[key];

									for (var rid in rows) {
										var value = rows[rid];
										msSetInCart.Tools.setValue(null, value, key, rid);
									}
								}
							});
						}


						if (!msSetInCart.Tools.empty(errors)) {
							console.log(errors.join('<br>'));
						}
					}
					else if (!response.success) {

					}
				}
			}).done(function (response) {

			}).fail(function (jqXHR, textStatus, errorThrown) {

				console.log('fail');

			});
		}

	};


	msSetInCart.miniShop2 = {

		initialize: function () {
			if (typeof(miniShop2) == 'undefined') {
				console.log('[msSetInCart:Error] Initialization Error. miniShop2 required');
				return false;
			}

			miniShop2.Callbacks.add('Cart.add.before', 'mssetincart', function () {
				var formData = miniShop2.sendData.formData;

				formData.push({
					name: 'mssetincart_data',
					value: msSetInCart.Set.getData(true)
				});
				return true;
			});

			miniShop2.Callbacks.add('Cart.remove.response.success', 'mssetincart', function (response) {
				var key = miniShop2.Utils.getValueFromSerializedArray('key');
				$("[mssetincart-master='" + key + "']").remove();
				return true;
			});

		},

	};


	msSetInCart.Tools = {

		arrayIntersect: function (array1, array2) {
			var result = array1.filter(function (n) {
				return array2.indexOf(n) !== -1;
			});

			return result;
		},

		inArray: function (needle, haystack) {
			for (key in haystack) {
				if (haystack[key] == needle) return true;
			}

			return false;
		},

		empty: function (value) {
			return (typeof(value) == 'undefined' || value == 0 || value === null || value === false || (typeof(value) == 'string' && value.replace(/\s+/g, '') == '') || (typeof(value) == 'object' && value.length == 0));
		},

		formatOptionValue: function (key, value) {

			switch (key) {
				case 'cost':
				case 'old_cost':
				case 'price':
				case 'old_price':
					if (miniShop2 && miniShop2.Utils.formatPrice) {
						value = miniShop2.Utils.formatPrice(value);
					}
					break;
				case 'mass':
				case 'weight':
					if (miniShop2 && miniShop2.Utils.formatWeight) {
						value = miniShop2.Utils.formatWeight(value);
					}
					break;
				default:
					break;
			}

			return value;
		},

		setValue: function (self, value, key, rid) {
			var $this = null;
			if (self) {
				$this = $(self);
			}
			else if (key && rid) {
				$this = $(msSetInCart.Product[key] + msSetInCart.Product.prefix + rid);
			}

			if (!$this.length && !rid) {
				$this = $(msSetInCart.Product[key]);
			}

			if (!$this.length) {
				return;
			}

			var tagName = $this[0].tagName;
			var tagType = $this[0].type;

			switch (true) {
				case tagName == 'INPUT' && tagType == 'checkbox':
					if (!(value instanceof Array)) {
						value = [value];
					}

					value.filter(function (item, r) {
						if ($this.val() == item) {
							$this.prop('checked', true);
						}
						else {
							$this.prop('checked', false);
						}
					}, this);
					break;
				case tagName == 'INPUT' && tagType != 'radio':
					$this.val(value);
					break;
				case tagName == 'INPUT' && tagType == 'radio':
					if (!(value instanceof Array)) {
						value = [value];
					}
					value.filter(function (item, r) {
						if ($this.val() == item) {
							$this.prop('checked', true);
						}
						else {
							$this.prop('checked', false);
						}
					}, this);
					break;
				case tagName == 'SELECT':
					if (!(value instanceof Array)) {
						value = [value];
					}
					value.filter(function (item, r) {
						if ($this.find('option[value="' + item + '"]').length) {
							$this.val([item]);
						}
					}, this);
					break;

				default:

					value = msSetInCart.Tools.formatOptionValue(key, value);
					$this.html(value);

					break;
			}

			return;
		},

	};


	msSetInCart.initialize();
	window.msSetInCart = msSetInCart;

})(window, document, jQuery, msSetInCartConfig);


/* event example */
$(document).on('mssetincart_action', function (e, action, data, response) {

	//console.log(action, data, response);
});
