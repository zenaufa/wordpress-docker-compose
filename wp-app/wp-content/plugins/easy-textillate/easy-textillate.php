<?php
/*
Plugin Name: Easy Textillate
Plugin URI: https://wordpress.org/plugins/easy-textillate/
Description: Very beautiful text animations (shortcodes in posts and widgets or PHP code in theme files).
Version: 2.01
Author: Flector
Author URI: https://profiles.wordpress.org/flector#content-plugins
Text Domain: easy-textillate
*/

//загрузка файла локализации плагина begin
function et_setup() {
    load_plugin_textdomain('easy-textillate');
}
add_action( 'init', 'et_setup' );
//загрузка файла локализации плагина end

//добавление ссылки "Настройки" на странице со списком плагинов begin
function et_actions( $links ) {
    return array_merge(array('settings' => '<a href="options-general.php?page=easy-textillate.php">' . __('Settings', 'easy-textillate') . '</a>'), $links);
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'et_actions' );
//добавление ссылки "Настройки" на странице со списком плагинов end

//функция загрузки скриптов и стилей плагина на внешней стороне сайта begin
function et_files_front() {
    $purl = plugins_url('', __FILE__);
    if(!wp_script_is('jquery')) {wp_enqueue_script('jquery');}
    wp_register_script('et-lettering', $purl . '/inc/jquery.lettering.js');
    wp_enqueue_script('et-lettering');
    wp_register_script('et-textillate', $purl . '/inc/jquery.textillate.js');
    wp_enqueue_script('et-textillate');
    wp_register_style('et-animate', $purl . '/inc/animate.min.css');
    wp_enqueue_style('et-animate');
}
add_action( 'wp_enqueue_scripts', 'et_files_front' );
//функция загрузки скриптов и стилей плагина на внешней стороне сайта end

//функция загрузки скриптов и стилей плагина только в админке и только на странице настроек плагина begin
function et_files_admin( $hook_suffix ) {
    $purl = plugins_url('', __FILE__);
    if ( $hook_suffix == 'settings_page_easy-textillate' ) {
        if(!wp_script_is('jquery')) {wp_enqueue_script('jquery');}
        wp_register_script('et-lettering', $purl . '/inc/jquery.lettering.js');
        wp_enqueue_script('et-lettering');
        wp_register_script('et-textillate', $purl . '/inc/jquery.textillate.js');
        wp_enqueue_script('et-textillate');
        wp_register_style('et-animate', $purl . '/inc/animate.min.css');
        wp_enqueue_style('et-animate');
        wp_register_script('et-script', $purl . '/inc/easy-textillate.js', array(), '2.01');
        wp_enqueue_script('et-script');
        wp_register_style('et-css', $purl . '/inc/easy-textillate.css', array(), '2.01');
        wp_enqueue_style('et-css');
    }
}
add_action( 'admin_enqueue_scripts', 'et_files_admin' );
//функция загрузки скриптов и стилей плагина только в админке и только на странице настроек плагина end

