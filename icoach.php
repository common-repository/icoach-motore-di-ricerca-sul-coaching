<?php defined('ABSPATH') OR die('Dove Cavolo Stai Andando?.');
/*
Plugin Name: iCoach - Motore di Ricerca sul Coaching
Plugin URI: https://www.prometeocoaching.it/icoach-wordpress-plugin
Description: iCoach è un Motore di Ricerca che offre le definizioni dei termini del Coaching con approfondimenti video, audio e testuali.
Version: 1.0.2
Author: Prometeo Coaching ®
Author URI: https://www.prometeocoaching.it
Text Domain: icoach-wp
License: Non opere derivate 4.0
Copyright 2017-18 Prometeo Coaching ® (email: develop@prometeoapp.it)
 */
 
/*
iCoach - Motore di Ricerca sul Coaching
Copyright (C) 2017 - 2018, Prometeo Coaching ® <develop@prometeoapp.it>

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/ 

/* INIZIO CODICE */ 

/**
 * iCoach Prometeo Coaching ®
 * Versione corrente del plugin.
 * Rinomina il numero della versione per rilasciare un aggiornamento.
 */
define( 'icoach-wp', '1.0.2' );

header("Access-Control-Allow-Origin: *"); 
header('Access-Control-Allow-Headers: Content-Type');

/**
 * Il Codice che lancia l'attivazione
 * Questa azione è inclusa nella cartella includes/class-icoach-wp-activator.php
 */
function activate_icoach() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-icoach-wp-activator.php';
	icoach_activator::activate();
}

/**
 * Il Codice che lancia la disattivazione
 * Questa azione è inclusa nella cartella includes/class-icoach-wp-deactivator.php
 */
function deactivate_icoach() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-icoach-wp-deactivator.php';
	icoach_deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_icoach' );
register_deactivation_hook( __FILE__, 'deactivate_icoach' );

function icoach_scripts() {
  // register your script
  wp_register_script( 'jquery-ui-core', includes_url( '/js/jquery/jquery-migrate.min.js' ), false, NULL, true );
  wp_enqueue_script( 'jquery-ui-core' );
  wp_register_script('search', plugins_url('assets/js/search.js', __FILE__));
  wp_register_script('icoach-core', plugins_url('assets/js/icoach-core.js', __FILE__));
  wp_localize_script('search', 'search', 
                     array('plugin_path' => plugin_dir_url(__FILE__)));
}



function icoach_stylesheet() 
{
    wp_enqueue_style( 'whitmore', plugins_url( 'assets/css/whitmore.css', __FILE__ ) );
    wp_enqueue_style( 'font-awesome', plugins_url( 'assets/css/font-awesome.css', __FILE__ ) );
}

add_action('admin_print_styles', 'icoach_stylesheet');


