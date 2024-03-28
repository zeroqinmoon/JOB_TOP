// Quando o documento estiver pronto
$(document).ready(function() {
    var form = $('#myForm'); // Formulário de contato
    var submit = $('.submit-btn'); // Botão de envio
    var alert = $('.alert-msg'); // Div de alerta para mostrar mensagens de alerta

    // Evento de envio do formulário
    form.on('submit', function(e) {
        e.preventDefault(); // Impede o envio padrão do formulário

        // Envia os dados do formulário via AJAX
        $.ajax({
            url: 'mail.php', // URL de ação do formulário
            type: 'POST', // Método de envio do formulário (get/post)
            dataType: 'html', // Tipo de requisição html/json/xml
            data: form.serialize(), // Serializa os dados do formulário
            beforeSend: function() {
                alert.fadeOut();
                submit.html('Sending....'); // Altera o texto do botão de envio
            },
            success: function(data) {
                alert.html(data).fadeIn(); // Exibe os dados de resposta
                form.trigger('reset'); // Reseta o formulário
                submit.attr("style", "display: none !important"); // Reseta o texto do botão de envio
            },
            error: function(e) {
                console.log(e) // Exibe erro no console em caso de falha
            }
        });
    });
});
