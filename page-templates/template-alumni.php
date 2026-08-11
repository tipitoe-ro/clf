<?php
/**
 * Template Name: Alumni
 * Template Post Type: page
 */
$GLOBALS['clf_page_class'] = 'clf-alumni';
get_header();

if ( have_posts() ) {
	the_post();
}

$contact_email = clf_get( 'clf_contact_email', 'info@charlotteforum.org' );
$hero_sub      = has_excerpt()
	? get_the_excerpt()
	: 'Since 1995, CLF has walked alongside nearly 400 couples across 15 classes. Our alumni are leading in their families, churches, workplaces, and communities — and the network only grows stronger.';

$classes = array( '2025', '2023', '2021', '2019', '2017', '2015', '2013', '2011', '2009', '2007', '2005', '2003', '2001', '1999', '1997' );
?>

<style>
.clf-alumnihero{min-height:690px;height:82svh;max-height:820px;position:relative;background:#1b2a3b;color:#f4efe6;display:flex;align-items:center}
.clf-alumnihero-art{position:absolute;inset:0;background:url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/clf-hero.jpg') 68% center/cover no-repeat;opacity:.52;filter:saturate(.7)}
.clf-alumnihero-inner{position:relative;margin-left:clamp(22px,11vw,170px);max-width:760px;padding-top:75px}
.clf-alumnihero h1{font-size:clamp(55px,8.5vw,128px);line-height:.88;letter-spacing:-.075em;margin:29px 0 32px;font-weight:700}
.clf-alumnihero h1 em,.clf-alumni-section h2 em,.clf-directory h2 em,.clf-apply h2 em{font-family:"Playfair Display",serif;font-weight:600;letter-spacing:-.06em;color:#d6a18f}
.clf-alumni-section{padding:130px clamp(22px,11vw,170px);background:var(--paper)}
.clf-alumni-section-head{display:flex;align-items:end;justify-content:space-between;margin:65px 0 72px}
.clf-alumni-section h2,.clf-directory h2{font-size:clamp(52px,7vw,100px);line-height:.9;letter-spacing:-.08em;margin:0}
.clf-alumni-section-head>p{max-width:330px;font-size:14px;line-height:1.7;color:#62645f}
.clf-testimonials{display:grid;grid-template-columns:1.05fr 1fr 1fr;gap:1px;background:#c8bdab}
.clf-testimonials article{background:#eee9df;padding:27px 25px 31px;min-height:300px;display:flex;flex-direction:column}
.clf-testimonials article>span{font:58px "Playfair Display";color:var(--rust);line-height:.65;margin-bottom:27px}
.clf-testimonials p{font:italic 17px/1.55 "Playfair Display";color:#343b42;margin-bottom:28px}
.clf-testimonials b{font-size:11px;text-transform:uppercase;letter-spacing:.08em;margin-top:auto}
.clf-testimonials small{font:10px "DM Mono";color:#78756e;margin-top:7px}
.clf-directory{padding:130px clamp(22px,11vw,170px);background:#d8cbb5;display:grid;grid-template-columns:1fr 2.1fr;gap:6vw}
.clf-directory-content h2{margin-bottom:30px}.clf-directory-content>p{font-size:14px;line-height:1.7;color:#5c5b55;max-width:470px;margin-bottom:43px}
.clf-class-list{border-top:1px solid #b8aa91;display:grid;grid-template-columns:1fr 1fr}
.clf-class-list button{display:flex;align-items:center;gap:12px;text-align:left;padding:16px 5px;border-bottom:1px solid #b8aa91;font-size:13px;width:100%}
.clf-class-list button:hover{color:var(--rust)}.clf-class-list small{font:10px "DM Mono";color:#756e64;margin-left:auto}.clf-class-list svg{color:var(--rust)}
.clf-portal{padding:120px clamp(22px,11vw,170px);background:var(--ink);color:#eee9df;display:grid;grid-template-columns:1fr 2.1fr;gap:6vw}
.clf-portal-band{border:1px solid #526070;padding:42px;display:grid;grid-template-columns:1fr 1fr;gap:48px}
.clf-coming{display:inline-flex;align-items:center;gap:7px;color:#e0a187;border:1px solid #77574d;padding:7px 10px;font:10px "DM Mono";text-transform:uppercase;letter-spacing:.1em}
.clf-portal h2{font-size:clamp(36px,4vw,58px);line-height:.92;letter-spacing:-.07em;margin:28px 0 23px}.clf-portal p{font-size:14px;line-height:1.7;color:#b5b9b5}
.clf-features{display:flex;flex-direction:column;gap:15px;margin-top:28px}.clf-features div{font-size:13px;color:#d0d0c8;display:flex;gap:11px;align-items:flex-start}.clf-features svg{color:#d18a72;flex-shrink:0}
.clf-portal-actions{padding-top:47px}.clf-portal-actions .clf-button{margin:26px 0 12px;text-decoration:none}.clf-portal-login{display:flex;align-items:center;gap:8px;color:#d8d6cc!important;font-size:12px;padding:11px 0}.clf-portal-login:hover{color:#d5a18f!important}.clf-portal-actions>small{display:block;font:10px/1.6 "DM Mono";color:#8e9897;margin-top:22px}
@media(max-width:720px){.clf-alumnihero{min-height:690px}.clf-alumnihero-inner{margin:0 22px}.clf-alumnihero h1{font-size:66px}.clf-alumni-section,.clf-directory,.clf-portal{padding:80px 22px;display:block}.clf-alumni-section-head{display:block;margin:55px 0 55px}.clf-alumni-section-head>p{margin-top:30px}.clf-testimonials{grid-template-columns:1fr}.clf-testimonials article{min-height:270px}.clf-directory-content{margin-top:55px}.clf-class-list{grid-template-columns:1fr}.clf-portal-band{display:block;padding:26px 21px;margin-top:55px}.clf-portal-actions{padding-top:48px}.clf-apply h2{font-size:69px}}
</style>

<section class="clf-alumnihero" id="alumni-top">
  <div class="clf-alumnihero-art"></div>
  <div class="clf-herooverlay"></div>
  <div class="clf-alumnihero-inner clf-reveal">
    <p class="clf-kicker">The alumni network <span>&mdash; since 1995</span></p>
    <h1>A network built<br>on shared <em>calling.</em></h1>
    <p class="clf-herobody"><?php echo esc_html( $hero_sub ); ?></p>
    <a class="clf-textlink" href="#voices">Hear from the network <?php clf_icon( 'arrow-down-right', 17 ); ?></a>
  </div>
  <div class="clf-heroside">CHARLOTTE, NORTH CAROLINA <span>&#8600;</span></div>
  <div class="clf-scroll">SCROLL TO EXPLORE <span></span></div>
</section>

<section class="clf-stats clf-reveal" id="alumni-story">
  <div><strong><?php echo esc_html( clf_get( 'clf_stat_1_num', '15' ) ); ?></strong><p><?php echo esc_html( clf_get( 'clf_stat_1_label', 'Classes since 1995' ) ); ?></p></div>
  <div><strong><?php echo esc_html( clf_get( 'clf_stat_2_num', '~375' ) ); ?></strong><p><?php echo esc_html( clf_get( 'clf_stat_2_label', "Couples who've participated" ) ); ?></p></div>
  <div><strong><?php echo esc_html( clf_get( 'clf_stat_3_num', '~750' ) ); ?></strong><p><?php echo esc_html( clf_get( 'clf_stat_3_label', 'Alumni individuals' ) ); ?></p></div>
  <div><strong>30<span>+</span></strong><p>Years of impact</p></div>
</section>

<section class="clf-alumni-section" id="voices">
  <div class="clf-sectiontag clf-reveal">01 / In their own words</div>
  <div class="clf-alumni-section-head clf-reveal">
    <h2>What stays<br><em>with you.</em></h2>
    <p>CLF is an 18-month experience. The friendships, language, and conviction keep unfolding long after the final retreat.</p>
  </div>
  <?php if ( get_the_content() ) : ?>
    <div class="clf-wpcontent clf-reveal"><?php the_content(); ?></div>
  <?php else : ?>
  <div class="clf-testimonials clf-reveal">
    <article><span>&ldquo;</span><p>"CLF gave us language for what we were already feeling &mdash; that God had something specific for our family &mdash; and then a community to help us figure out what that actually meant."</p><b>[Alumnus couple name]</b><small>CLF Class of [year]</small></article>
    <article><span>&ldquo;</span><p>"The friendships we made in our small group are still some of our closest relationships, years later. That's not something you can manufacture &mdash; CLF just creates the conditions for it."</p><b>[Alumnus couple name]</b><small>CLF Class of [year]</small></article>
    <article><span>&ldquo;</span><p>"I came in thinking it was a leadership program. I left with a clearer sense of who I am, what I'm for, and how to actually live that out alongside my wife."</p><b>[Alumnus name]</b><small>CLF Class of [year]</small></article>
  </div>
  <?php endif; ?>
</section>

<section class="clf-directory clf-reveal" id="directory">
  <div class="clf-sectiontag">02 / Class directory</div>
  <div class="clf-directory-content">
    <h2>One cohort.<br><em>Every other year.</em></h2>
    <p>Every CLF class since 1997 &mdash; one cohort every two years. Full alumni profiles and a searchable directory are available in the alumni portal.</p>
    <div class="clf-class-list">
      <?php foreach ( $classes as $year ) : ?>
        <button type="button" onclick="clfNotifyInterest()"><span>Class of <?php echo esc_html( $year ); ?></span><small>~25 couples</small><?php clf_icon( 'chevron-right', 16 ); ?></button>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="clf-portal clf-reveal" id="portal">
  <div class="clf-sectiontag">03 / Alumni portal</div>
  <div class="clf-portal-band">
    <div>
      <div class="clf-coming"><?php clf_icon( 'clock', 13 ); ?> Coming soon</div>
      <h2>Your home base<br>as a CLF alumnus.</h2>
      <p>We're building a private space for CLF alumni to connect, find their cohort, stay informed on events, and engage with the broader network.</p>
      <div class="clf-features">
        <div><?php clf_icon( 'search', 16 ); ?> Search alumni by name or class year</div>
        <div><?php clf_icon( 'users', 16 ); ?> Find and reconnect with your cohort</div>
        <div><?php clf_icon( 'calendar', 16 ); ?> Stay informed on alumni events</div>
        <div><?php clf_icon( 'message', 16 ); ?> Engage with the broader CLF network</div>
        <div><?php clf_icon( 'heart', 16 ); ?> Support and refer future applicants</div>
      </div>
    </div>
    <div class="clf-portal-actions">
      <p>Are you a CLF alumnus? Let us know you're interested and we'll reach out when the portal launches.</p>
      <a class="clf-button" id="clfNotifyBtn" href="mailto:<?php echo esc_attr( $contact_email ); ?>?subject=Alumni Portal Interest" onclick="clfNotifyInterest()"><?php clf_icon( 'mail', 17 ); ?> <span>Notify me when it launches</span></a>
      <button type="button" class="clf-portal-login" onclick="window.alert('The alumni portal is coming soon. Contact us if you need help logging in.')"><?php clf_icon( 'lock', 16 ); ?> Log in to portal</button>
      <small>Already have an account? Contact us if you need help logging in.</small>
    </div>
  </div>
</section>

<section class="clf-apply clf-reveal" id="share">
  <div>
    <div class="clf-sectiontag">04 / Pass it on</div>
    <h2>Know someone<br>who should <em>apply?</em></h2>
    <p>Alumni are our best recruiters. If you know a couple who would thrive in CLF, send them our way.</p>
  </div>
  <a class="clf-applybtn" href="<?php echo esc_url( clf_page_url( 'apply' ) ); ?>">Share CLF <?php clf_icon( 'arrow-up-right', 21 ); ?></a>
</section>

<script>
(function () {
  window.clfNotifyInterest = function () {
    var btn = document.getElementById('clfNotifyBtn');
    if (!btn) return;
    var label = btn.querySelector('span');
    if (label) label.textContent = 'Interest noted';
    var svg = btn.querySelector('svg');
    if (svg) {
      svg.outerHTML = '<svg class="clf-icon" viewBox="0 0 24 24" width="17" height="17" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>';
    }
  };
})();
</script>

<?php get_footer(); ?>
