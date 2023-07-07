(function ($) {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		var newCustomerBtn = document.getElementById('__dans_submit_customer');
		var deleteCustomerBtn = document.querySelectorAll('.dans-button-remove-customer');

		var newProductBtn = document.getElementById('__dans_submit_product');
		var deleteProductBtn = document.querySelectorAll('.dans-button-remove-product');

		newCustomerBtn?.addEventListener('click', function (e) {
			e.preventDefault();
			new_customer(document.getElementById('__customer').value);
		});

		deleteCustomerBtn?.forEach(function (button) {
			button.addEventListener('click', function (e) {
				e.preventDefault();
				delete_customer(button.dataset.id);
			});
		});

		newProductBtn?.addEventListener('click', function (e) {
			e.preventDefault();
			new_product(document.getElementById('__product').value, document.getElementById('__image').value);
		});

		deleteProductBtn?.forEach(function (button) {
			button.addEventListener('click', function (e) {
				e.preventDefault();
				delete_product(button.dataset.id);
			});
		});

	});


	function new_customer(customer) {
		var endpointUrl = da_notification_shop.ajaxurl;
		var requestData = {
			customer: customer,
			action: 'add_new_customer'
		};

		sendAjaxRequest(endpointUrl, 'POST', requestData, function (response) {
			if (response.status) {
				var currentUrl = window.location.href;
				var urlObject = new URL(currentUrl);
				urlObject.searchParams.set('status', response.status);
				window.location.href = urlObject.href;
			}
		}, function (error) {
			var currentUrl = window.location.href;
			var urlObject = new URL(currentUrl);
			urlObject.searchParams.set('status', response.status);
			window.location.href = urlObject.href;
			console.error('Erro na solicitação AJAX:', error);
		});
	}

	function delete_customer(customer) {
		var endpointUrl = da_notification_shop.ajaxurl;
		var requestData = {
			customer: customer,
			action: 'delete_customer'
		};

		sendAjaxRequest(endpointUrl, 'POST', requestData, function (response) {
			if (response.status) {
				var currentUrl = window.location.href;
				var urlObject = new URL(currentUrl);
				urlObject.searchParams.set('status', response.status);
				window.location.href = urlObject.href;
			}
		}, function (error) {
			var currentUrl = window.location.href;
			var urlObject = new URL(currentUrl);
			urlObject.searchParams.set('status', response.status);
			window.location.href = urlObject.href;
			console.error('Erro na solicitação AJAX:', error);
		});
	}

	function new_product(product, image) {
		var endpointUrl = da_notification_shop.ajaxurl;
		var requestData = {
			product: product,
			image: image,
			action: 'add_new_product'
		};

		sendAjaxRequest(endpointUrl, 'POST', requestData, function (response) {
			if (response.status) {
				var currentUrl = window.location.href;
				var urlObject = new URL(currentUrl);
				urlObject.searchParams.set('status', response.status);
				window.location.href = urlObject.href;
			}
		}, function (error) {
			var currentUrl = window.location.href;
			var urlObject = new URL(currentUrl);
			urlObject.searchParams.set('status', response.status);
			window.location.href = urlObject.href;
			console.error('Erro na solicitação AJAX:', error);
		});
	}

	function delete_product(product) {
		var endpointUrl = da_notification_shop.ajaxurl;
		var requestData = {
			product: product,
			action: 'delete_product'
		};

		sendAjaxRequest(endpointUrl, 'POST', requestData, function (response) {
			if (response.status) {
				var currentUrl = window.location.href;
				var urlObject = new URL(currentUrl);
				urlObject.searchParams.set('status', response.status);
				window.location.href = urlObject.href;
			}
		}, function (error) {
			var currentUrl = window.location.href;
			var urlObject = new URL(currentUrl);
			urlObject.searchParams.set('status', response.status);
			window.location.href = urlObject.href;
			console.error('Erro na solicitação AJAX:', error);
		});
	}

	function sendAjaxRequest(url, method, data, successCallback, errorCallback) {
		var xhr = new XMLHttpRequest();
		xhr.open(method, url, true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

		xhr.onreadystatechange = function () {
			if (xhr.readyState === XMLHttpRequest.DONE) {
				if (xhr.status === 200) {
					var response = JSON.parse(xhr.responseText);
					if (response.status) {
						if (typeof successCallback === 'function') {
							successCallback(response);
						}
					} else {
						if (typeof errorCallback === 'function') {
							errorCallback(response);
						}
					}
				} else {
					if (typeof errorCallback === 'function') {
						errorCallback(xhr.status);
					}
				}
			}
		};

		var params = '';
		for (var key in data) {
			if (data.hasOwnProperty(key)) {
				params += key + '=' + encodeURIComponent(data[key]) + '&';
			}
		}
		params = params.slice(0, -1); // Remove the trailing '&'

		xhr.send(params);
	}

})(jQuery);
