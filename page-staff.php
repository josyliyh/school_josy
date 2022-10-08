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

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
	?>

		
		<?php

$terms = get_terms( 
    array(
        'taxonomy' => 'fwd-staff-category',
    ) 
);
if ( $terms && ! is_wp_error( $terms ) ) {
    foreach ( $terms as $term ) {
        $args = array(
			'post_type'      => 'fwd-staff',
			'posts_per_page' => -1,
			'order' => 'ASC',
			'orderby' => 'title',
			'tax_query'      => array(
				array(
					'taxonomy' => 'fwd-staff-category',
					'field'    => 'slug',
					'terms'    => $term->slug,
				),
			),
			
		);
		

		
		$query = new WP_Query( $args );
		
		if ( $query -> have_posts() ) : ?>
	
			<section class="Staff">
			<h2> <?php echo $term -> name; ?></h2>
		
<?php
	

	


	while ( $query -> have_posts() ) :
		$query -> the_post(); 

		if ( function_exists( 'get_field' ) ) {
			if ( get_field( 'courses' ) ) {
		?>
		<article>
				<h3 id="<?php the_ID() ?>"><?php the_title(); ?></h3>
			<p><?php the_field('short_staff_biography') ?></p>
			<p>Course(s): <?php the_field('courses') ?></p>
			<p><a href="<?php the_field('instructor_website') ?>">Instructor Website</a></p>

		</article>
		<?php
			}else {
				?>
		<article>
				<h3 id="<?php the_ID() ?>"><?php the_title(); ?></h3>
			<p><?php the_field('short_staff_biography') ?></p>
		

		</article>
		<?php
			}}
		
	endwhile;
	wp_reset_postdata();
	?>
</section>
<?php endif;

    }
}
				
?>
	</main><!-- #primary -->

<?php

get_footer();
