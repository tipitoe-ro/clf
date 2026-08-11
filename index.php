<?php
/**
 * Default fallback template.
 * WordPress requires this file to exist. Typically the front page
 * will use front-page.php and inner pages use page.php.
 */
get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<section class="clf-pagehead">
  <div class="clf-sectiontag" style="margin-bottom:26px;">CLF</div>
  <h1><?php the_title(); ?></h1>
</section>
<div class="clf-pagebody clf-wpcontent">
  <?php the_content(); ?>
</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
