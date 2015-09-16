<?php
/*
Template Name: Page - FAQS
*/
?>
<?php get_header(); ?>
<!--Start Top Section -->
<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<!-- Page Title
  ================================================== -->
  <div class="container clearfix">
      <div class="pagename sixteen columns fadeInUp animated">
          <h1><?php the_title(); ?>
          </h1>
      </div>
  </div>

  <?php endwhile; else :?>
  <!-- Else nothing found -->
  <h2><?php _e('Error 404 - Not found.', 'framework'); ?></h2>
  <p><?php _e("Sorry, but you are looking for something that isn't here.", 'framework'); ?></p>
  <!--BEGIN .navigation .page-navigation -->
<?php endif; ?>

<!-- Page Content
  ================================================== -->
<div class="container clearfix fadeInUp animated">
    <div class="eleven  blogwrap">

     <?php  // Grab the global ProperPagination and WP_Query instances
		global $pp, $wp_query, $wp;

		$counter = 1;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		// Construct the custom WP_Query instance
		$loop = new WP_Query( array( 'post_type' => 'faqs', 'paged' => $paged) );

	if ( function_exists('pp_has_pagination') ) :

		// Override the number of found posts on the ProperPagination instance
		$pp->found_posts = (int)$loop->found_posts;
		$pp->max_pages = ceil($pp->found_posts / $pp->posts_per_page);

		   if ($counter == 1) {
				// How many page links do we display at one time?
				$pp->max_page_links = min((int)get_option('pp_max_pagelinks'), $pp->max_pages);

				// Derive start and end values for the pagination links
				if ($pp->max_pages <= $pp->max_page_links) {
					// Start at the very beginning, end at the very end
					$pp->start = 1;
					$pp->end = $pp->max_pages;
				} else {
					$pp->start = max(1, $pp->page - floor($pp->max_page_links / 2));
					$pp->end = min($pp->max_pages, $pp->start + $pp->max_page_links - 1);
				}
			$counter++;
		   }
	endif;?>

  <ul class="one_half columns">
  <?php
  // wp_list_categories();
  $variable = wp_list_categories('echo=0&show_count=0&title_li=<h2>dfdfdfdfd</h2>');
  $variable = preg_replace('~\((\d+)\)(?=\s*+<)~', '$1', $variable);
  echo $variable;
  // echo "n<br>". "<pre>".print_r(get_categories($loop),1)."</pre>";
  ?>
  </ul>



  <section class="one_half column-last">
<?
// Loop through your posts...
while ( $loop->have_posts() ) : $loop->the_post();   ?>

        <div class="faqs">
            <div class="four_fifth column-last">
                <h2>
                    <a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>">
                        <?php the_title();?>
                    </a>
                </h2>

            	<?php global $more; $more = 0; ?>
                <?php the_content(__('Read more...', 'framework')); ?>
                <?php edit_post_link( __('Edit Post', 'framework'), '<div class="edit-post"><p>[', ']</p></div>' ); ?>
                <div class="clear"></div>

            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>

  <?php endwhile; ?>

</section>



<?php //echo "new line<br>". "<pre>".print_r($loop,1)."</pre>"; ?>










        <!--BEGIN .navigation .page-navigation -->
        <?php if ( function_exists('pp_has_pagination') ) : ?>
        <div class="pagination_container">
        <ul id="pagination">
            <!-- the previous page -->
            <?php pp_the_pagination(); if (pp_has_previous_page()) : ?>
            <li class="previous"> <a href="<?php pp_the_previous_page_permalink(); ?>" class="prev">&laquo;
                <?php _e('Previous', 'framework'); ?>
                </a></li>
            <?php else : ?>
            <li class="previous-off">&laquo;
                <?php _e('Previous', 'framework'); ?>
            </li>
            <?php endif; pp_rewind_pagination(); ?>
            <!-- the page links -->
            <?php while(pp_has_pagination()) : pp_the_pagination(); ?>
            <?php if (pp_is_current_page()) : ?>
            <li class="active">
                <?php pp_the_page_num(); ?>
            </li>
            <?php else : ?>
            <li><a href="<?php pp_the_page_permalink(); ?>">
                <?php pp_the_page_num(); ?>
                </a></li>
            <?php endif; ?>
            <?php endwhile; pp_rewind_pagination(); ?>
            <!-- the next page -->
            <?php pp_the_pagination(); if (pp_has_next_page()) : ?>
            <li class="next"> <a href="<?php pp_the_next_page_permalink(); ?>">
                <?php _e('Next', 'framework'); ?>
                &raquo;</a></li>
            <?php else : ?>
            <li class="next-off">
                <?php _e('Next', 'framework'); ?>
                &raquo;</span>
                <?php endif; pp_rewind_pagination(); ?>
        </ul>
        </div>
        <?php  else:  ?>

            <!-- Pagination
            ================================================== -->
            <div class="pagination">
                <?php
                    global $wp_query;

                    $big = 999999999; // need an unlikely integer

                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $wp_query->max_num_pages
                    ) );
                ?>
                <div class="clear"></div>
            </div> <!-- End pagination -->

		<?php endif; ?>
    </div>


    <div class="clear"></div>

</div>
<?php get_footer(); ?>
