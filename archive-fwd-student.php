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
<h1 class="page-tittle"> The Class </h1>
<section class="students">
<?php

//NOT TO USE GET TERMS



			

		$args = array(
			'post_type' 	=> 'fwd-student',
			'post_per-page' => -1,
			'order' => 'ASC',
			'orderby' => 'title',
		);

		$query = new WP_Query($args);

		

		if ($query->have_posts()){
			
			while($query->have_posts()){
		
				$query->the_post();
				
				?>
				<article>
				<a href="<?php the_permalink(); ?>">
						<h3><?php the_title(); ?></h3>
					</a>
                    <?php the_post_thumbnail('all-student-featured');?>
					<?php the_excerpt();?>
				
					<p> Specialty: <?php  
					
					$terms = wp_get_post_terms($post->ID, 'fwd-student-category' );
					foreach ( $terms as $term ) {

						echo '<a href="'.get_term_link($term->slug, 'fwd-student-category').'">'.$term->name.'</a>';
					}?>
					</p>
				</article>
				<?php
				}
			}
		
			wp_reset_postdata();
			echo'</section>';
		
	
		?>

		
		</section>
	</main><!-- #primary -->

<?php

get_footer();
