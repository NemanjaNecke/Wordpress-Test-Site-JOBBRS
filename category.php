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

<div class="container-fluid">

<article class="d-flex flex-column align-items-center col-8">
<?php 
// Check if there are any posts to display
if ( have_posts() ) : ?>

<?php while ( have_posts() ) : the_post(); ?>
<a class="nav-link post-title" href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
<small><?php the_time('F jS, Y') ?>  <?php the_author_posts_link() ?></small>
 
<div class="entry">
<?php the_content(); ?>
 
 <p class="postmetadata"><?php
  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments closed');
?></p>
</div>
 
<?php endwhile; 
 
else: ?>
<p>Sorry, no posts matched your criteria.</p>
 
 
<?php endif; ?>
</div>
</div>


<?php get_footer() ?>