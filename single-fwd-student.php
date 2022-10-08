<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">
	<?php
		while ( have_posts() ) :
			the_post();
		

			get_template_part( 'template-parts/content', 'single-student' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		
	?>


<h3>Meet other Designer students:</h3>
    <?php

	


//get the post's venues
$custom_terms = wp_get_post_terms($post->ID, 'fwd-student-category');

if( $custom_terms ){

// going to hold our tax_query params
$tax_query = array();



// loop through venus and build a tax query
foreach( $custom_terms as $custom_term ) {

	$tax_query[] = array(
		'taxonomy' => 'fwd-student-category',
		'field' => 'slug',
		'terms' => $custom_term->slug,
	);

}

// put all the WP_Query args together
$args = array( 'post_type' => 'fwd-student',
				'posts_per_page' => -1,
				'tax_query' => $tax_query );

// finally run the query
$loop = new WP_Query($args);

if( $loop->have_posts() ) {

	while( $loop->have_posts() ) : $loop->the_post(); ?>
	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>     
	<?php 

	endwhile;

}

wp_reset_query();

}


get_sidebar();
get_footer();
