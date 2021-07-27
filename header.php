<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" <?php language_attributes(); ?>>
<head>
    	
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">	
	<script>
	//CTRL+C E CTRL+V
		function addLink(e) {
			var nAgt = navigator.userAgent;
			var nameOffset,verOffset,ix;
			if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {

			}else{
				e.preventDefault();
				var url = window.location.href.toString();
				var copyright = ' - Leia mais em ' + window.location.href.toString();
				var novoTexto = copytext = window.getSelection() + copyright;
				(window.clipboardData ? window : event).clipboardData.setData('Text', copytext);		
			}   
		}
		window.addEventListener('copy', addLink);
	</script>

    <?php wp_head(); ?>
	<link rel='stylesheet' id='themeton-stylesheet-css'  href='http://colabone.com.br/wp-content/uploads/themeton/katharine.css?ver=5.1.1' type='text/css' media='all' />
	
	<!-- Global site tag (gtag.js) - Google Analytics --> <script async src="https://www.googletagmanager.com/gtag/js?id=UA-140097419-1"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'UA-140097419-1'); </script>
</head>

<body <?php body_class(); ?>>

    <div id="loader-container" class="loader">
        <div class="loader-inner ball-beat">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div class="wrapper">
        
        <?php
        $header_layout = TT::get_mod('header_layout');
        global $hlayout;
        $header_layout = !empty($hlayout) ? $hlayout : $header_layout;
        switch($header_layout){
        	case 'menu_above_logo':
        		get_template_part('layouts/header', 'menu-above-logo');
        		break;
    		case 'menu_full':
        		get_template_part('layouts/header', 'menu-full-bg');
        		break;
    		case 'menu_top_center':
        		get_template_part('layouts/header', 'menu-top-center');
        		break;
    		case 'menu_top_left':
        		get_template_part('layouts/header', 'menu-top-left');
        		break;
    		default:
    			// menu_below_logo
    			get_template_part('layouts/header', 'menu-below-logo');
    			break;
        }
        ?>