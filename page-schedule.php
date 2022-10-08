<?php

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


<section class="table">

<table class="schedule">
						<caption>Weekly Course Schedule</caption>
						<thead>
							<tr>
								<th>Date</th>
								<th>Course</th>
								<th>Instructor</th>
							</tr>
						</thead>
					           
					
			<?php
					if ( function_exists('get_field')){

                            $rows = get_field('course');
                            if( $rows ) {
                                echo '<ul class="slides">';
                                foreach( $rows as $row ) {
                                    echo '<tr>';
                                    echo '<td>';
                                        echo wpautop( $row['date'] );
                                        echo '</td>';
                                        echo '<td>';
                                        echo wpautop( $row['course-name'] );
                                        echo '</td>';
                                        echo '<td>';
                                        echo wpautop( $row['instructor'] );
                                        echo '</td>';
                                    echo '</tr>';
                                }
                                echo '</ul>';
                            }
				
					}
				?>
                	</tbody> 
                </table>
			</section>
                </main>


<?php
get_sidebar();
get_footer();