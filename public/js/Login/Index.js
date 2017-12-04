$(document).ready(function () {
	$page = $('.full-page');
	image_src = $page.data('image');
	if (image_src !== undefined) {
		image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>'
		$page.append(image_container);
	}
	setTimeout(function () {
		$('.card').removeClass('card-hidden');
	}, 700);
	// Se envia el formulario para loguear al usuario en el sistema
	$('#formAcceder').submit(function (e) {
		e.preventDefault();
		str = $('#formAcceder').serialize();
		response = ajax('./Acceder', str);
		if (response.bandera == true) {
			switch (response.data.cve_perfil) {
				case '001':
					window.location.replace('./Punto');
					break;
				case '002':
					window.location.replace('./Escritorio');
				default:
					window.location.replace('');
					break;
			}
		} else {
			console.log('error');
		}
	});
});