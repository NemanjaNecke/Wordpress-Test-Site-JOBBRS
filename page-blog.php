<?php
get_header( );
?>

<div class="container-fluid d-flex flex-column justify-content-center">
    <header class="d-flex justify-content-even flex-column align-items-center">
   <?php
            wp_nav_menu(array(
                'theme_location' => 'extra-menu',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<nav id="%1$s" class="navbar-nav page-nav %2$s">%3$s</nav>',
                'depth' => 2,
                'add_li_class'  => 'px-2 mt-4 pb-3 hover',
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>    
            <hr class="w-75 my-0"> 
    </header>

<section class="row">
    <div class="col-sm-8">
        <article class="d-flex flex-column align-items-center mt-3 mx-auto w-50">

<?php $loop = new WP_Query( array( 'post_type' => array('news', 'post') ) );
while ($loop -> have_posts() ) {
$loop -> the_post(); ?>
<a class="nav-link post-title" href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
<small><?php the_time('F jS, Y') ?>  <?php the_author_posts_link() ?></small>
<?php the_excerpt(  );
}
?>
</article>
    </div>

<div class="col-sm-4">
<?php get_sidebar(); ?>
</div>    
</section>


 </div>

<?php get_footer() ;?>