//функция вывода страницы настроек плагина begin
function et_options_page() {
$purl = plugins_url('', __FILE__);
?>
<div class="wrap foptions">
<h2 class="tbon"><?php _e('&#8220;Easy Textillate&#8221; Settings', 'easy-textillate'); ?></h2>
<span id="restore-hide-blocks" class="dashicons dashicons-admin-generic hide" title="<?php _e('Show hidden blocks', 'easy-textillate'); ?>"></span>

<div class="metabox-holder" id="poststuff">
<div class="meta-box-sortables">

<?php $lang = get_locale(); ?>
<?php if ($lang == 'ru_RU') { ?>
<div class="postbox" id="donat">
<script>
var closedonat = localStorage.getItem('et-close-donat');
if (closedonat == 'yes') {
    document.getElementById('donat').className = 'postbox hide';
    document.getElementById('restore-hide-blocks').className = 'dashicons dashicons-admin-generic';
}
</script>
    <h3 style="border-bottom: 1px solid #E1E1E1;background: #f7f7f7;"><span class="tcode">Вам нравится этот плагин ?</span>
    <span id="close-donat" class="dashicons dashicons-no-alt" title="<?php _e('Hide block', 'easy-textillate'); ?>"></span></h3>
    <div class="inside" style="display: block;margin-right: 12px;">
        <img src="<?php echo $purl . '/img/icon_coffee.png'; ?>" title="Купить мне чашку кофе :)" style="margin: 5px; float:left;" />
        <p>Привет, меня зовут <strong>Flector</strong>.</p>
        <p>Я потратил много времени на разработку этого плагина.<br />
        Поэтому не откажусь от небольшого пожертвования :)</p>
        <a target="_blank" id="yadonate" href="https://money.yandex.ru/to/41001443750704/200">Подарить</a> 
        <p>Или вы можете заказать у меня услуги по WordPress, от мелких правок до создания полноценного сайта.<br />
        Быстро, качественно и дешево. Прайс-лист смотрите по адресу <a target="_blank" href="https://www.wpuslugi.ru/?from=et-plugin">https://www.wpuslugi.ru/</a>.</p>
        <div style="clear:both;"></div>
    </div>
</div>
<?php } else { ?>
<div class="postbox" id="donat">
<script>
var closedonat = localStorage.getItem('et-close-donat');
if (closedonat == 'yes') {
    document.getElementById('donat').className = 'postbox hide';
    document.getElementById('restore-hide-blocks').className = 'dashicons dashicons-admin-generic';
}
</script>
    <h3 style="border-bottom: 1px solid #E1E1E1;background: #f7f7f7;"><span class="tcode"><?php _e('Do you like this plugin ?', 'easy-textillate'); ?></span></h3>
    <div class="inside" style="display: block;margin-right: 12px;">
        <img src="<?php echo $purl . '/img/icon_coffee.png'; ?>" title="<?php _e('buy me a coffee', 'easy-textillate'); ?>" style="margin: 5px; float:left;" />
        <p><?php _e('Hi! I\'m <strong>Flector</strong>, developer of this plugin.', 'easy-textillate'); ?></p>
        <p><?php _e('I\'ve spent many hours developing this plugin.', 'easy-textillate'); ?> <br />
        <?php _e('If you like and use this plugin, you can <strong>buy me a cup of coffee</strong>.', 'easy-textillate'); ?></p>
        <a target="_blank" href="https://www.paypal.me/flector"><img alt="" src="<?php echo $purl . '/img/donate.gif'; ?>" title="<?php _e('Donate with PayPal', 'easy-textillate'); ?>" /></a>
        <div style="clear:both;"></div>
    </div>
</div>
<?php } ?>

<div class="postbox">
    <h3 style="border-bottom: 1px solid #E1E1E1;background: #f7f7f7;"><span class="tcode"><?php _e('Preview', 'easy-textillate'); ?></span></h3>
    <div class="inside" style="display: block;">

        <div class="grid grid-pad" style="margin-top:12px!important;">
        <section class="col-1-1">

            <div class="playground grid">
              <div class="col-1-1 viewport">
                  <div class="tlt">
                    <ul class="texts" style="display: none">
                      <span class="mytext"></span>
                    </ul>
                  </div>
              </div>
              <div class="col-1-1 controls" style="padding-right: 0">
                <form class="grid grid-pad">
                <div class="control txtarea">
                <label style="margin-top: 15px;"><?php _e('Your Text', 'easy-textillate'); ?></label>
                <textarea name="mytext" id="mytext" rows="3"><?php _e('The quick brown fox jumps over the lazy dog.', 'easy-textillate'); ?></textarea>
                </div>

                  <div class="control col-1-2">
                    <label><?php _e('In Animation', 'easy-textillate'); ?></label>
                    <select name="in_effect" data-key="effect" data-type="in">
                    </select>
                    <select data-key="type" data-type="in">
                      <option value="">sequence</option>
                      <option value="reverse">reverse</option>
                      <option value="sync">sync</option>
                      <option value="shuffle">shuffle</option>
                    </select>
                  </div>
                  <div class="control col-1-2">
                    <label><?php _e('Out Animation', 'easy-textillate'); ?></label>
                    <select name="out_effect"data-key="effect" data-type="out"></select>
                    <select name="out_type" data-key="type" data-type="out">
                      <option value="">sequence</option>
                      <option value="reverse">reverse</option>
                      <option value="sync">sync</option>
                      <option selected="selected" value="shuffle">shuffle</option>
                    </select>
                  </div>
                </form>
              </div>
            </div>

        </section>
      </div>

      <div style="clear:both;"></div>
    </div>
</div>

