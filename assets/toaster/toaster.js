/**
 * Toaster.js
 * 
 * Repository: https://github.com/BigCoke233/toaster.js
 * Version: 0.1
 * 
 * jQuery required!
 */

(function(){

    Toaster = {};

    Toaster.amount = 0;

    Toaster.send = function(m, color='rgb(197,197,106)') {
        Toaster.dismiss('#toast-'+Toaster.amount);

        Toaster.amount++;

        var id = 'toast-'+Toaster.amount;
        var selector = '#'+id;
        $toast = $('<div class="toaster"></div>').attr('id',id).text(m).css({'background': color});
        $('body').append($toast);
        setTimeout(function(){
            $(selector).addClass('toasting');
        }, 1);

        $(selector).click(function(){
            Toaster.dismiss(selector);
        });

        setTimeout(function(){
            Toaster.dismiss(selector);
        }, 2000);
    };

    Toaster.error = function(m) {
        Toaster.send(m, 'rgb(244,66,54)');
    }

    Toaster.dismiss = function(toast) {
        $(toast).removeClass('toasting').addClass('toast-dismissed');
        setTimeout(function(){
            $(toast).remove();
        }, 1000);
    }

    return Toaster;

})();