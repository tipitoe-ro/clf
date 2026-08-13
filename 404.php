<?php
/**
 * 404 — page not found.
 */
$GLOBALS['clf_page_class'] = 'clf-404';
get_header();

$portal_url = clf_get( 'clf_portal_login_url', '/alumni-login/' );
?>

<style>
.clf-404hero{min-height:72svh;background:var(--paper);display:flex;align-items:center;padding:160px clamp(22px,11vw,170px) 110px}
.clf-404hero .clf-sectiontag{margin-bottom:30px}
.clf-404hero h1{font-size:clamp(58px,9vw,140px);line-height:.88;letter-spacing:-.075em;margin:0 0 30px;font-weight:700}
.clf-404hero h1 em{font-family:"Playfair Display",serif;font-weight:600;letter-spacing:-.06em;color:var(--rust)}
.clf-404hero p{font-size:16px;line-height:1.7;color:#62645f;max-width:470px;margin-bottom:44px}
.clf-404links{display:flex;flex-wrap:wrap;gap:14px 28px;align-items:center}
.clf-404links .clf-textlink{font-size:13px}
@media(max-width:720px){.clf-404hero{padding:140px 22px 80px}}
</style>

<section class="clf-404hero clf-reveal">
  <div>
    <div class="clf-sectiontag">404 / Not found</div>
    <h1>This page took<br>a <em>different path.</em></h1>
    <p>The page you're looking for doesn't exist &mdash; it may have moved, or the link may be out of date. Here's where you probably want to go:</p>
    <div class="clf-404links">
      <a class="clf-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span>Back to the homepage</span></a>
      <a class="clf-textlink" href="<?php echo esc_url( $portal_url ); ?>"><?php clf_icon( 'lock', 15 ); ?> Alumni portal login</a>
      <a class="clf-textlink" href="<?php echo esc_url( clf_page_url( 'apply' ) ); ?>">Apply to CLF <?php clf_icon( 'arrow-up-right', 15 ); ?></a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