<div class="postbox">
    <h3 style="border-bottom: 1px solid #E1E1E1;background: #f7f7f7;"><span class="tcode"><?php _e('Shortcode', 'easy-textillate'); ?></span></h3>
    <div class="inside" style="padding-bottom:20px;padding-top:15px;display: block;">

    <table width="100%">
    <tr><td>

    <input style="left:-2000px;position: absolute;" type="text" value="" id="copytext1">
    <input style="left:-2000px;position: absolute;" type="text" value="" id="copytext2">

    <span style="color:#183691;" id="demo-container1">[textillate effect_in='<span style="color:green;" class="demo-box"></span>' type_in='<span style="color:green;" class="demo-box2"></span>' effect_out='<span style="color:green;" class="demo-box3"></span>' type_out='<span style="color:green;" class="demo-box4"></span>']<span style="color:#A71D5D;" class="demo-box5"></span>[/textillate]
    </span>
    </td>
    <td width="50px" style="align:right;">

     <span style="text-align:right;">
         <div style="position:relative"><button onclick="copyCode1()" id="copy1" class="button mybutton copybutton"><label><?php _e('Copy to Clipboard', 'easy-textillate'); ?></label></button><span id="tooltip1"><?php _e('Copied', 'easy-textillate'); ?></span></div>
     </span>

     </td></tr>
     </table>

    </div>
</div>

