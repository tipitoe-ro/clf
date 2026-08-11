<?php
/**
 * Theme header — Bold Conviction nav.
 *
 * Page templates may set $GLOBALS['clf_page_class'] before calling get_header()
 * to add a page-scoping class (e.g. 'clf-give clf-nav-light') to the .clf wrapper.
 */
$clf_page_class = isset( $GLOBALS['clf_page_class'] ) ? $GLOBALS['clf_page_class'] : '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="clf <?php echo esc_attr( $clf_page_class ); ?>">

<nav class="clf-nav">
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="clf-mark">
    <span>CLF</span><small><?php echo esc_html( strtoupper( get_bloginfo( 'name' ) ?: 'Charlotte Leadership Forum' ) ); ?></small>
  </a>

  <div class="clf-navlinks" id="clfNavLinks">
    <?php
    if ( has_nav_menu( 'primary' ) ) {
      wp_nav_menu( array(
        'theme_location' => 'primary',
        'items_wrap'     => '%3$s',
        'container'      => false,
        'walker'         => new CLF_Nav_Walker(),
        'fallback_cb'    => false,
      ) );
    } else {
      ?>
      <a href="<?php echo esc_url( clf_page_url( 'experience' ) ); ?>">Experience</a>
      <a href="<?php echo esc_url( clf_page_url( 'our-story' ) ); ?>">Our story</a>
      <a href="<?php echo esc_url( clf_page_url( 'alumni' ) ); ?>">Alumni</a>
      <a href="<?php echo esc_url( clf_page_url( 'give' ) ); ?>">Give</a>
      <a href="<?php echo esc_url( clf_page_url( 'apply' ) ); ?>" class="clf-navcta">Apply now <?php clf_icon( 'arrow-up-right', 15 ); ?></a>
      <?php
    }
    ?>
  </div>

  <button class="clf-menu" id="clfMenuToggle" aria-label="Toggle menu" aria-expanded="false">
    <svg class="clf-icon" viewBox="0 0 24 24" width="24" height="24"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
  </button>
</nav>
