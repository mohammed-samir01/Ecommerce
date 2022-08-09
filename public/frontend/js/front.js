$(function () {


    /* ===============================================================
         LIGHTBOX
      =============================================================== */
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    });


    /* ===============================================================
         PRODUCT SLIDER
      =============================================================== */
    $('.product-slider').owlCarousel({
        items: 1,
        thumbs: true,
        thumbImage: false,
        thumbsPrerendered: true,
        thumbContainerClass: 'owl-thumbs',
        thumbItemClass: 'owl-thumb-item'
    });


    /* ===============================================================
         PRODUCT QUNATITY
      =============================================================== */
      // $('.dec-btn').click(function () {
      //     var siblings = $(this).siblings('input');
      //     if (parseInt(siblings.val(), 10) >= 1) {
      //         siblings.val(parseInt(siblings.val(), 10) - 1);
      //     }
      // });

      // $('.inc-btn').click(function () {
      //     var siblings = $(this).siblings('input');
      //     siblings.val(parseInt(siblings.val(), 10) + 1);
      // });


      /* ===============================================================
           BOOTSTRAP SELECT
        =============================================================== */
      $('.selectpicker').on('change', function () {
          $(this).closest('.dropdown').find('.filter-option-inner-inner').addClass('selected');
      });


      /* ===============================================================
           TOGGLE ALTERNATIVE BILLING ADDRESS
        =============================================================== */
      $('#alternateAddressCheckbox').on('change', function () {
         var checkboxId = '#' + $(this).attr('id').replace('Checkbox', '');
         $(checkboxId).toggleClass('d-none');
      });


      /* ===============================================================
           DISABLE UNWORKED ANCHORS
        =============================================================== */
      $('a[href="#"]').on('click', function (e) {
         e.preventDefault();
      });

});


/* ===============================================================
     COUNTRY SELECT BOX FILLING
  =============================================================== */
// $.getJSON('js/countries.json', function (data) {
//     $.each(data, function (key, value) {
//         var selectOption = "<option value='" + value.name + "' data-dial-code='" + value.dial_code + "'>" + value.name + "</option>";
//         $("select.country").append(selectOption);
//     });
// });

// ------------------------------------------------------- //
//   Inject SVG Sprite -
//   see more here
//   https://css-tricks.com/ajaxing-svg-sprite/
// ------------------------------------------------------ //
function injectSvgSprite(path) {

    var ajax = new XMLHttpRequest();
    ajax.open("GET", path, true);
    ajax.send();
    ajax.onload = function(e) {
        var div = document.createElement("div");
        div.className = 'd-none';
        div.innerHTML = ajax.responseText;
        document.body.insertBefore(div, document.body.childNodes[0]);
    }
}
// this is set to BootstrapTemple website as you cannot
// inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
// while using file:// protocol
// pls don't forget to change to your domain :)
injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');

// var range = document.getElementById('range');
// noUiSlider.create(range, {
//     range: {
//         'min': 0,
//         'max': 2000
//     },
//     step: 5,
//     start: [100, 1000],
//     margin: 300,
//     connect: true,
//     direction: 'ltr',
//     orientation: 'horizontal',
//     behaviour: 'tap-drag',
//     tooltips: true,
//     format: {
//         to: function ( value ) {
//             return '$' + value;
//         },
//         from: function ( value ) {
//             return value.replace('', '');
//         }
//     }
// });
