<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package Fameup
 */
get_header(); 
?>
<!--==================== Fameup breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!--==================== main content section ====================-->
		<!-- Blog Area -->
			<?php if( class_exists('woocommerce') && (is_account_page() || is_cart() || is_checkout())) { ?>
			<div class="col-md-12 bs-card-box padding-20">
			<?php if (have_posts()) {  while (have_posts()) : the_post(); ?>
			<?php the_content(); endwhile; } } else {?>
			<div class="col-md-9 col-sm-8">
				<div class="bs-card-box padding-20">
			<?php if( have_posts()) :  the_post(); ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>		
			<?php the_content(); ?>
			<?php endif; 
				while ( have_posts() ) : the_post();
				// Include the page
				the_content();
				comments_template( '', true ); // show comments
				
				endwhile;
			?>	
				</div>
			</div>
			<!--Sidebar Area-->
			<aside class="col-md-3 col-sm-4">
                 <?php get_sidebar();?>
            </aside>
			<?php } ?>
			<!--Sidebar Area-->
		</div>
<?php
get_footer();