// iCoach Prometeo Coaching ® - Aggiungi Menu e SubMenu
 function icoach_topmenu(){
   add_menu_page('iCoach', 'iCoach', 'manage_options', __FILE__, 'icoach_plugin_page', plugins_url('assets/images/logo.svg',__FILE__));
   add_submenu_page(__FILE__, 'Info Plugin', 'Info Plugin', 'manage_options', __FILE__.'/Info', 'icoach_render_about_page');
   add_submenu_page(__FILE__, 'Opzioni Plugin', 'Opzioni Plugin', 'manage_options', __FILE__.'/Opzioni', 'icoach_render_custom_page');
 }
 function icoach_plugin_page(){
  ?>
  <div class="clear"></div>
<div id="preloader"></div>
<div class="mains">
 <div align="center"> <a class="bottone" href="#popup1"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'includes/img/logo.png'; ?>" name="Video" style="width: 374px; margin-bottom: 20px;"></a></div>
  <input placeholder="Cerca un Termine di Coaching..." name="srch" class="search" id="words">
  <div align="center" style="margin-top:14px;">
  <a href="https://chrome.google.com/webstore/detail/icoach-il-motore-di-ricer/ambabnanecfabkagdlajogfckdkojicm?hl=it" target="_blank" rel="noopener">
  <img src="<?php echo plugin_dir_url( __FILE__ ) . 'includes/img/chrome-web-store-gray.jpg'; ?>">
  </a>
  <ul class="social_list list-inline color">
   <li><a href="https://facebook.com/formazioneprometeocoaching" target="_blank" rel="noopener"><i class="fa fa-facebook-official"></i></a></li>
   <li><a href="https://twitter.com/prometeocoach" target="_blank" rel="noopener"><i class="fa fa-twitter"></i></a></li>
   <li><a href="https://plus.google.com/+PrometeocoachingIt" target="_blank" rel="noopener"><i class="fa fa-google"></i></a></li>
   <li><a href="https://pinterest.com/prometeocoach" target="_blank" rel="noopener"><i class="fa fa-pinterest"></i></a></li>	
   <li><a href="https://it.linkedin.com/in/prometeocoaching" target="_blank" rel="noopener"><i class="fa fa-linkedin"></i></a></li>
</ul>
  <div align="center"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/loader.gif'; ?>" class="someSpinnerImage"></div>
  <ul class="results"></ul>
    <a id="link" class="totop"> <img src="<?php echo plugin_dir_url( __FILE__ ) . 'includes/img/top.svg'; ?>" style="width:30px;"></a>
</div>
<div id="popup1" class="overlay">
	<div class="popup">
		<a class="close fancybox-close" href="#">×</a>
		<div class="content">
			<iframe width="100%" height="315" src="https://www.youtube.com/embed/GaY5rl_Kysc?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		</div>
	</div>
</div>
  <div align="center" class="version tooltip">
  <a href="javascript:void(0)">
  <span class="tooltiptext"><b>Sir John Whitmore</b> è uno dei Padri Fondatori del Coaching Moderno. Abbiamo voluto <b>rendergli omaggio</b> dedicandogli la prima versione di questo plugin 1.0.2</span>
  <img src="<?php echo plugin_dir_url( __FILE__ ) . 'includes/img/whitmore.svg'; ?>" style="width:35px;margin-right:4px;vertical-align:middle;cursor: default;"></a> iCoach Wordpress Plugin - Omaggio a: <b>John Whitmore</b> Ver. 1.0.2</div>
	<script type="text/javascript" src="<?php echo includes_url() . 'js/jquery/jquery-migrate.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/js/icoach-core.js'; ?>" async defer></script>
	<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/js/search.js'; ?>" async defer></script>
</div>
  <?php
 }
 function icoach_render_custom_page(){
   ?>
   <div class='mains_info'>
    <h2>Disattiva il Courtesy Link nel Footer</h2>
	<p>Se vuoi disabilitare il <b>Courtesy Backlink</b> nel footer del tuo sito spostati nell'area <br>Aspetto / Personalizza e seleziona il Tab <b>Disabilita Link nel Footer</b>. Disabilita link e salva.</p>
	<a class="sett-but" href="customize.php?return=%2Fwp-admin%2Fadmin.php%3Fpage%3Dicoach-wp%252Ficoach.php%252FOpzioni">Vai alle Impostazioni di Personalizzazione</a>
	<div style="inline-block;margin-top:30px;">
	<img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/screen01.jpg'; ?>" style="width:295px;margin-right:12px;box-shadow: 0px 0px 20px #9e9e9e;">
	<img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/screen02.jpg'; ?>" style="width:295px;margin-right:12px;box-shadow: 0px 0px 20px #9e9e9e;">
	<img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/screen03.jpg'; ?>" style="width:295px;margin-right:12px;box-shadow: 0px 0px 20px #9e9e9e;">
	</div>
   </div>
   <?php
 }
 function icoach_render_about_page(){
   ?>
   <div class='mains_info'>
    <h2>Cos'è iCoach?</h2>
	<p>iCoach è un motore di ricerca termini di coaching, pnl e crescita personale. Un motore di ricerca che include decine e decine di termini con link di approfondimento, video e audio. iCoach sarà sempre aggiornato nel tempo dallo staff di Prometeo Coaching®.</p>
	<h2>iCoach è Gratuito?</h2>
	<p>iCoach è Gratis e lo sarà sempre! Nessuna pubblicità, nessuna scadenza, nessun limite. Prometeo Coaching®, leader nel mercato del coaching, investe costantemente nella crescita e la formazione dei propri Allievi Coach e per questo che iCoach è un prodotto totally free!.</p>
	<h2>Perchè Utilizzare iCoach?</h2>
	<p>Semplice! Se sei un Coach Professionista o sei semplicemente interessato al tema del coaching, della pnl o della crescita personale icoach può aiutarti nella comprensione della terminologia utilizzata in queste discipline. Studiare, crescere e migliorarsi con icoach è semplice! iCoach è un motore da interrogare quando si hanno dei dubbi sul significato di uno specifico termine. Con gli approfondimenti testuali e video potrai implementare il tuo bagaglio da professionista in ogni momento.</p>
	<h2>Come Utilizzare iCoach?</h2>
	<p>E' semplice! inserisci la parola chiave che stai cercando su iCoach e ottieni una spiegazione professionale con approfondimenti audio, video e testuali. iCoach verrà integrato nel tempo con nuovi termini. Un glossario ricchissimo di terminologie sul Coaching e la Pnl.</p>
	<h2>Dove Trovare iCoach?</h2>
	<p>iCoach App è disponibile come estensione del browser Google Chrome e lo puoi trovare sul Chrome Web Store, installarlo ed averlo sempre disponibile mentre navighi. Puoi installare iCoach anche sul tuo Sito in Wordpress cercandolo nel Plugin Store di Wordpress. Inoltre puoi consultarlo online su scuoladicoaching.net. Sarà presto integrato anche nell'applicazione ufficiale di Prometeo Coaching® FreeCoach per iOS e Android.</p>
	<a href="https://chrome.google.com/webstore/detail/icoach-il-motore-di-ricer/ambabnanecfabkagdlajogfckdkojicm?hl=it" class="sett-but" target="_blank" rel="noopener">iCoach Browser Chrome</a> <a href="https://wordpress.org/plugins/icoach-motore-di-ricerca-sul-coaching/" class="sett-but" target="_blank" rel="noopener">iCoach Plugin Wp</a> <a href="https://www.scuoladicoaching.net/Search/" class="sett-but" target="_blank">iCoach Online</a>
   </div>
   <?php
 }

 
 add_action('admin_menu','icoach_topmenu');
 
 
 
