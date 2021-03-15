jQuery(document).ready(function($) {
    var log = function(msg) {
        return function() {
            if (console) console.log(msg);
            var $test = $('textarea#mytext').val();
            $('span.mytext').text($test);
            $('span.demo-box5').text($test);
        }
    }
    $('code').each(function() {
        var $this = $(this);
        $this.text($this.html());
    })

    var animateClasses = 'bounce flash pulse rubberBand shake headShake swing tada wobble jello bounceIn bounceInDown bounceInLeft bounceInRight bounceInUp bounceOut bounceOutDown bounceOutLeft bounceOutRight bounceOutUp fadeIn fadeInDown fadeInDownBig fadeInLeft fadeInLeftBig fadeInRight fadeInRightBig fadeInUp fadeInUpBig fadeOut fadeOutDown fadeOutDownBig fadeOutLeft fadeOutLeftBig fadeOutRight fadeOutRightBig fadeOutUp fadeOutUpBig flipInX flipInY flipOutX flipOutY lightSpeedIn lightSpeedOut rotateIn rotateInDownLeft rotateInDownRight rotateInUpLeft rotateInUpRight rotateOut rotateOutDownLeft rotateOutDownRight rotateOutUpLeft rotateOutUpRight hinge jackInTheBox rollIn rollOut zoomIn zoomInDown zoomInLeft zoomInRight zoomInUp zoomOut zoomOutDown zoomOutLeft zoomOutRight zoomOutUp slideInDown slideInLeft slideInRight slideInUp slideOutDown slideOutLeft slideOutRight slideOutUp heartBeat';

    var $form = $('.playground form'),
        $viewport = $('.playground .viewport');

    var getFormData = function() {

        var data = {
            loop: true,
            in: {
                callback: log('in callback called.')
            },
            out: {
                callback: log('out callback called.')
            }
        };

        $form.find('[data-key="effect"]').each(function() {
            var $this = $(this),
                key = $this.data('key'),
                type = $this.data('type');
            if ($this.data('key') == 'effect' & $this.data('type') == 'in') {
                $('span.demo-box').text($this.val());
            }
            if ($this.data('key') == 'effect' & $this.data('type') == 'out') {
                $('span.demo-box3').text($this.val());
            }

            data[type][key] = $this.val();
        });

        $form.find('[data-key="type"]').each(function() {

            var $this = $(this),
                key = $this.data('key'),
                type = $this.data('type'),
                val = $this.val();

            if ($this.data('key') == 'type' & $this.data('type') == 'in') {
                $('span.demo-box2').text($this.val());
                if ($this.val() == '') {
                    $('span.demo-box2').text('sequence');
                }
            }
            if ($this.data('key') == 'type' & $this.data('type') == 'out') {
                $('span.demo-box4').text($this.val());
                if ($this.val() == '') {
                    $('span.demo-box4').text('sequence');
                }
            }
            data[type].shuffle = (val === 'shuffle');
            data[type].reverse = (val === 'reverse');
            data[type].sync = (val === 'sync');
        });

        return data;
    };

    $.each(animateClasses.split(' '), function(i, value) {
        var type = '[data-type]',
            option = '<option value="' + value + '">' + value + '</option>';

        if (/Out/.test(value) || value === 'hinge') {
            type = '[data-type="out"]';
        } else if (/In/.test(value)) {
            type = '[data-type="in"]';
        }

        if (type) {
            $form.find('[data-key="effect"]' + type).append(option);
        }
    });

    $form.find('[data-key="effect"][data-type="in"]').val('fadeInLeftBig');
    $form.find('[data-key="effect"][data-type="out"]').val('hinge');

    setTimeout(function() {
        $('.fade').addClass('in');
    }, 250);

    setTimeout(function() {
        $('h1.glow').removeClass('in');
    }, 2000);

    var $tlt = $viewport.find('.tlt')
        .on('start.tlt')
        .on('inAnimationBegin.tlt')
        .on('inAnimationEnd.tlt')
        .on('outAnimationBegin.tlt')
        .on('outAnimationEnd.tlt')
        .on('end.tlt');

    $form.on('change', function() {
        var obj = getFormData();
        $tlt.textillate(obj);
    }).trigger('change');

});

jQuery(document).ready(function($) {
    $('.tbon').textillate({
        loop: false,
        minDisplayTime: 2000,
        initialDelay: 200,
        autoStart: true,
        inEffects: [],
        outEffects: ['hinge'],
        in: {
            effect: 'bounceInDown',
            delayScale: 1.5,
            delay: 50,
            sync: false,
            shuffle: false,
            reverse: true,
            callback: function() {}
        },
        callback: function() {}
    });
})

jQuery(document).ready(function($) {
    $('.tcode').textillate({
        loop: true,
        minDisplayTime: 5000,
        initialDelay: 800,
        autoStart: true,
        inEffects: [],
        outEffects: [],
        in: {
            effect: 'rollIn',
            delayScale: 1.5,
            delay: 50,
            sync: false,
            shuffle: true,
            reverse: false,
            callback: function() {}
        },
        out: {
            effect: 'fadeOut',
            delayScale: 1.5,
            delay: 50,
            sync: false,
            shuffle: true,
            reverse: false,
            callback: function() {}
        },
        callback: function() {}
    });
})

