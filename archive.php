<?php
get_header( )
?>

<div class="container-fluid d-flex justify-content-center">
    <h1>ARchive</h1>
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

<div class="container-fluid">

<article class="d-flex flex-column align-items-center col-8">

<?php $loop = new WP_Query( array( 'post_type' => array('news', 'post') ) );
while ($loop -> have_posts() ) {
$loop -> the_post(); ?>
<a class="nav-link post-title" href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
<?php the_content ();
}
?>
</article>


</div>


<?php get_footer() ?>