// iCoach Prometeo Coaching ® - Gestisci la Pagina Opzioni con salvataggio
class icfootlinks
{
    // Array dei temi e classi da nascondere.
    private $themes = array(
        'sdv' => array('section.second-footer .front-link', false),
        'accesspress-root' => array('section.second-footer .front-link', false),
		'miriamdignaziotema' => array('section.second-footer .front-link', false),
		'salient' => array('section.second-footer .front-link', false),
		'jupiter' => array('section.second-footer .front-link', false),		
        'adelle' => array('section.second-footer .front-link', false),
        'aldehyde' => array('section.second-footer .front-link', false),
        'astrid' => array('section.second-footer .front-link', false),
        'avenue' => array('section.second-footer .front-link', false),
        'base-wp' => array('section.second-footer .front-link', false),
        'basic' => array('section.second-footer .front-link', false),
        'bwater' => array('section.second-footer .front-link', false),
        'chinese-restaurant' => array('section.second-footer .front-link', false),
        'colormag' => array('section.second-footer .front-link', false),
        'contango' => array('section.second-footer .front-link', true),
        'coraline' => array('section.second-footer .front-link', false),
        'decode' => array('section.second-footer .front-link', false),
        'displace' => array('section.second-footer .front-link', false),
        'duster' => array('section.second-footer .front-link', false),
        'dw-minion' => array('section.second-footer .front-link', false),
        'maxstore' => array('section.second-footer .front-link', false),
        'editor' => array('section.second-footer .front-link', false),
        'elucidate' => array('section.second-footer .front-link', false),
        'enough' => array('section.second-footer .front-link', false),
        'esquire' => array('section.second-footer .front-link', false),
        'esteem' => array('section.second-footer .front-link', false),
        'exray' => array('section.second-footer .front-link', false),
        'fictive' => array('section.second-footer .front-link', false),
        'flat' => array('section.second-footer .front-link', true),
        'flaton' => array('section.second-footer .front-link', false),
        'forever' => array('section.second-footer .front-link', false),
        'govpress' => array('section.second-footer .front-link', false),
        'graphy' => array('section.second-footer .front-link', false),
        'iconic-one' => array('section.second-footer .front-link', false),
        'illdy' => array('section.second-footer .front-link', false),
        'isola' => array('section.second-footer .front-link', false),
        'minimize' => array('section.second-footer .front-link', false),
        'modernize' => array('section.second-footer .front-link', false),
        'monaco' => array('section.second-footer .front-link', false),
        'motif' => array('section.second-footer .front-link', false),
        'olsen-light' => array('section.second-footer .front-link', false),
        'omega' => array('section.second-footer .front-link', true),
        'onepress' => array('section.second-footer .front-link', false),
        'origami' => array('section.second-footer .front-link', false),
        'padhang' => array('section.second-footer .front-link', false),
        'parament' => array('section.second-footer .front-link', false),
        'pilcrow' => array('section.second-footer .front-link', false),
        'pink-touch-2' => array('section.second-footer .front-link', false),
        'prana' => array('section.second-footer .front-link', false),
        'quark' => array('section.second-footer .front-link', true),
        'responsivo' => array('section.second-footer .front-link', false),
        'shop-isle' => array('section.second-footer .front-link', false),
        'spacious' => array('section.second-footer .front-link', false),
        'sparkling' => array('section.second-footer .front-link', false),
        'startup' => array('section.second-footer .front-link', false),
        'storefront' => array('section.second-footer .front-link', false),
        'sydney' => array('section.second-footer .front-link', false),
        'suffusion' => array('section.second-footer .front-link', false),
        'sugar-and-spice' => array('section.second-footer .front-link', false),
        'syntax' => array('section.second-footer .front-link', false),
        'twentyeleven' => array('section.second-footer .front-link', false),
        'twentyfourteen' => array('section.second-footer .front-link', false),
        'twentysixteen' => array('section.second-footer .front-link', false),
        'twentyten' => array('section.second-footer .front-link', false),
        'twentythirteen' => array('section.second-footer .front-link', false),
        'twentyseventeen' => array('section.second-footer .front-link', false),
        'twentytwelve' => array('section.second-footer .front-link', false),
        'vega' => array('div.footer .copyright', false),
        'unite' => array('section.second-footer .front-link', false),
        'wilson' => array('section.second-footer .front-link', false),
        'zbench' => array('section.second-footer .front-link', false)
		);

