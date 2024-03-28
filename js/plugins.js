// Evita erros de console em navegadores que não possuem a ferramenta de console.
(function() {
    // Declaração de variáveis.
    var method;
    var noop = function () {}; // Função vazia.
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ]; // Lista de métodos disponíveis no console.
    var length = methods.length;
    var console = (window.console = window.console || {}); // Define o console ou um objeto vazio.

    // Itera por cada método do console na lista 'methods'.
    while (length--) {
        method = methods[length];

        // Define métodos faltantes como a função vazia 'noop'.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());
