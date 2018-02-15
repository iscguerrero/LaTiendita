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
		response = ajax('./Login/Acceder', str);
		if (response.bandera == true) {
			switch (response.cve_perfil) {
				case '001':
					window.location.replace('./Punto/Inicio');
					break;
				case '002':
					window.location.replace('./Escritorio/Inicio');
				default:
					window.location.replace('');
					break;
			}
		} else {
			swal({
				title: "Atiende!",
				html: response.msj,
				buttonsStyling: true,
				confirmButtonClass: "btn btn-warning btn-fill"
			});
		}
	});
});