(function ($) {
  "use strict";

  // Menu Sticky no topo
  $(window).on('scroll', function () {
      var scroll = $(window).scrollTop();
      if (scroll < 400) {
          $("#sticky-header").removeClass("sticky");
          $('#back-top').fadeIn(500);
      } else {
          $("#sticky-header").addClass("sticky");
          $('#back-top').fadeIn(500);
      }
  });

  // Inicialização quando o documento está pronto
  $(document).ready(function(){

      // Menu móvel
      var menu = $('ul#navigation');
      if(menu.length){
          menu.slicknav({
              prependTo: ".mobile_menu",
              closedSymbol: '+',
              openedSymbol:'-'
          });
      };

      // Slider Ativo
      var slider = $('.slider_active');
      if(slider.length) {
          slider.owlCarousel({
              loop:true,
              margin:0,
              items:1,
              autoplay:true,
              navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
              nav:true,
              dots:false,
              autoplayHoverPause: true,
              autoplaySpeed: 800,
              responsive:{
                  0:{
                      items:1,
                      nav:false,
                  },
                  767:{
                      items:1,
                      nav:false,
                  },
                  992:{
                      items:1,
                      nav:false
                  },
                  1200:{
                      items:1,
                      nav:false
                  },
                  1600:{
                      items:1,
                      nav:true
                  }
              }
          });
      }

      // Inicialização de Magnific Popup para imagens
      $('.popup-image').magnificPopup({
          type: 'image',
          gallery: {
            enabled: true
          }
      });

      // Inicialização de Magnific Popup para vídeos
      $('.popup-video').magnificPopup({
          type: 'iframe'
      });

      // Ativação do contador
      $('.counter').counterUp({
          delay: 10,
          time: 10000
      });

      // Ativação de niceSelect para selects
      if (document.getElementById('default-select')) {
          $('select').niceSelect();
      }

      // Inicialização do formulário de inscrição do Magnific Popup
      $('.popup-with-form').magnificPopup({
          type: 'inline',
          preloader: false,
          focus: '#name',
          callbacks: {
              beforeOpen: function() {
                  if($(window).width() < 700) {
                      this.st.focus = false;
                  } else {
                      this.st.focus = '#name';
                  }
              }
          }
      });

      // Ativação do plugin de envio do formulário para MailChimp
      function mailChimp() {
          $('#mc_embed_signup').find('form').ajaxChimp();
      }
      mailChimp();

      // Toggle de pesquisa
      $("#search_input_box").hide();
      $("#search").on("click", function () {
          $("#search_input_box").slideToggle();
          $("#search_input").focus();
      });
      $("#close_search").on("click", function () {
          $('#search_input_box').slideUp(500);
      });

  });

})(jQuery);
