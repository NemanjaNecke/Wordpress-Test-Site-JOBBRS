<?php get_header( );?>
<main class="container-fluid p-0">
<div class="container-fluid p-0 ">
    <?php
            wp_nav_menu(array(
                'theme_location' => 'extra-menu',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<nav id="%1$s" class="navbar-nav page-nav %2$s">%3$s</nav>',
                'depth' => 2,
                'add_li_class'  => 'ms-5',
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>
</div>
<?php if (have_posts(  )) : while (have_posts(  )) : the_post(  ); ?>
<?php get_sidebar(); ?>
<?php endwhile; else : ?>
<?php endif; ?>
</main>
<?php get_footer(); ?>
