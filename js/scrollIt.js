/**
 * ScrollIt
 * ScrollIt.js(scroll•it•dot•js) torna fácil criar páginas longas com rolagem vertical.
 *
 * Versão mais recente: https://github.com/cmpolis/scrollIt.js
 *
 * Licença: <https://github.com/cmpolis/scrollIt.js/blob/master/LICENSE.txt>
 */
(function($) {
    'use strict';

    var pluginName = 'ScrollIt',
        pluginVersion = '1.0.3';

    /*
     * OPÇÕES
     */
    var defaults = {
        upKey: 38,              // Tecla para rolar para cima
        downKey: 40,            // Tecla para rolar para baixo
        easing: 'linear',       // Tipo de easing para a animação de rolagem
        scrollTime: 600,        // Tempo de duração da animação de rolagem
        activeClass: 'active',  // Classe para indicar o item ativo
        onPageChange: null,     // Função de callback chamada quando a página muda
        topOffset : 0           // Deslocamento superior (em pixels) para ajustar a posição da rolagem
    };

    $.scrollIt = function(options) {

        /*
         * DECLARAÇÕES
         */
        var settings = $.extend(defaults, options), // Mescla as opções padrão com as opções fornecidas pelo usuário
            active = 0, // Índice do item ativo
            lastIndex = $('[data-scroll-index]:last').attr('data-scroll-index'); // Índice do último item

        /*
         * MÉTODOS
         */

        /**
         * navigate
         *
         * Configura a animação de navegação
         */
        var navigate = function(ndx) {
            if(ndx < 0 || ndx > lastIndex) return;

            // Calcula a posição do destino
            var targetTop = $('[data-scroll-index=' + ndx + ']').offset().top + settings.topOffset + 1;

            // Anima a rolagem até o destino
            $('html,body').animate({
                scrollTop: targetTop,
                easing: settings.easing
            }, settings.scrollTime);
        };

        /**
         * doScroll
         *
         * Executa a navegação quando os critérios são atendidos
         */
        var doScroll = function (e) {
            // Obtém o atributo 'data-scroll-nav' ou 'data-scroll-goto' do elemento clicado
            var target = $(e.target).closest("[data-scroll-nav]").attr('data-scroll-nav') ||
            $(e.target).closest("[data-scroll-goto]").attr('data-scroll-goto');
            // Navega até o item correspondente
            navigate(parseInt(target));
        };

        /**
         * keyNavigation
         *
         * Configura o comportamento de navegação por teclado
         */
        var keyNavigation = function (e) {
            var key = e.which;
            // Verifica se a animação de rolagem está em andamento e se a tecla pressionada é para cima ou para baixo
            if($('html,body').is(':animated') && (key == settings.upKey || key == settings.downKey)) {
                return false;
            }
            // Navega para cima se a tecla pressionada for a seta para cima
            if(key == settings.upKey && active > 0) {
                navigate(parseInt(active) - 1);
                return false;
            } else if(key == settings.downKey && active < lastIndex) {
                // Navega para baixo se a tecla pressionada for a seta para baixo
                navigate(parseInt(active) + 1);
                return false;
            }
            return true;
        };

        /**
         * updateActive
         *
         * Define o item atualmente ativo
         */
        var updateActive = function(ndx) {
            // Chama a função de callback onPageChange se estiver definida e se o item ativo mudou
            if(settings.onPageChange && ndx && (active != ndx)) settings.onPageChange(ndx);

            // Atualiza o índice do item ativo
            active = ndx;
            // Remove a classe ativa de todos os elementos de navegação e adiciona ao item ativo
            $('[data-scroll-nav]').removeClass(settings.activeClass);
            $('[data-scroll-nav=' + ndx + ']').addClass(settings.activeClass);
        };

        /**
         * watchActive
         *
         * Observa o item atualmente ativo e atualiza conforme necessário
         */
        var watchActive = function() {
            var winTop = $(window).scrollTop();

            // Filtra os itens com índices de rolagem que estão visíveis na janela
            var visible = $('[data-scroll-index]').filter(function(ndx, div) {
                return winTop >= $(div).offset().top + settings.topOffset &&
                winTop < $(div).offset().top + (settings.topOffset) + $(div).outerHeight()
            });

            // Obtém o índice do primeiro item visível
            var newActive = visible.first().attr('data-scroll-index');
            // Atualiza o item ativo
            updateActive(newActive);
        };

        /*
         * Executa os métodos
         */
        // Observa o evento de rolagem da janela e executa watchActive() quando ocorre
        $(window).on('scroll',watchActive).scroll();
        // Observa o evento de pressionar tecla e executa keyNavigation() quando ocorre
        $(window).on('keydown', keyNavigation);
        // Observa o evento de clique nos elementos de navegação e executa doScroll() quando ocorre
        $('body').on('click','[data-scroll-nav], [data-scroll-goto]', function(e){
            e.preventDefault();
            doScroll(e);
        });

    };
}(jQuery));