<div class="postbox">
    <h3 style="border-bottom: 1px solid #E1E1E1;background: #f7f7f7;"><span class="tcode"><?php _e('PHP code', 'easy-textillate'); ?></span></h3>
    <div class="inside" style="padding-bottom:20px;padding-top:15px;display: block;">

    <table width="100%">
    <tr><td>

    <span style="color:#183691;" id="demo-container2"><span style="color:#A71D5D;">&lt;?php</span> <span style="color:red;">echo do_shortcode("</span>[textillate effect_in='<span style="color:green;" class="demo-box"></span>' type_in='<span style="color:green;" class="demo-box2"></span>' effect_out='<span style="color:green;" class="demo-box3"></span>' type_out='<span style="color:green;" class="demo-box4"></span>']<span style="color:#A71D5D;" class="demo-box5"></span>[/textillate]<span style="color:red;">");</span> <span style="color:#A71D5D;">?&gt;</span>
    </span>

     </td>
    <td width="50px" style="align:right;">

     <span style="text-align:right;">
         <div style="position:relative"><button onclick="copyCode2()" id="copy2" class="button mybutton copybutton"><?php _e('Copy to Clipboard', 'easy-textillate'); ?></button><span id="tooltip2"><?php _e('Copied', 'easy-textillate'); ?></span></div>
     </span>

     </td></tr>
     </table>

    </div>
</div>

<div class="postbox">
    <h3 style="border-bottom: 1px solid #E1E1E1;background: #f7f7f7;"><span class="tcode"><?php _e('Additional Options', 'easy-textillate'); ?></span></h3>
    <div class="inside" style="padding-bottom:20px;display: block;">

        <p><?php _e('You can use additional shortcode options:', 'easy-textillate'); ?></p>

        <table><tr><td width="170px;">
        <span style="color:#183691;">loop=</span><span style="color:green;">'true'</span></td><td> <span style="color:#807b7b;">// <?php _e('enable looping  (\'true\' or \'false\'; \'true\' is default)', 'easy-textillate'); ?> </span></td></tr>
        <tr><td><span style="color:#183691;">minDisplayTime=</span><span style="color:green;">'2000'</span></td><td> <span style="color:#807b7b;">// <?php _e('sets the minimum display time for each text before it is replaced (\'2000\' is default)', 'easy-textillate'); ?></span></td></tr>
        <tr><td><span style="color:#183691;">initialDelay=</span><span style="color:green;">'0'</span></td><td>  <span style="color:#807b7b;">// <?php _e('sets the initial delay before starting the animation (\'0\' is default)', 'easy-textillate'); ?></span></td></tr>
        <tr><td><span style="color:#183691;">delay=</span><span style="color:green;">'50'</span></td><td>  <span style="color:#807b7b;">// <?php _e('sets the delay between each character (\'50\' is default)', 'easy-textillate'); ?></span></td></tr>
        </table>

        <table style="margin-top:10px;"><tr><td width="170px;">
        <span style="color:#183691;">font_family=</span><span style="color:green;">'Arial'</span></td><td> <span style="color:#807b7b;">// <?php _e('specifies the font (\'Arial\', \'Roboto\', etc; \'inherit\' is default)', 'easy-textillate'); ?> </span></td></tr>
        <tr><td><span style="color:#183691;">font_color=</span><span style="color:green;">'#ff0000'</span></td><td> <span style="color:#807b7b;">// <?php _e('specifies the color (\'#ff0000\', \'red\', etc; \'inherit\' is default)', 'easy-textillate'); ?></span></td></tr>
        <tr><td><span style="color:#183691;">font_size=</span><span style="color:green;">'24px'</span></td><td>  <span style="color:#807b7b;">// <?php _e('sets the size of a font (\'24px\', \'1.5em\', etc; \'inherit\' is default)', 'easy-textillate'); ?></span></td></tr>
        <tr><td><span style="color:#183691;">font_weight=</span><span style="color:green;">'bold'</span></td><td>  <span style="color:#807b7b;">// <?php _e('sets how thick or thin characters in text should be displayed (\'bold\', \'normal\', \'600\', etc; \'inherit\' is default)', 'easy-textillate'); ?></span></td></tr>
        <tr><td><span style="color:#183691;">letter_spacing=</span><span style="color:green;">'2px'</span></td><td>  <span style="color:#807b7b;">// <?php _e('increases or decreases the space between characters in a text (\'1px\', \'2px\', etc; \'inherit\' is default)', 'easy-textillate'); ?></span></td></tr>
        </table>

        <p style="margin-top:20px;"><span id="example" style="color:#ff0000;font-family:Arial;font-size:24px;font-weight:bold;letter-spacing:2px;"><?php _e('Example', 'easy-textillate'); ?></span></p>

        <table width="100%">
        <tr><td>

        <input style="left:-2000px;position: absolute;" type="text" value="[textillate font_family='Arial' font_color='#ff0000' font_size='24px' font_weight='bold' letter_spacing='2px' effect_in='bounceInLeft' type_in='sync' effect_out='fadeOut' type_out='shuffle' loop='true' minDisplayTime='4000' initialDelay='500' delay='50']Пример[/textillate]" id="copytext3">

        <span style="color:#183691;" id="demo-container3">[textillate font_family='<span style="color:green;">Arial</span>' font_color='<span style="color:green;">#ff0000</span>' font_size='<span style="color:green;">24px</span>' font_weight='<span style="color:green;">bold</span>' letter_spacing='<span style="color:green;">2px</span>' effect_in='<span style="color:green;">bounceInLeft</span>' type_in='<span style="color:green;">sync</span>' effect_out='<span style="color:green;">fadeOut</span>' type_out='<span style="color:green;">shuffle</span>' loop='<span style="color:green;">true</span>' minDisplayTime='<span style="color:green;">4000</span>' initialDelay='<span style="color:green;">500</span>' delay='<span style="color:green;">50</span>']<span style="color:#A71D5D;"></span><span style="color:#A71D5D;"><?php _e('Example', 'easy-textillate'); ?></span>[/textillate]
        </span>
        </td>
        <td width="50px" style="align:right;">

        <span style="text-align:right;">
            <div style="position:relative"><button onclick="copyCode3()" id="copy3" class="button mybutton copybutton"><label><?php _e('Copy to Clipboard', 'easy-textillate'); ?></label></button><span id="tooltip3"><?php _e('Copied', 'easy-textillate'); ?></span></div>
        </span>

        </td></tr>
        </table>

        <p style="margin-top:40px;margin-bottom: 0;"><?php _e('New shortcode', 'easy-textillate'); ?><span style="color:#A71D5D;"> [textillate-group]</span>:</p>

        <p>
            <div id="group_example" style="font-family:Arial!important;color:#4843bd!important;font-size:22px!important;font-weight:bold!important;letter-spacing:0px!important;"><span style="visibility: hidden;">
                <ul class="tlt-texts" style="display:none;">
                    <li data-in-delay="50" data-out-delay="50" data-in-effect="bounceInLeft" data-in-sync="true" data-out-effect="fadeOut" data-out-shuffle="true"><?php _e('Some Title', 'easy-textillate'); ?></li>
                    <li data-in-delay="50" data-out-delay="50" data-in-effect="bounceInLeft" data-in-sync="true" data-out-effect="fadeOut" data-out-shuffle="true"><?php _e('Another Title', 'easy-textillate'); ?></li>
                </ul>&nbsp;
            </span></div>
        </p>

        <table width="100%">
        <tr><td>

        <input style="left:-2000px;position: absolute;" type="text" value="[textillate-group loop='true' minDisplayTime='1000' initialDelay='0' font_family='Arial' font_color='#4843bd' font_size='22px' font_weight='bold' letter_spacing='0px'][textillate effect_in='bounceInLeft' type_in='sync' effect_out='fadeOut' type_out='shuffle' delay='50']Some Title[/textillate][textillate effect_in='bounceInLeft' type_in='sync' effect_out='fadeOut' type_out='shuffle' delay='50']Another Title[/textillate][/textillate-group]" id="copytext4">

        <span style="color:#183691;" id="demo-container4">[textillate-group loop='<span style="color:green;">true</span>' minDisplayTime='<span style="color:green;">1000</span>' initialDelay='<span style="color:green;">0</span>' font_family='<span style="color:green;">Arial</span>' font_color='<span style="color:green;">#4843bd'</span> font_size='<span style="color:green;">22px</span>' font_weight='<span style="color:green;">bold</span>' letter_spacing='<span style="color:green;">0px</span>']<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[textillate effect_in='<span style="color:green;">bounceInLeft</span>' type_in='<span style="color:green;">sync</span>' effect_out='<span style="color:green;">fadeOut</span>' type_out='<span style="color:green;">shuffle</span>' delay='<span style="color:green;">50</span>']<span style="color:#A71D5D;"><?php _e('Some Title', 'easy-textillate'); ?></span>[/textillate]<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[textillate effect_in='<span style="color:green;">bounceInLeft</span>' type_in='<span style="color:green;">sync</span>' effect_out='<span style="color:green;">fadeOut</span>' type_out='<span style="color:green;">shuffle</span>' delay='<span style="color:green;">50</span>']<span style="color:#A71D5D;"><?php _e('Another Title', 'easy-textillate'); ?></span>[/textillate]<br />[/textillate-group]
        </span>

        </td>
        <td width="50px" style="align:right;">

        <span style="text-align:right;">
            <div style="position:relative"><button onclick="copyCode4()" id="copy4" class="button mybutton copybutton"><label><?php _e('Copy to Clipboard', 'easy-textillate'); ?></label></button><span id="tooltip4"><?php _e('Copied', 'easy-textillate'); ?></span></div>
        </span>

        </td></tr>
        </table>

    </div>
</div>

<div id="about" class="postbox" style="margin-bottom:0;">
<script>
var closeabout = localStorage.getItem('et-close-about');
if (closeabout == 'yes') {
    document.getElementById('about').className = 'postbox hide';
    document.getElementById('restore-hide-blocks').className = 'dashicons dashicons-admin-generic';
}
</script>
    <h3 style="border-bottom: 1px solid #E1E1E1;background: #f7f7f7;"><span class="tcode"><?php _e('About', 'easy-textillate'); ?></span>
    <span id="close-about" class="dashicons dashicons-no-alt" title="<?php _e('Hide block', 'easy-textillate'); ?>"></span></h3>
      <div class="inside" style="padding-bottom:15px;display: block;">

      <p><?php _e('If you liked my plugin, please <a target="_blank" href="https://wordpress.org/support/plugin/easy-textillate/reviews/#new-post"><strong>rate</strong></a> it.', 'easy-textillate'); ?></p>
      <p style="margin-top:20px;margin-bottom:10px;"><?php _e('You may also like my other plugins:', 'easy-textillate'); ?></p>

      <div class="about">
        <ul>
            <?php if ($lang == 'ru_RU') : ?>
            <li><a target="_blank" href="https://ru.wordpress.org/plugins/rss-for-yandex-zen/">RSS for Yandex Zen</a> - создание RSS-ленты для сервиса Яндекс.Дзен.</li>
            <li><a target="_blank" href="https://ru.wordpress.org/plugins/rss-for-yandex-turbo/">RSS for Yandex Turbo</a> - создание RSS-ленты для сервиса Яндекс.Турбо.</li>
            <?php endif; ?>
            <li><a target="_blank" href="https://wordpress.org/plugins/bbspoiler/">BBSpoiler</a> - <?php _e('this plugin allows you to hide text using the tags [spoiler]your text[/spoiler].', 'easy-textillate'); ?></li>
            <li><a target="_blank" href="https://wordpress.org/plugins/cool-image-share/">Cool Image Share</a> - <?php _e('this plugin adds social sharing icons to each image in your posts.', 'easy-textillate'); ?></li>
            <li><a target="_blank" href="https://wordpress.org/plugins/today-yesterday-dates/">Today-Yesterday Dates</a> - <?php _e('this plugin changes the creation dates of posts to relative dates.', 'easy-textillate'); ?></li>
            <li><a target="_blank" href="https://wordpress.org/plugins/truncate-comments/">Truncate Comments</a> - <?php _e('this plugin uses Javascript to hide long comments (Amazon-style comments).', 'easy-textillate'); ?></li>
            <li><a target="_blank" href="https://wordpress.org/plugins/easy-yandex-share/">Easy Yandex Share</a> - <?php _e('share buttons for WordPress from Yandex. ', 'easy-textillate'); ?></li>
            <li><a target="_blank" href="https://wordpress.org/plugins/hide-my-dates/">Hide My Dates</a> - <?php _e('this plugin hides post and comment publishing dates from Google.', 'easy-textillate'); ?></li>
            <li style="margin: 3px 0px 3px 35px;"><a target="_blank" href="https://wordpress.org/plugins/html5-cumulus/">HTML5 Cumulus</a> <span class="new">new</span> - <?php _e('a modern (HTML5) version of the classic &#8220;WP-Cumulus&#8221; plugin.', 'easy-textillate'); ?></li>
            </ul>
      </div>

    </div>
</div>

</div>
</div>
<?php 
}
//функция вывода страницы настроек плагина end

