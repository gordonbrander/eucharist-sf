<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
<title><?php eusf_the_page_title(); ?></title>
<meta charset="<?php bloginfo('charset'); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="container" class="container">
	<header id="header">
        <h1 id="logo">
            <a href="<?php bloginfo('url'); ?>" rel="home">
                <img src="<?php echo EUSF_URL ?>assets/img/logo.png"
                     alt="Eucharist: a Jesus Community"
                     width="540"
                     height="115" />
            </a>
        </h1>
        <nav class="nav nav--primary">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => '',
                'fallback_cb' => '',
                'depth' => 2
            ))
            ?>
        </nav>
	</header>