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

	const actualizarTotal = () => {
		const horas = Number(horasInput?.value || 0) || 0;
		const total = horas * precioHora;
		if (valorInput) valorInput.value = formatearPrecio(total);
		if (cartPriceValue) cartPriceValue.textContent = formatearPrecio(precioHora);
	};

	if (horasInput) {
		horasInput.addEventListener('input', actualizarTotal);
	}

	actualizarTotal();
});
