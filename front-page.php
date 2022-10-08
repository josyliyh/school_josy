<?php
/**
 * The template for displaying the home page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>
 	<main id="primary" class="site-main">
<section class="home-intro">
				<?php 
				// Load the intro section from a separate page using WP_Query
				// The page_id is the ID of the About page, where we added text
				$args = array( 'page_id' => 19 );

				$intro_query = new WP_Query($args);			
				
				if ($intro_query -> have_posts()){
					while ($intro_query -> have_posts()) {
						$intro_query -> the_post();
						the_content();
					}
					wp_reset_postdata();
				}
				?>

			</section>
		<section class="home-wrap">
			<section class="home-left">
				<?php
				if ( function_exists('get_field')){
					if (get_field('left_section_title')){
						echo '<h2>';
						the_field( 'left_section_title' );
						echo '</h2>';
					}
					if (get_field('left_section_text')){
						echo '<p>';
						the_field( 'left_section_text' );
						echo '</p>';
					}
				}
				?>

			</section>
			
			<section class="home-right">
			<?php
					if ( function_exists('get_field')){
						if (get_field('right_section_title')){
							echo '<h2>';
							the_field( 'right_section_title' );
							echo '</h2>';
						}
						if (get_field('right_section_text')){
							echo '<p>';
							the_field( 'right_section_text' );
							echo '</p>';
						}
					}
				?>
			</section>
		</section>
		<h2><?php esc_html_e('Recent News');?></h2>
<section class="home-blog">
				
				<?php
				$args = array(
					'post_type' 		=> 'post',
					'posts_per_page'	=> '3'
				);
				$blog_query = new WP_Query ($args);
				if ($blog_query -> have_posts()) {
					while ($blog_query -> have_posts()){
						$blog_query ->the_post();
						?>
						<article>
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('all-student-featured'); ?>
								<h3><?php the_title(); ?></h3>
							</a>
						</article>
						<?php
					}
					wp_reset_postdata();
				} 
				?>
			</section>
			</main>