    public function __construct()
    {
        add_action('generate_rewrite_rules', array(&$this, 'generateRewriteRules'));
        add_action('init', array(&$this, 'wpAdminInit'));
    }

    public function wpAdminInit()
    {
        if (current_user_can('edit_theme_options')) {
            add_action('customize_register', array(&$this, 'customizeRegister'));
        }

        add_action('wp_head', array(&$this, 'ic_customizecss'));
    }




    public function customizeRegister($wp_customize)
    {
        $wp_customize->add_section(
            'icoach_settings_section',
            array(
                'title' => __('Disabilita Link nel Footer', 'hide-footer-links'),
                'description' => __('Se vuoi disabilitare il courtesy backlink nel footer del tuo sito seleziona il campo disabilita link e salva.', 'hide-footer-links'),
                'priority' => 430,
            )
        );

        $wp_customize->add_setting(
            'icoach_options[hide-enabled]',
            array(
                'default' => '',
                'type' => 'option',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_setting(
            'icoach_options[hide-selector]',
            array(
                'default' => '',
                'type' => 'option',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_setting(
            'icoach_options[use-important]',
            array(
                'default' => false,
                'type' => 'option',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(
            'icoach_enable_hide_control',
            array(
                'label' => __('Disabilita Link', 'hide-footer-links'),
                'type' => 'checkbox',
                'section' => 'icoach_settings_section',
                'settings' => 'icoach_options[hide-enabled]',
            )
        );

       
    }


    public function ic_customizecss()
    {
        $opts = get_option('icoach_options', array('hide-enabled' => true));
        $hide = $opts['hide-enabled'];
        $use_important = '';
        $theme_stylesheet = wp_get_theme()->get_template();

        if (array_key_exists($theme_stylesheet, $this->themes)) {
            $css_selector = $this->themes[$theme_stylesheet][0];
            if ($this->themes[$theme_stylesheet][1] === true) {
                $use_important = '!important';
            }
        } else {
            $css_selector = $opts['hide-selector'];
            if ($opts['use-important'] == 1) {
                $use_important = '!important';
            }
        }

        if ($hide) {
            ?>
            <style type="text/css">
                <?php echo $css_selector; ?>
                {
                    visibility: hidden
                <?php echo $use_important; ?>
                ;
                }
            </style>
            <?php
        }
    }


    /**
     * @return string
     */
    private function pluginURL()
    {
        $url = wp_make_link_relative(plugin_dir_url(__FILE__));
        $url = ltrim($url, "/");
        return $url;
    }
}

// Inside WordPress
if (defined('ABSPATH')) {
    new icfootlinks;
}

// iCoach Prometeo Coaching ® - Genera un Widget Box nella Dashboard
class icoach_dashboard_widget {
	public function __construct() {
		add_action( 'wp_dashboard_setup', array( $this, 'add_dashboard_widget' ) );
	}
	public function add_dashboard_widget() {
		wp_add_dashboard_widget(
			'icoach_widget',
			__( '<img src="' . plugins_url( 'assets/images/logo_footer.svg', __FILE__ ) . '" class="menu-img"> iCoach', 'text_domain' ),
			array( $this, 'render_dashboard_widget' )
		);
	}
	public function render_dashboard_widget() {
		echo "<div class=\"dashbox\"><p>Sul tuo sito web è installato iCoach, il motore di ricerca definizioni di coaching sviluppato da Prometeo Coaching®. Consultalo e ottieni le spiegazioni delle definizioni che potrai usare nei tuoi articoli. Ricorda che iCoach sarà aggiornato nel tempo.<h4><b>Tutti i Numeri di iCoach:</b></h4><b><i class=\"fa fa-briefcase\" aria-hidden=\"true\" style=\"margin-right:4px;\"></i> Definizioni:</b> 86<br><b><i class=\"fa fa-play\" aria-hidden=\"true\" style=\"margin-right:4px;\"></i> Video:</b> 21<br><b><i class=\"fa fa-book\" aria-hidden=\"true\" style=\"margin-right:4px;\"></i> Articoli:</b> 86<br><b><i class=\"fa fa-download\" aria-hidden=\"true\" style=\"margin-right:4px;\"></i> Download:</b> 6</p><button class=\"botton-dash\"><a href=\"admin.php?page=icoach-wp%2Ficoach.php\"><i class=\"fa fa-search\" aria-hidden=\"true\"></i> Vai su iCoach</a></button><button class=\"botton-dash\"><a href=\"https://chrome.google.com/webstore/detail/icoach-il-motore-di-ricer/ambabnanecfabkagdlajogfckdkojicm?hl=it\" target=\"_blank\" rel=\"noopener\"><i class=\"fa fa-chrome\" aria-hidden=\"true\"></i> Scarica iCoach per Chrome</a></button></div>";
	}
}
new icoach_dashboard_widget;

// iCoach Prometeo Coaching ® - Inserisci un Link nel Footer
function icoach_put_link() {
wp_enqueue_style( 'ssc', plugins_url( 'assets/css/whitmore.css', __FILE__ ) );
	if ( is_front_page() ) {	
	echo '<section class="second-footer"><a href="https://www.prometeocoaching.it/scuola-di-coaching" class="front-link" target="_blank" rel="noopener" title="Scuola e Corsi di Coaching"><img src="' . plugins_url( 'assets/images/logo_footer.svg', __FILE__ ) . '" alt="Scuola e Corsi di Coaching" class="front-image">Scuola e Corsi di Coaching</a></section>';
    }
}
add_action( 'wp_footer', 'icoach_put_link', 1 );

// CODE
function add_allowed_origins($origins) {
    $origins[] = 'https://www.scuoladicoaching.net';
    return $origins;
}
add_filter('allowed_http_origins', 'add_allowed_origins');

/* FINE CODICE */

?>