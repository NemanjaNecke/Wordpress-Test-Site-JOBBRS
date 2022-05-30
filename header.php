<!DOCTYPE html>
<html <?php language_attributes(); ?> >
        <head>
            <meta charset="<?php bloginfo('charset'); ?>">
            <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
            <meta name="viewport" content="width=device-width">
            <meta name = "format-detection" content = "telephone=no">
            <link rel="profile" href="http://gmpg.org/xfn/11">
            <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
            <!--[if lt IE 9]>
            <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
            <![endif]-->
            <?php wp_head(); ?>
        </head>
    <body <?php body_class(); ?>>
    <div class='container-fluid p-0' id='page'>
    <header class='container-fluid p-0 header'> 
    <?php if ( get_header_image() ) : ?>
        <img src="<?php header_image(); ?>" 
             width="<?php echo absint( get_custom_header()->width ); ?>" 
             height="<?php echo absint( get_custom_header()->height ); ?>" 
             alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
       
    <?php endif; ?>
    <nav class='navbar navbar-expand-lg navbar-dark navbar-nav fixed-top mt-1' id='defnav'>
            <div class="container ms-auto me-5 d-flex">
                <a class="navbar-brand fs-6 text-primary d-flex align-items-center" href="<?php echo esc_url(home_url('/')); ?>" rel='home'>
               <?php $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
 
                    if ( has_custom_logo() ) {
                        echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                    } else {
                        echo '<p class="mb-0"> LOGO </p>';
                    } 
                ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'bootstrap-menu',
                        'container' => false,
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="navbar-nav mb-2 mb-md-0 %2$s">%3$s</ul>',
                        'depth' => 2,
                        'add_li_class'  => 'ms-4 pe-2',
                        'walker' => new bootstrap_5_wp_nav_menu_walker()
                    ));
                ?>
                </div>
            </div>
        </nav>
        <div class="title d-flex text-white flex-column align-items-center justify-content-center mt-4">
            <h1 class='fw-bold display-2'>Test Blog</h1>
            <h4 class='fw-light'>News on Modern Video Streaming</h4>
        </div>
            
    </header>

    