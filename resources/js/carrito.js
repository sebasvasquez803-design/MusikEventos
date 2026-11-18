function formatearPrecio(valor) {
	const numero = Number(valor) || 0;
	return new Intl.NumberFormat('es-CO', {
		style: 'currency',
		currency: 'COP',
		maximumFractionDigits: 0,
	}).format(numero);
}

document.addEventListener('DOMContentLoaded', () => {
	const params = new URLSearchParams(window.location.search);
	const fecha = params.get('fecha') || '';
	const hora = params.get('hora') || '';
	const direccion = params.get('direccion') || '';

	const serverGroup = window.__CART_GROUP || null;
	const grupo = serverGroup?.nombre_grupo || params.get('grupo') || 'Grupo Musical';
	let precioHora = 0;
	if (serverGroup && serverGroup.precio_hora) {
		precioHora = Number(serverGroup.precio_hora) || 0;
	} else {
		precioHora = Number(String(params.get('precio_hora') || '0').replace(/[^\d]/g, '')) || 0;
	}

	const fechaInput = document.getElementById('fecha');
	const horaInput = document.getElementById('hora');
	const direccionInput = document.getElementById('direccion');
	const horasInput = document.getElementById('horas');
	const precioHoraInput = document.getElementById('precio_hora');
	const valorInput = document.getElementById('valor');
	const cartGroupName = document.getElementById('cart-group-name');
	const cartGroupCategory = document.getElementById('cart-group-category');
	const cartPriceValue = document.getElementById('cart-price-value');

	if (fechaInput) fechaInput.value = fecha;
	if (horaInput) horaInput.value = hora;
	if (direccionInput) direccionInput.value = direccion;
	if (cartGroupName) cartGroupName.textContent = grupo;
	if (cartGroupCategory) cartGroupCategory.textContent = 'Grupo musical';
	if (precioHoraInput) {
		precioHoraInput.value = formatearPrecio(precioHora || (precioHoraInput.value ? Number(String(precioHoraInput.value).replace(/[^\d]/g, '')) : 0));
	}
	if (cartPriceValue) {
		cartPriceValue.textContent = formatearPrecio(precioHora || (cartPriceValue.textContent ? Number(String(cartPriceValue.textContent).replace(/[^\d]/g, '')) : 0));
	}

	if (horasInput) {
		horasInput.value = horasInput.value || '1';
	}

	if (fechaInput) {
		const hoy = new Date();
		const fechaMinima = [
			hoy.getFullYear(),
			String(hoy.getMonth() + 1).padStart(2, '0'),
			String(hoy.getDate()).padStart(2, '0'),
		].join('-');
		fechaInput.min = fechaMinima;
	}

	const actualizarTotal = () => {
		const horas = Number(horasInput?.value || 0) || 0;
		const total = horas * precioHora;
		if (valorInput) valorInput.value = formatearPrecio(total);
		if (cartPriceValue) cartPriceValue.textContent = formatearPrecio(precioHora);
	};

	if (horasInput) {
		horasInput.addEventListener('input', actualizarTotal);
	}

	document.querySelectorAll('[data-hours]').forEach((boton) => {
		boton.addEventListener('click', () => {
			if (!horasInput) return;
			horasInput.value = boton.dataset.hours;
			document.querySelectorAll('[data-hours]').forEach((item) => item.classList.remove('is-active'));
			boton.classList.add('is-active');
			actualizarTotal();
		});
	});

	actualizarTotal();

	const reservationForm = document.getElementById('reservation-form');
	const checkoutOverlay = document.getElementById('checkout-overlay');
	const checkoutClose = document.getElementById('checkout-close');
	const paymentForm = document.getElementById('payment-form');
	const payButton = document.getElementById('pay-button');
	const checkoutSuccess = document.getElementById('checkout-success');
	const checkoutContent = checkoutOverlay?.querySelector('.checkout-content');
	let selectedMethod = 'card';

	const abrirCheckout = () => {
		if (!checkoutOverlay) return;
		const horas = Math.max(1, Number(horasInput?.value || 1));
		const total = horas * precioHora;
		const fechaTexto = fechaInput?.value
			? new Date(`${fechaInput.value}T12:00:00`).toLocaleDateString('es-CO', { day: 'numeric', month: 'short', year: 'numeric' })
			: 'Por definir';

		document.getElementById('summary-date').textContent = fechaTexto;
		document.getElementById('summary-time').textContent = horaInput?.value || 'Por definir';
		document.getElementById('summary-address').textContent = direccionInput?.value || 'Por definir';
		document.getElementById('summary-hours').textContent = `${horas} ${horas === 1 ? 'hora' : 'horas'}`;
		document.getElementById('summary-subtotal').textContent = formatearPrecio(total);
		document.getElementById('summary-total').textContent = formatearPrecio(total);
		document.getElementById('pay-button-total').textContent = formatearPrecio(total);
		document.getElementById('checkout-group-name').textContent = grupo;

		checkoutOverlay.classList.add('is-open');
		checkoutOverlay.setAttribute('aria-hidden', 'false');
		document.body.style.overflow = 'hidden';
		checkoutClose?.focus();
	};

	const cerrarCheckout = () => {
		checkoutOverlay?.classList.remove('is-open');
		checkoutOverlay?.setAttribute('aria-hidden', 'true');
		document.body.style.overflow = '';
	};

	reservationForm?.addEventListener('submit', (event) => {
		event.preventDefault();
		if (!reservationForm.checkValidity()) {
			reservationForm.reportValidity();
			return;
		}
		abrirCheckout();
	});

	checkoutClose?.addEventListener('click', cerrarCheckout);
	checkoutOverlay?.addEventListener('click', (event) => {
		if (event.target === checkoutOverlay) cerrarCheckout();
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && checkoutOverlay?.classList.contains('is-open')) cerrarCheckout();
	});

	document.querySelectorAll('.payment-method').forEach((method) => {
		method.addEventListener('click', () => {
			selectedMethod = method.dataset.method;
			document.querySelectorAll('.payment-method').forEach((item) => {
				item.classList.remove('is-selected');
				item.setAttribute('aria-checked', 'false');
			});
			method.classList.add('is-selected');
			method.setAttribute('aria-checked', 'true');
			document.querySelectorAll('[data-fields]').forEach((fields) => {
				fields.classList.toggle('is-hidden', fields.dataset.fields !== selectedMethod);
			});
		});
	});

	const cardNumber = document.getElementById('card-number');
	cardNumber?.addEventListener('input', () => {
		cardNumber.value = cardNumber.value.replace(/\D/g, '').slice(0, 16).replace(/(\d{4})(?=\d)/g, '$1 ');
	});

	const cardExpiry = document.getElementById('card-expiry');
	cardExpiry?.addEventListener('input', () => {
		const digits = cardExpiry.value.replace(/\D/g, '').slice(0, 4);
		cardExpiry.value = digits.length > 2 ? `${digits.slice(0, 2)}/${digits.slice(2)}` : digits;
	});

	const cardCvv = document.getElementById('card-cvv');
	cardCvv?.addEventListener('input', () => {
		cardCvv.value = cardCvv.value.replace(/\D/g, '').slice(0, 4);
	});

	const walletPhone = document.getElementById('wallet-phone');
	walletPhone?.addEventListener('input', () => {
		walletPhone.value = walletPhone.value.replace(/\D/g, '').slice(0, 10);
	});

	paymentForm?.addEventListener('submit', async (event) => {
		event.preventDefault();

		const terms = document.getElementById('payment-terms');
		const paymentError = document.getElementById('payment-error');
		if (paymentError) paymentError.textContent = '';
		let valid = true;
		paymentForm.querySelectorAll('.is-invalid').forEach((field) => field.classList.remove('is-invalid'));

		if (selectedMethod === 'card') {
			const name = document.getElementById('card-name');
			const number = document.getElementById('card-number');
			const expiry = document.getElementById('card-expiry');
			const cvv = document.getElementById('card-cvv');
			[
				[name, name?.value.trim().length >= 3],
				[number, number?.value.replace(/\s/g, '').length === 16],
				[expiry, /^\d{2}\/\d{2}$/.test(expiry?.value || '')],
				[cvv, /^\d{3,4}$/.test(cvv?.value || '')],
			].forEach(([field, isValid]) => {
				if (!isValid) {
					field?.classList.add('is-invalid');
					valid = false;
				}
			});
		}

		if (selectedMethod === 'pse') {
			const bank = document.getElementById('pse-bank');
			if (!bank?.value) {
				bank?.classList.add('is-invalid');
				valid = false;
			}
		}

		if (selectedMethod === 'wallet') {
			const wallet = document.getElementById('wallet-type');
			const phone = document.getElementById('wallet-phone');
			if (!wallet?.value) {
				wallet?.classList.add('is-invalid');
				valid = false;
			}
			if (!/^3\d{9}$/.test(phone?.value || '')) {
				phone?.classList.add('is-invalid');
				valid = false;
			}
		}

		if (!terms?.checked) valid = false;

		if (!valid) {
			terms?.focus();
			if (paymentError) paymentError.textContent = 'Revisa los datos del pago y acepta los términos para continuar.';
			return;
		}

		payButton.disabled = true;
		payButton.querySelector('span').textContent = 'Procesando pago...';

		const nitInput = reservationForm?.querySelector('[name="nit"]');
		const hora = horaInput?.value ? `${horaInput.value}:00` : '';
		const horas = Math.max(1, Number(horasInput?.value || 1));
		const payload = {
			fecha: fechaInput?.value,
			hora,
			direccion: direccionInput?.value,
			nit: Number(nitInput?.value),
			horas,
			metodo_pago: selectedMethod,
		};

		try {
			const response = await fetch('/reservas', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					Accept: 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
				},
				body: JSON.stringify(payload),
			});
			const result = await response.json();

			if (!response.ok) throw new Error(result.error || result.message || 'No fue posible procesar la reserva.');

			if (checkoutContent) checkoutContent.style.display = 'none';
			const successMessage = document.getElementById('checkout-success-message');
			const confirmationEmail = document.getElementById('confirmation-email');
			const nombresMetodos = {
				card: 'Tarjeta',
				pse: 'PSE',
				wallet: selectedMethod === 'wallet'
					? document.getElementById('wallet-type')?.value || 'Billetera'
					: 'Billetera',
			};
			if (successMessage) {
				successMessage.textContent = `Pago aprobado mediante ${nombresMetodos[selectedMethod]}. Tu presentación quedó reservada.`;
			}
			if (confirmationEmail) {
				confirmationEmail.textContent = result.email_sent
					? `Confirmación enviada al correo ${result.email_sent}`
					: 'La confirmación aparecerá en tu correo registrado al habilitarse el envío de correos.';
			}
			checkoutSuccess?.classList.add('is-visible');
		} catch (error) {
			const paymentError = document.getElementById('payment-error');
			if (paymentError) paymentError.textContent = error.message;
		} finally {
			payButton.disabled = false;
			payButton.querySelector('span').textContent = 'Pagar ahora';
		}
	});
});
