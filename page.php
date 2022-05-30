<?php
get_header( )
?>

<div class="container-fluid d-flex justify-content-center">
<?php
            wp_nav_menu(array(
                'theme_location' => 'extra-menu',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<nav id="%1$s" class="navbar-nav d-flex flex-row justify-content-center %2$s">%3$s</nav>',
                'depth' => 2,
                'add_li_class'  => 'ms-5',
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>
</div>


<?php 
// the query
$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>2)); ?>
 
<?php if ( $wpb_all_query->have_posts() ) : ?>
 
<ul>
 
    <!-- the loop -->
    <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php endwhile; ?>
    <!-- end of the loop -->
 
</ul>
 
    <?php wp_reset_postdata(); ?>
 
<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>




<?php get_footer() ?>