//функция добавления ссылки на страницу настроек плагина в раздел "Настройки" begin
function et_menu() {
    add_options_page('Easy Textillate', 'Easy Textillate', 'manage_options', 'easy-textillate.php', 'et_options_page');
}
add_action( 'admin_menu', 'et_menu' );
//функция добавления ссылки на страницу настроек плагина в раздел "Настройки" end

//функция генерация случайного текстового ID из заданного диапазона begin
function et_randomid( $length = 4 ) {
    $chars = 'abdefhiknrstyz';
    $numChars = strlen($chars);
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= substr($chars, rand(1, $numChars) - 1, 1);
    }
    return $string;
}
//функция генерация случайного текстового ID из заданного диапазона end

//функция шорткода плагина [textillate] begin
function et_textillate_shortcode( $atts, $content ) {

    //удаляем html-сущности символов " и ' (нужно из-за заголовков виджетов)
    $atts = str_replace(array('&#039;', '&quot;'), '', $atts);

    extract(shortcode_atts(array(
        'effect_in'       => 'fadeInLeftBig',
        'type_in'         => 'sequence',
        'effect_out'      => 'hinge',
        'type_out'        => 'shuffle',
        'loop'            => 'true',
        'mindisplaytime'  => '2000',
        'initialdelay'    => '0',
        'delay'           => '50',
        'font_family'     => 'inherit',
        'font_color'      => 'inherit',
        'font_size'       => 'inherit',
        'font_weight'     => 'inherit',
        'letter_spacing'  => 'inherit',
    ), $atts));

    //засовываем в переменную все извлеченные параметры шорткода
    $textillate_options['randomid'] = et_randomid(6);
    $textillate_options['effect_in'] = $effect_in;
    $textillate_options['type_in'] = $type_in;
    $textillate_options['effect_out'] = $effect_out;
    $textillate_options['type_out'] = $type_out;
    $textillate_options['loop'] = $loop;
    $textillate_options['mindisplaytime'] = $mindisplaytime;
    $textillate_options['initialdelay'] = $initialdelay;
    $textillate_options['delay'] = $delay;
    $textillate_options['font_family'] = $font_family;
    $textillate_options['font_color'] = $font_color;
    $textillate_options['font_size'] = $font_size;
    $textillate_options['font_weight'] = $font_weight;
    $textillate_options['letter_spacing'] = $letter_spacing;

    //этот блок выполняется только, если он внутри шорткода [textillate-group]
    global $et_textillate_group;
    if ( $et_textillate_group == true ) {
        if ( $type_in == 'sync' ) $temp_in = ' data-in-sync="true"';
        if ( $type_in == 'sequence' ) $temp_in = ' data-in-sequence="true"';
        if ( $type_in == 'shuffle' ) $temp_in = ' data-in-shuffle="true"';
        if ( $type_in == 'reverse' ) $temp_in = ' data-in-reverse="true"';
        if ( ! $temp_in ) $temp_in = ' data-in-sequence="true"';
        if ( $type_out == 'sync' ) $temp_out = ' data-out-sync="true"';
        if ( $type_out == 'sequence' ) $temp_out = ' data-out-sequence="true"';
        if ( $type_out == 'shuffle' ) $temp_out = ' data-out-shuffle="true"';
        if ( $type_out == 'reverse' ) $temp_out = ' data-out-reverse="true"';
        if ( ! $temp_out ) $temp_out = ' data-out-shuffle="true"';
        $output = '<span data-in-delay="'.$delay.'" data-out-delay="'.$delay.'" data-in-effect="'.$effect_in.'"'.$temp_in.' data-out-effect="'.$effect_out.'"'.$temp_out.'>';
        $output .= $content;
        $output .= '</span>';
        return $output;
    }

    //выводим разметку сразу (у каждого шорткода свой уникальный ID)
    $output  = '<span id="textillate-' . $textillate_options['randomid'] . '">';
    $output .= $content;
    $output .= '</span>';

    //скрипты не выводим, а записываем в буферную переменную $et_scripts
    //чтобы потом вывести их в footer секции функцией et_scripts_footer()
    global $et_scripts;
    ob_start();
    et_print_scripts($textillate_options);
    $et_scripts .= ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'textillate', 'et_textillate_shortcode' );
