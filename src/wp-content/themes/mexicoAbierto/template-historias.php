<?php
/*
Template Name: Historias
*/
?>
<?php get_header(); ?>
<!-- Site Tagline
================================================== -->

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="container clearfix ">
    <div class="sixteen columns intro fadeInDown animated">
    <h2 class="aligncenter">  <?php the_title(); ?></h2>
    </div>
    <div class="clear"></div>
    <div class="divider nomargin"></div>
</div>
<?php endwhile; endif;?>




<!-- Primary Page Layout
================================================== -->
<div class=" fadeInUp animated">

<?php $filter = (get_option('of_filter_action')) ? get_option('of_filter_action') : 'Fade'; ?>

<?php if ( $homepagenumber = get_option('of_homepage_number') ) { echo '<!--'.$homepagenumber.' Projects -->'; } else { $homepagenumber = 30;} ?>
<?php $loop = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $homepagenumber ) ); $counter = 1; ?>

<?php
$term_list = array();

// Get only terms from these posts
while ($loop->have_posts()) : $loop->the_post();
  $term_list = array_merge($term_list, wp_get_post_terms($post->ID, 'sort', array("fields" => "ids")));
endwhile;

// Remove Duplicates and convert to string
$term_list = implode(',', array_unique($term_list));
?>


    <!-- Filter Portfolio Items
================================================== -->

<?php
$term_list = array();

// Get only terms from these posts
while ($loop->have_posts()) : $loop->the_post();
  $term_list = array_merge($term_list, wp_get_post_terms($post->ID, 'sort', array("fields" => "ids")));
endwhile;

// Remove Duplicates and convert to string
$term_list = implode(',', array_unique($term_list));
?>

<div class="container clearfix">
    <div class="sixteen columns alpha">
        <ul class="filter <?php echo ($filter == 'Fade') ? 'filterfade' : 'filtershuffle'; ?>">
            <li class="active"><a href="#" class="filterall" data-value="*"> <?php _e('All', 'framework'); ?></a></li>
            <?php wp_list_categories(array('include' => $term_list, 'title_li' => '', 'taxonomy' => 'sort', 'show_option_none'   => '', 'walker' => new Walker_Portfolio_Filter())); ?>
        </ul>
    </div>
    <div class="clear"></div>
</div>
<div class="container clearfix homecontent">



    <?php
        while ( $loop->have_posts() ) : $loop->the_post();

      $post_url = get_permalink(); //Get Permalink for post
      $terms = get_the_terms( get_the_ID(), 'sort' );

       $thumb = get_post_meta($post->ID,'_thumbnail_id',false); $thumb = wp_get_attachment_image_src($thumb[0], 'portfoliosmall', false);  // URL of Featured Full Image
         $thumb2 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'second-slide', $post->ID); $thumb2 = wp_get_attachment_image_src($thumb2, 'portfoliosmall', false); // URL of Second Slide Full Image
           $thumb3 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'third-slide', $post->ID); $thumb3 = wp_get_attachment_image_src($thumb3, 'portfoliosmall', false); // URL of Third Slide Full Image
           $thumb4 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'fourth-slide', $post->ID); $thumb4 = wp_get_attachment_image_src($thumb4, 'portfoliosmall', false); // URL of Fourth Slide Full Image
           $thumb5 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'fifth-slide', $post->ID); $thumb5 = wp_get_attachment_image_src($thumb5, 'portfoliosmall', false); // URL of Fifth Slide Full Image
           $thumb6 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'sixth-slide', $post->ID); $thumb6 = wp_get_attachment_image_src($thumb6, 'portfoliosmall', false); // URL of Sixth Slide Full Image
    ?>






  <?php

  ?>

  <div class="four columns widget news-widget-item">
    <div class="homeblogitem">
      <div class="homeblogimage">

          <?php /* if the post has a WP 2.9+ Thumbnail */
        if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
  <img src="<?php  echo $thumb[0]; ?>" alt="" class="scale-with-grid"/>
          <?php endif; ?>
      </div>
      <h3 class="posttitle"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">
          <?php the_title(); ?>
          </a></h3>
          <h5><a href="<?php the_permalink(); ?>"><?php the_time('jS F Y') ?></a> <?php _e('By', 'framework'); ?> <a href="<?php the_permalink(); ?>"><?php the_author(); ?></a></h5><!--Misc Info-->
      <!--Blog Post Title-->
      <!--Blog Excerpt-->
      <?php
      global $more;    // Declare global $more (before the loop).
      $more = 0;       // Set (inside the loop) to display content above the more tag.
      the_content(__('Read more...', 'framework')); ?>
  </div>
  </div>









    <?php $counter++; ?>
    <?php endwhile; ?>


        <div class="clear"></div>
    </div>
</div>
<!-- Home Content Area
================================================== -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="container clearfix homecontent">
    <div class="sixteen columns">
        <?php the_content(); ?>
    </div>
    <div class="clear"></div>
</div>
<?php endwhile; endif;?>

<?php  if ($newshome = get_option('of_home_news') !== 'Off') : ?>

<div class="clear"></div>
<?php endif; ?>
<?php get_footer(); ?>
