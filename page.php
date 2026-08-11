<?php
/**
 * Default page template — used when no custom template is assigned.
 */
$GLOBALS['clf_page_class'] = '';
get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section class="clf-pagehead">
  <div class="clf-sectiontag" style="margin-bottom:26px;">CLF</div>
  <h1><?php the_title(); ?></h1>
  <?php if ( has_excerpt() ) : ?><p><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
</section>

<?php if ( get_the_content() ) : ?>
<div class="clf-pagebody clf-wpcontent">
  <?php the_content(); ?>
</div>
<?php endif; ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