//функция шорткода плагина [textillate] end

//функция шорткода плагина [textillate-group] begin
function et_textillate_group_shortcode( $atts, $content ) {

    //удаляем html-сущности символов " и ' (нужно из-за заголовков виджетов)
    $atts = str_replace(array('&#039;', '&quot;'), '', $atts);

    extract(shortcode_atts(array(
        'loop'            => 'true',
        'mindisplaytime'  => '2000',
        'initialdelay'    => '0',
        'delay'           => '50',
        'font_family'     => 'inherit',
        'font_color'      => 'inherit',
        'font_size'       => 'inherit',
        'font_weight'     => 'inherit',
        'letter_spacing'  => 'inherit',
    ), $atts));

    //засовываем в переменную все извлеченные параметры шорткода
    $textillate_options['randomid'] = et_randomid(6);
    $textillate_options['loop'] = $loop;
    $textillate_options['mindisplaytime'] = $mindisplaytime;
    $textillate_options['initialdelay'] = $initialdelay;
    $textillate_options['delay'] = $delay;
    $textillate_options['font_family'] = $font_family;
    $textillate_options['font_color'] = $font_color;
    $textillate_options['font_size'] = $font_size;
    $textillate_options['font_weight'] = $font_weight;
    $textillate_options['letter_spacing'] = $letter_spacing;

    //выводим разметку сразу (у каждого шорткода свой уникальный ID)
    //выполняем внутри шорткоды [textillate] по специальной схеме
    //для этого ставим глобальный флаг $et_textillate_group
    global $et_textillate_group;
    $et_textillate_group = true;
    $output  = '<span id="textillate-' . $textillate_options['randomid'] . '">';
    $output .= '<span style="visibility: hidden;"><span class="tlt-texts" style="display:none;">' . do_shortcode($content) . '</span>&nbsp;</span>';
    $output .= '</span>';
    $et_textillate_group = false;

    //скрипты не выводим, а записываем в буферную переменную $et_scripts
    //чтобы потом вывести их в footer секции функцией et_scripts_footer()
    global $et_scripts;
    ob_start();
    et_print_scripts_group($textillate_options);
    $et_scripts .= ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'textillate-group', 'et_textillate_group_shortcode' );
