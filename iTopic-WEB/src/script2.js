$(document).ready(function() {
    // Mostrar y ocultar formularios de registro e inicio de sesión
    $('.tab a').on('click', function(e) {
        e.preventDefault();

        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');

        let target = $(this).attr('href');

        $('.tab-content > div').not(target).hide();

        $(target).fadeIn(600);
    });

    // Animación en etiquetas de los inputs
    $('.form').find('input').on('keyup blur focus', function(e) {
        var $this = $(this),
            label = $this.prev('label');

        if (e.type === 'keyup') {
            if ($this.val() === '') {
                label.removeClass('hidden');
            } else {
                label.addClass('hidden');
            }
        } else if (e.type === 'blur') {
            if ($this.val() === '') {
                label.removeClass('hidden');
            } else {
                label.addClass('hidden');
            }
        } else if (e.type === 'focus') {
            if ($this.val() === '') {
                label.removeClass('hidden');
            }
        }
    });
});
