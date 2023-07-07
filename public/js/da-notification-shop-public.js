(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		function fetchCustomersProducts() {
			var storedData = sessionStorage.getItem('customersProducts');
			if (storedData) {
				var data = JSON.parse(storedData);
				console.log('Data retrieved from Session Storage:', data);
				showRandomNotification(data.customers, data.products);
				return;
			}

			makeAjaxRequest();
		}

		function makeAjaxRequest() {
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'url_do_seu_servidor', true);
			xhr.setRequestHeader('Content-type', 'application/json');
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						var response = JSON.parse(xhr.responseText);
						if (response.status === true) {
							sessionStorage.setItem('customersProducts', JSON.stringify(response.data));
							console.log('Data stored in Session Storage:', response.data);
							showRandomNotification(response.data.customers, response.data.products);
						} else {
							console.log('Error obtaining data from the server.');
						}
					} else {
						console.log('AJAX request error.');
					}
				}
			};
			xhr.send(JSON.stringify({ action: 'get_customers_products' }));
		}

		function showRandomNotification(customers, products) {
			var randomInterval = Math.floor(Math.random() * (30000 - 10000 + 1)) + 10000;
			var randomCustomerIndex = Math.floor(Math.random() * customers.length);
			var randomProductIndex = Math.floor(Math.random() * products.length);
			var randomCustomer = customers[randomCustomerIndex].name;
			var randomProduct = products[randomProductIndex].name;
			var randomProductImage = products[randomProductIndex].image;
			var htmlNotification = `<div class="toastify-content"><b>${randomCustomer}</b> acabou de comprar <br><b>${randomProduct}</b></div>`;

			Toastify({
				text: htmlNotification,
				duration: 10000,
				gravity: "bottom",
				position: "left",
				avatar: randomProductImage,
				style: {
					background: "linear-gradient(to right, #5B1024, #F80555)",
				},
				escapeMarkup: false
			}).showToast();

			scheduleNotification(customers, products, randomInterval);
		}

		function scheduleNotification(customers, products, interval) {
			setTimeout(function () {
				showRandomNotification(customers, products);
			}, interval);
		}

		fetchCustomersProducts();
	});
})();