//функция шорткода плагина [textillate-group] end

//функция вывода скриптов плагина (записываются в буферную переменную $et_scripts) begin
function et_print_scripts( $textillate_options ) { ?>
<script>
jQuery(document).ready(function(){
  jQuery('#textillate-<?php echo $textillate_options['randomid']; ?>').textillate({
    loop: <?php echo $textillate_options['loop']; ?>,
    minDisplayTime: <?php echo $textillate_options['mindisplaytime'];?>,
    initialDelay: <?php echo $textillate_options['initialdelay']; ?>,
    autoStart: true,
    in: {
        effect: '<?php echo $textillate_options['effect_in']; ?>',
        delayScale: 1.5,
        delay: <?php echo $textillate_options['delay']; ?>,
        sync: <?php if ($textillate_options['type_in']=='sync'){echo 'true';}else{echo 'false';}; ?>,
        sequence: <?php if ($textillate_options['type_in']=='sequence'){echo 'true';}else{echo 'false';}; ?>,
        shuffle: <?php if ($textillate_options['type_in']=='shuffle'){echo 'true';}else{echo 'false';}; ?>,
        reverse: <?php if ($textillate_options['type_in']=='reverse'){echo 'true';}else{echo 'false';}; ?>,
        callback: function () {}
    },
    out: {
        effect: '<?php echo $textillate_options['effect_out']; ?>',
        delayScale: 1.5,
        delay: <?php echo $textillate_options['delay']; ?>,
        sync: <?php if ($textillate_options['type_out']=='sync'){echo 'true';}else{echo 'false';}; ?>,
        sequence: <?php if ($textillate_options['type_out']=='sequence'){echo 'true';}else{echo 'false';}; ?>,
        shuffle: <?php if ($textillate_options['type_out']=='shuffle'){echo 'true';}else{echo 'false';}; ?>,
        reverse: <?php if ($textillate_options['type_out']=='reverse'){echo 'true';}else{echo 'false';}; ?>,
        callback: function () {}
    },
    callback: function () {}
  });
});
</script>
<style>
#textillate-<?php echo $textillate_options['randomid']; ?> {
  font-family:<?php echo $textillate_options['font_family']; ?>!important;
  color:<?php echo $textillate_options['font_color']; ?>!important;
  font-size:<?php echo $textillate_options['font_size']; ?>!important;
  font-weight:<?php echo $textillate_options['font_weight']; ?>!important;
  letter-spacing:<?php echo $textillate_options['letter_spacing']; ?>!important;
}
</style>
<?php }
//функция вывода скриптов плагина (записываются в буферную переменную $et_scripts) end

