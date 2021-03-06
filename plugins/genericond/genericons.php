<?php
/*
Plugin Name: Genericon'd
Plugin URI: http://halfelf.org/
Description: Use the Genericon icon set within WordPress. Icons can be inserted using either HTML or a shortcode.
Version: 3.0.3.4
Author: Mika Epstein
Author URI: http://ipstenu.org/
Author Email: ipstenu@ipstenu.org
Credits:
     Forked plugin code from Rachel Baker's Font Awesome for WordPress plugin
     https://github.com/rachelbaker/Font-Awesome-WordPress-Plugin

License: MIT

  Copyright (C) 2013  Mika Epstein.

    This file is part of Genericon'd, a plugin for WordPress.

    The Genericon'd Plugin is free software: you can redistribute it and/or
    modify it under the terms of the GNU General Public License as published
    by the Free Software Foundation, either version 2 of the License, or
    (at your option) any later version.

    Genericons itself is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by the
    Free Software Foundation; either version 2 of the License, or (at your option)
    any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.


*/

class GenericonsHELF {

    static $gen_ver = '3.0.3.4'; // Plugin version so I can be lazy
    
    public function __construct() {
        add_action( 'init', array( &$this, 'init' ) );
    }

    public function init() {
        add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_styles' ) );
        add_shortcode( 'genericon', array( $this, 'setup_shortcode' ) );
        add_filter( 'widget_text', 'do_shortcode' );
        add_action( 'admin_menu', array( $this, 'add_settings_page'));
        add_filter('plugin_row_meta', array( $this, 'plugin_links'), 10, 2);
    }

    public function register_plugin_styles() {
        global $wp_styles;
        if ( wp_style_is('genericons', 'registered') == TRUE) {
            wp_dequeue_style( 'genericons' ); // This is to force other plugins and themes with older versions to STFUNOOB
            wp_deregister_style('genericons');
        }
        wp_enqueue_style( 'genericons', plugins_url( 'genericons/genericons.css', __FILE__ , '', self::$gen_ver ) );
        wp_enqueue_style( 'genericond', plugins_url( 'css/genericond.css', __FILE__ , '', self::$gen_ver ) );
    }

    function register_admin_styles() {
    	wp_register_style( 'genericondExampleStyles', plugins_url( 'css/example.css', __FILE__ , '', self::$gen_ver ) );
    	wp_register_script( 'genericondExampleJS', plugins_url( 'js/example.js', __FILE__ , array( 'jquery' ), self::$gen_ver ) );
    }

    function add_admin_styles() {
         wp_enqueue_style( 'genericondExampleStyles' );
         wp_enqueue_script( 'genericondExampleJS' );
    }

    // The Shortcode
    public function setup_shortcode( $params ) {
        $genericonatts = shortcode_atts( array(
                    'icon'   => '',
                    'size'   => '',
                    'color'  => '',
                    'rotate' => '',
                    'repeat' => '1'
                ), $params );

        // Resizing
        $genericon_size = "genericon-";
        if ( !empty($genericonatts['size']) && isset($genericonatts['size']) && in_array($genericonatts['size'], array('2x', '3x', '4x', '5x', '6x')) ) {
            $genericon_size .= $genericonatts['size'];
        }
        else {
            $genericon_size .= "1x";
        }

        // Color
        $genericon_color = "color:";
        if ( isset($genericonatts['color']) && !empty($genericonatts['color']) ) {
            $genericon_color .= $genericonatts['color'];
        }
        else {
            $genericon_color .= 'inherit';
        }
        $genericon_color .= ";";

        // Rotate
        if ( !empty($genericonatts['rotate']) && isset($genericonatts['rotate']) && in_array($genericonatts['rotate'], array('90', '180', '270', 'flip-horizontal', 'flip-vertical')) ) {
            $genericon_rotate = 'genericon-rotate-'.$genericonatts['rotate'];
        } else {
            $genericon_rotate = 'genericon-rotate-normal';
        }

        // Build the Genericon!
        $genericon_styles = $genericon_color; // In case I add more later? Hope I never have to, but...
        $genericon_code = '<i style="'.$genericon_styles.'" class="genericond genericon genericon-'.$genericonatts['icon'].' '.$genericon_size.' '.$genericon_rotate.'"></i>';
        $genericon = $genericon_code;

        // Repeat the genericon if needed
        for ($i = 2 ; $i <= $genericonatts['repeat']; ++$i) {
	        $genericon .= $genericon_code;
	    }

        return $genericon;
    }

