$(function() {

	// Obtém o formulário.
	var form = $('#contact-form');

	// Obtém a div de mensagens.
	var formMessages = $('.ajax-response');

	// Configura um ouvinte de eventos para o formulário de contato.
	$(form).submit(function(e) {
		// Impede o navegador de enviar o formulário.
		e.preventDefault();

		// Serializa os dados do formulário.
		var formData = $(form).serialize();

		// Envia o formulário usando AJAX.
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'), // Obtém a URL de destino do atributo action do formulário
			data: formData // Envia os dados do formulário
		})
		.done(function(response) {
			// Certifica-se de que a div formMessages tenha a classe 'success'.
			$(formMessages).removeClass('error');
			$(formMessages).addClass('success');

			// Define o texto da mensagem.
			$(formMessages).text(response);

			// Limpa o formulário.
			$('#contact-form input,#contact-form textarea').val('');
		})
		.fail(function(data) {
			// Certifica-se de que a div formMessages tenha a classe 'error'.
			$(formMessages).removeClass('success');
			$(formMessages).addClass('error');

			// Define o texto da mensagem de erro.
			if (data.responseText !== '') {
				$(formMessages).text(data.responseText);
			} else {
				$(formMessages).text('Oops! Um erro ocorreu e sua mensagem não pôde ser enviada.');
			}
		});
	});

});