//функция вывода скриптов плагина (записываются в буферную переменную $et_scripts) begin
function et_print_scripts_group( $textillate_options ) { ?>
<script>
jQuery(document).ready(function(){
  jQuery('#textillate-<?php echo $textillate_options['randomid']; ?>').textillate({
    selector: '.tlt-texts',
    loop: <?php echo $textillate_options['loop']; ?>,
    minDisplayTime: <?php echo $textillate_options['mindisplaytime'];?>,
    initialDelay: <?php echo $textillate_options['initialdelay']; ?>,
    autoStart: true,
  });
});
</script>
<style>
#textillate-<?php echo $textillate_options['randomid']; ?> {
  font-family:<?php echo $textillate_options['font_family']; ?>!important;
  color:<?php echo $textillate_options['font_color']; ?>!important;
  font-size:<?php echo $textillate_options['font_size']; ?>!important;
  font-weight:<?php echo $textillate_options['font_weight']; ?>!important;
  letter-spacing:<?php echo $textillate_options['letter_spacing']; ?>!important;
}
</style>
<?php }
//функция вывода скриптов плагина (записываются в буферную переменную $et_scripts) end

//функция вывода скриптов из буферной переменной $et_scripts в footer секцию страницы begin
function et_scripts_footer() {
    global $et_scripts;
    echo $et_scripts;
}
add_action( 'wp_footer', 'et_scripts_footer' );
//функция вывода скриптов из буферной переменной $et_scripts в footer секцию страницы end

//поддержка шорткодов в виджетах begin
add_filter( 'widget_text', 'do_shortcode' );
add_filter( 'widget_title', 'do_shortcode' );
//поддержка шорткодов в виджетах end

//включаем шорткоды в заголовках только при выводе в цикле begin
function et_do_shortcode_in_title_only_in_loop( $title ) {
    global $donttitle;
    if ( $donttitle == true && !is_admin() ) return strip_shortcodes($title);

    if ( in_the_loop() && ! is_admin() ) {
        $title = do_shortcode($title);
    }
    if ( ! is_admin() && ! in_the_loop() ) {
        $title = strip_shortcodes($title);
    }
    return $title;
}
add_action( 'the_title', 'et_do_shortcode_in_title_only_in_loop' );
//включаем шорткоды в заголовках только при выводе в цикле end

//ставим флаг, чтобы шорткод плагина удалялся из заголовков вроде
//комментарии к "название записи" и пред/след пост begin
function et_flag_if_content_close( $content ) {
    if ( is_singular() ) {
        global $donttitle;
        $donttitle = true;
    }
    return $content;
}
add_filter( 'the_content', 'et_flag_if_content_close' );
//ставим флаг, чтобы шорткод плагина удалялся из заголовков вроде
//комментарии к "название записи" и пред/след пост end

//поддержка шорткодов для bbpress begin
function et_enable_shortcode( $content ) {return do_shortcode($content);}
add_filter( 'bbp_get_reply_content', 'et_enable_shortcode', 10,2 );
add_filter( 'bbp_get_topic_content', 'et_enable_shortcode', 10,2 );
//поддержка шорткодов для bbpress end