    // Sets up the settings page
	public function add_settings_page() {
        $page = add_theme_page(__('Genericon\'d'), __('Genericon\'d'), 'edit_posts', 'genericons', array($this, 'settings_page'));
        add_action( 'admin_print_styles-' . $page, array( $this, 'add_admin_styles') );
    	}

    // Content of the settings page
 	function settings_page() {
		?>
		<div class="wrap">

        <h2>Genericon'd <?php echo self::$gen_ver; ?> Usage</h2>

    	<div id="primary">
    		<div id="content">
    			<div id="glyph">
    			</div>

    			<div class="description">
    			    <p><a href="http://genericons.com">Genericons</a> are vector icons embedded in a webfont designed to be clean and simple keeping with a generic aesthetic. You can use them for instant HiDPI, to change icon colors on the fly, or with CSS effects such as drop-shadows or gradients.</p>
    			    
                    <p>Genericons can be displayed via one of the following methods:
                    <br />Shortcodes: <code>&#091;genericon icon=twitter&#093;</code>
                    <br />HTML:<code>&lt;i alt="f202" class="genericond genericon genericon-twitter"&gt;&lt;/i&gt;</code></p>
                    <p><strong>Shortcode Examples</strong>:
                    <br />Color Change: <code>&#091;genericon icon=twitter color=#4099FF&#093;</code>
                    <br />Increase size: <code>&#091;genericon icon=facebook size=4x&#093;</code>
                    <br />Repeat icon: <code>&#091;genericon icon=star repeat=3&#093;</code>
                    <br />Flip icon: <code>&#091;genericon icon=twitter rotate=flip-horizontal&#093;</code></p>
    			</div>

    		</div>
    	</div>

				<div id="icons">
			<div id="iconlist">

			<!-- note, the text inside the HTML elements is purely for the seach -->

			<!-- post formats -->
			<div alt="f100" class="genericon genericon-standard">standard post</div>
			<div alt="f101" class="genericon genericon-aside">aside</div>
			<span class="update"><div alt="f102" class="genericon genericon-image">image</div></span>
			<div alt="f103" class="genericon genericon-gallery">gallery</div>
			<div alt="f104" class="genericon genericon-video">video</div>
			<div alt="f105" class="genericon genericon-status">status</div>
			<span class="update"><div alt="f106" class="genericon genericon-quote">quote</div></span>
			<div alt="f107" class="genericon genericon-link">link</div>
			<div alt="f108" class="genericon genericon-chat">chat</div>
			<div alt="f109" class="genericon genericon-audio">audio</div>

			<!-- social icons -->
			<div alt="f200" class="genericon genericon-github">github</div>
			<div alt="f201" class="genericon genericon-dribbble">dribbble</div>
			<div alt="f202" class="genericon genericon-twitter">twitter</div>
			<div alt="f203" class="genericon genericon-facebook">facebook</div>
			<div alt="f204" class="genericon genericon-facebook-alt">facebook</div>
			<div alt="f205" class="genericon genericon-wordpress">wordpress</div>
			<div alt="f206" class="genericon genericon-googleplus">google plus googleplus google+ +</div>
			<span class="update"><div alt="f207" class="genericon genericon-linkedin">linkedin</div></span>
			<div alt="f208" class="genericon genericon-linkedin-alt">linkedin</div>
			<div alt="f209" class="genericon genericon-pinterest">pinterest</div>
			<div alt="f210" class="genericon genericon-pinterest-alt">pinterest</div>
			<div alt="f211" class="genericon genericon-flickr">flickr</div>
			<div alt="f212" class="genericon genericon-vimeo">vimeo</div>
			<div alt="f213" class="genericon genericon-youtube">youtube</div>
			<div alt="f214" class="genericon genericon-tumblr">tumblr</div>
			<div alt="f215" class="genericon genericon-instagram">instagram</div>
			<div alt="f216" class="genericon genericon-codepen">codepen</div>
			<div alt="f217" class="genericon genericon-polldaddy">polldaddy</div>
			<div alt="f218" class="genericon genericon-googleplus-alt">google plus googleplus google+ +</div>
			<div alt="f219" class="genericon genericon-path">path</div>
			<div alt="f220" class="genericon genericon-skype">skype</div>
			<div alt="f221" class="genericon genericon-digg">digg</div>
			<div alt="f222" class="genericon genericon-reddit">reddit</div>
			<div alt="f223" class="genericon genericon-stumbleupon">stumbleupon</div>
			<div alt="f224" class="genericon genericon-pocket">pocket</div>
			<span class="new"><div alt="f225" class="genericon genericon-dropbox">dropbox</div></span>

			<!-- meta icons -->
			<div alt="f300" class="genericon genericon-comment">comment</div>
			<div alt="f301" class="genericon genericon-category">category</div>
			<div alt="f302" class="genericon genericon-tag">tag label</div>
			<div alt="f303" class="genericon genericon-time">time clock</div>
			<div alt="f304" class="genericon genericon-user">user</div>
			<div alt="f305" class="genericon genericon-day">day</div>
			<div alt="f306" class="genericon genericon-week">week</div>
			<div alt="f307" class="genericon genericon-month">month calendar</div>
			<div alt="f308" class="genericon genericon-pinned">pinned</div>

			<!-- other icons -->
			<div alt="f400" class="genericon genericon-search">search</div>
			<div alt="f401" class="genericon genericon-unzoom">unzoom</div>
			<div alt="f402" class="genericon genericon-zoom">zoom</div>
			<div alt="f403" class="genericon genericon-show">show</div>
			<div alt="f404" class="genericon genericon-hide">hide</div>
			<div alt="f405" class="genericon genericon-close">close</div>
			<div alt="f406" class="genericon genericon-close-alt">close</div>
			<div alt="f407" class="genericon genericon-trash">trash trashcan</div>
			<div alt="f408" class="genericon genericon-star">star like</div>
			<div alt="f409" class="genericon genericon-home">home house</div>
			<div alt="f410" class="genericon genericon-mail">mail</div>
			<div alt="f411" class="genericon genericon-edit">edit</div>
			<div alt="f412" class="genericon genericon-reply">reply</div>
			<div alt="f413" class="genericon genericon-feed">feed rss</div>
			<span class="update"><div alt="f414" class="genericon genericon-warning">warning alert</div></span>
			<span class="update"><div alt="f415" class="genericon genericon-share">share social</div></span>
			<div alt="f416" class="genericon genericon-attachment">attachment</div>
			<div alt="f417" class="genericon genericon-location">location gps</div>
			<div alt="f418" class="genericon genericon-checkmark">checkmark</div>
			<div alt="f419" class="genericon genericon-menu">menu hamburger</div>
			<div alt="f420" class="genericon genericon-refresh">refresh reload</div>
			<div alt="f421" class="genericon genericon-minimize">minimize</div>
			<div alt="f422" class="genericon genericon-maximize">maximize</div>
			<!-- hide this easter egg <div alt="f423" class="genericon genericon-404"></div> -->
			<span class="update"><div alt="f424" class="genericon genericon-spam">spam block report</div></span>
			<div alt="f425" class="genericon genericon-summary">summary checklist</div>
			<div alt="f426" class="genericon genericon-cloud">cloud</div>
			<div alt="f427" class="genericon genericon-key">key lock secure</div>
			<div alt="f428" class="genericon genericon-dot">dot</div>
			<div alt="f429" class="genericon genericon-next">next arrow right</div>
			<div alt="f430" class="genericon genericon-previous">previous arrow left</div>
			<div alt="f431" class="genericon genericon-expand">expand up</div>
			<div alt="f432" class="genericon genericon-collapse">collapse down</div>
			<div alt="f433" class="genericon genericon-dropdown">dropdown</div>
			<div alt="f434" class="genericon genericon-dropdown-left">dropdown</div>
			<div alt="f435" class="genericon genericon-top">top up</div>
			<div alt="f436" class="genericon genericon-draggable">draggable</div>
			<div alt="f437" class="genericon genericon-phone">phone</div>
			<div alt="f438" class="genericon genericon-send-to-phone">send to phone</div>
			<div alt="f439" class="genericon genericon-plugin">plugin</div>
			<div alt="f440" class="genericon genericon-cloud-download">cloud download</div>
			<div alt="f441" class="genericon genericon-cloud-upload">cloud upload</div>
			<div alt="f442" class="genericon genericon-external">external link</div>
			<div alt="f443" class="genericon genericon-document">document page</div>
			<div alt="f444" class="genericon genericon-book">book</div>
			<div alt="f445" class="genericon genericon-cog">cog configure settings</div>
			<div alt="f446" class="genericon genericon-unapprove">unapprove</div>
			<div alt="f447" class="genericon genericon-cart">cart shop</div>
			<div alt="f448" class="genericon genericon-pause">pause</div>
			<div alt="f449" class="genericon genericon-stop">stop</div>
			<div alt="f450" class="genericon genericon-skip-back">skip back</div>
			<div alt="f451" class="genericon genericon-skip-ahead">skip ahead</div>
			<div alt="f452" class="genericon genericon-play">play</div>
			<div alt="f453" class="genericon genericon-tablet">tablet</div>
			<div alt="f454" class="genericon genericon-send-to-tablet">send to tablet</div>
			<span class="update"><div alt="f455" class="genericon genericon-info">info</div></span>
			<span class="update"><div alt="f456" class="genericon genericon-notice">notice</div></span>
			<span class="update"><div alt="f457" class="genericon genericon-help">help</div></span>
			<div alt="f458" class="genericon genericon-fastforward">fastforward arrow</div>
			<div alt="f459" class="genericon genericon-rewind">rewind arrow</div>
			<div alt="f460" class="genericon genericon-portfolio">portfolio</div>
			<div alt="f461" class="genericon genericon-heart">heart like</div>
			<div alt="f462" class="genericon genericon-code">code wysiwyg</div>
			<div alt="f463" class="genericon genericon-subscribe">subscribe follow</div>
			<div alt="f464" class="genericon genericon-unsubscribe">unsubscribe unfollow</div>
			<div alt="f465" class="genericon genericon-subscribed">unsubscribed unfollowed</div>
			<div alt="f466" class="genericon genericon-reply-alt">reply all</div>
			<div alt="f467" class="genericon genericon-reply-single">reply single</div>
			<div alt="f468" class="genericon genericon-flag">flag alert</div>
			<div alt="f469" class="genericon genericon-print">print</div>
			<div alt="f470" class="genericon genericon-lock">lock secure</div>
			<div alt="f471" class="genericon genericon-bold">bold wysiwyg</div>
			<div alt="f472" class="genericon genericon-italic">italic wysiwyg</div>
			<div alt="f473" class="genericon genericon-picture">picture wysiwyg</div>
			<span class="new"><div alt="f474" class="genericon genericon-fullscreen">fullscreen maximize wysiwyg</div></span>

			<!-- generic shapes -->
			<div alt="f500" class="genericon genericon-uparrow">up arrow</div>
			<div alt="f501" class="genericon genericon-rightarrow">right arrow</div>
			<div alt="f502" class="genericon genericon-downarrow">down arrow</div>
			<div alt="f503" class="genericon genericon-leftarrow">left arrow</div>


			</div>
		</div>
		<div id="temp"></div>

        <p>Need more examples? Check out <a href="<?php echo plugins_url( 'genericons/example.html', __FILE__); ?>">the official Genericons Examples</a> or <a href="http://wordpress.org/plugins/genericond/faq/">the Genericon'd FAQ</a>.</p>

        </div>
        <?php
	}

    // donate link on manage plugin page
    public function plugin_links($links, $file) {
        if ($file == plugin_basename(__FILE__)) {
                $donate_link = '<a href="https://store.halfelf.org/donate/">Donate</a>';
				$settings_link = '<a href="' . admin_url( 'themes.php?page=genericons' ) . '">' . __( 'Settings' ) . '</a>';
                $links[] = $settings_link.' | '.$donate_link;
        }
        return $links;
    }
}

new GenericonsHELF();