jQuery(document).ready(function($) {
    $('#example').textillate({
        loop: true,
        minDisplayTime: 4000,
        initialDelay: 500,
        autoStart: true,
        inEffects: [],
        outEffects: [],
        in: {
            effect: 'bounceInLeft',
            delayScale: 1.5,
            delay: 50,
            sync: true,
            shuffle: false,
            reverse: false,
            callback: function() {}
        },
        out: {
            effect: 'fadeOut',
            delayScale: 1.5,
            delay: 50,
            sync: false,
            shuffle: true,
            reverse: false,
            callback: function() {}
        },
        callback: function() {}
    });
})

jQuery(document).ready(function(){
  jQuery('#group_example').textillate({
    selector: '.tlt-texts',
    loop: true,
    minDisplayTime: 1000,
    initialDelay: 0,
    autoStart: true,
  });
});

function copyCode1() {
    jQuery('#copytext1').val(jQuery('#demo-container1').text());
    var copyText = document.getElementById('copytext1');
    copyText.select();
    document.execCommand('copy');

    jQuery('#copy1').prop('disabled', true);
    jQuery('#copy1').css('cssText', 'cursor:default!important;');
    jQuery('#copy1 label').css('cssText', 'cursor:default!important;');
    jQuery('#tooltip1').fadeIn().css('display', 'inline-block').delay(600).fadeOut(200, function() {
        jQuery('#copy1').prop('disabled', false);
        jQuery('#copy1').css('cssText', 'cursor:pointer!important;');
        jQuery('#copy1 label').css('cssText', 'cursor:pointer!important;');
    });
}

function copyCode2() {
    jQuery('#copytext2').val(jQuery('#demo-container2').text());
    var copyText = document.getElementById('copytext2');
    copyText.select();
    document.execCommand('copy');

    jQuery('#copy2').prop('disabled', true);
    jQuery('#copy2').css('cssText', 'cursor:default!important;');
    jQuery('#copy2 label').css('cssText', 'cursor:default!important;');
    jQuery('#tooltip2').fadeIn().css('display', 'inline-block').delay(600).fadeOut(200, function() {
        jQuery('#copy2').prop('disabled', false);
        jQuery('#copy2').css('cssText', 'cursor:pointer!important;');
        jQuery('#copy2 label').css('cssText', 'cursor:pointer!important;');
    });
}

function copyCode3() {
    var copyText = document.getElementById('copytext3');
    copyText.select();
    document.execCommand('copy');

    jQuery('#copy3').prop('disabled', true);
    jQuery('#copy3').css('cssText', 'cursor:default!important;');
    jQuery('#copy3 label').css('cssText', 'cursor:default!important;');
    jQuery('#tooltip3').fadeIn().css('display', 'inline-block').delay(600).fadeOut(200, function() {
        jQuery('#copy3').prop('disabled', false);
        jQuery('#copy3').css('cssText', 'cursor:pointer!important;');
        jQuery('#copy3 label').css('cssText', 'cursor:pointer!important;');
    });
}

function copyCode4() {
    var copyText = document.getElementById('copytext4');
    copyText.select();
    document.execCommand('copy');

    jQuery('#copy4').prop('disabled', true);
    jQuery('#copy4').css('cssText', 'cursor:default!important;');
    jQuery('#copy4 label').css('cssText', 'cursor:default!important;');
    jQuery('#tooltip4').fadeIn().css('display', 'inline-block').delay(600).fadeOut(200, function() {
        jQuery('#copy4').prop('disabled', false);
        jQuery('#copy4').css('cssText', 'cursor:pointer!important;');
        jQuery('#copy4 label').css('cssText', 'cursor:pointer!important;');
    });
}

jQuery(document).ready(function($) {
    jQuery('#mytext').bind('input propertychange', function() {
        var $test = $('textarea#mytext').val();
        $('span.mytext').text($test);
        $('span.demo-box5').text($test);
    });
})

jQuery(document).ready(function($){

    checkExpTime();

    $('#close-donat').on('click',function(e) {
        localStorage.setItem('et-close-donat', 'yes');
        $('#donat').slideUp(300);
        $('#restore-hide-blocks').show(300);
        setExpTime();
    });

    $('#close-about').on('click',function(e) {
        localStorage.setItem('et-close-about', 'yes');
        $('#about').slideUp(300);
        $('#restore-hide-blocks').show(300);
        setExpTime();
    });

    $('#restore-hide-blocks').on('click',function(e) {
        localStorage.removeItem('et-time');
        localStorage.removeItem('et-close-donat');
        localStorage.removeItem('et-close-about');
        $('#restore-hide-blocks').hide(300);
        $('#donat').slideDown(300);
        $('#about').slideDown(300);
    });

    function setExpTime() {
        var limit = 90 * 24 * 60 * 60 * 1000; // 3 месяца
        var time = localStorage.getItem('et-time');
        if (time === null) {
            localStorage.setItem('et-time', +new Date());
        } else if(+new Date() - time > limit) {
            localStorage.removeItem('et-time');
            localStorage.removeItem('et-close-donat');
            localStorage.removeItem('et-close-about');
            localStorage.setItem('et-time', +new Date());
        }
    }

    function checkExpTime() {
        var limit = 90 * 24 * 60 * 60 * 1000; // 3 месяца
        var time = localStorage.getItem('et-time');
        if (time === null) {

        } else if(+new Date() - time > limit) {
            localStorage.removeItem('et-time');
            localStorage.removeItem('et-close-donat');
            localStorage.removeItem('et-close-about');
        }
    }

});