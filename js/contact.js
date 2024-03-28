$(document).ready(function(){
    
    // Início do escopo da função anônima
    (function($) {
        "use strict";

        // Adiciona um método de validação personalizado para verificar a resposta
        jQuery.validator.addMethod('answercheck', function (value, element) {
            return this.optional(element) || /^\bcat\b$/.test(value); // Verifica se a resposta é "cat"
        }, "Type the correct answer -_-"); // Mensagem de erro personalizada

        // Valida o formulário de contato
        $(function() {
            $('#contactForm').validate({
                rules: {
                    name: {
                        required: true, // O campo é obrigatório
                        minlength: 2 // Deve ter pelo menos 2 caracteres
                    },
                    subject: {
                        required: true, // O campo é obrigatório
                        minlength: 4 // Deve ter pelo menos 4 caracteres
                    },
                    number: {
                        required: true, // O campo é obrigatório
                        minlength: 5 // Deve ter pelo menos 5 caracteres
                    },
                    email: {
                        required: true, // O campo é obrigatório
                        email: true // Deve ser um email válido
                    },
                    message: {
                        required: true, // O campo é obrigatório
                        minlength: 20 // Deve ter pelo menos 20 caracteres
                    }
                },
                messages: {
                    // Mensagens de erro personalizadas para cada campo
                    name: {
                        required: "Come on, you have a name, don't you?",
                        minlength: "Your name must consist of at least 2 characters"
                    },
                    subject: {
                        required: "Come on, you have a subject, don't you?",
                        minlength: "Your subject must consist of at least 4 characters"
                    },
                    number: {
                        required: "Come on, you have a number, don't you?",
                        minlength: "Your number must consist of at least 5 characters"
                    },
                    email: {
                        required: "No email, no message" // Mensagem de erro para email não preenchido
                    },
                    message: {
                        required: "Um... yeah, you have to write something to send this form.",
                        minlength: "That's all? Really?" // Mensagem de erro para mensagem muito curta
                    }
                },
                // Função a ser executada quando o formulário é submetido com sucesso
                submitHandler: function(form) {
                    $(form).ajaxSubmit({
                        type:"POST",
                        data: $(form).serialize(),
                        url:"contact_process.php",
                        success: function() {
                            // Desabilita todos os campos do formulário
                            $('#contactForm :input').attr('disabled', 'disabled');
                            // Exibe a mensagem de sucesso e oculta o formulário
                            $('#contactForm').fadeTo("slow", 1, function() {
                                $(this).find(':input').attr('disabled', 'disabled');
                                $(this).find('label').css('cursor','default');
                                $('#success').fadeIn();
                                $('.modal').modal('hide');
                                $('#success').modal('show');
                            });
                        },
                        error: function() {
                            // Exibe a mensagem de erro e mantém o formulário visível
                            $('#contactForm').fadeTo("slow", 1, function() {
                                $('#error').fadeIn();
                                $('.modal').modal('hide');
                                $('#error').modal('show');
                            });
                        }
                    });
                }
            });
        });
        
    })(jQuery); // Fim do escopo da função anônima e passagem do jQuery como parâmetro
}); // Fim do evento ready do jQuery
