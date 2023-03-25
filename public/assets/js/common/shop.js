$(function () {
    $('#acardion').on('click', '.accordion-control', function (e) {
        $(this).next('.accordion-panel').not(':animated').slideToggle();
        e.preventDefault();
    });
});

$('.baskettop').on({
    mouseenter: function () {
        $('#slidedown-cart').css('display', 'block');
    },
    mouseleave: function () {
        $('#slidedown-cart').css('display', 'none');
    }
});
