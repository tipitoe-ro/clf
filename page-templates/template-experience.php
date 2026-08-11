<?php
/**
 * Template Name: Experience
 * Template Post Type: page
 *
 * Assign this template to the "Experience" page in WordPress.
 */
$GLOBALS['clf_page_class'] = 'clf-experience-page';
get_header();

if ( have_posts() ) {
	the_post();
}

$exp_apply_url = clf_page_url( 'apply' );

$exp_retreats = array(
	array( 'Couples retreats', 'September — years 1 & 2' ),
	array( "Men's retreats", 'January — years 1 & 2' ),
	array( "Women's retreats", 'January — years 1 & 2' ),
);
$exp_months_one = array( 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May' );
$exp_months_two = array( 'Oct', 'Nov', 'Dec', 'Jan', 'Feb' );

$exp_included = array(
	array(
		'title' => 'Retreats',
		'icon'  => 'tent',
		'copy'  => "Six retreats over 18 months, designed to go deep on marriage, leadership, and calling. Couples retreats focus on your relationship together; the men's and women's retreats bring targeted focus to each person individually.",
	),
	array(
		'title' => 'Dinner gatherings',
		'icon'  => 'utensils',
		'copy'  => '13 evening gatherings across the 18 months bring the full cohort together for dinner, a speaker, and unstructured fellowship.',
	),
	array(
		'title' => 'One-on-one mentoring',
		'icon'  => 'users',
		'copy'  => 'Each participant is paired with an experienced Christian mentor who meets with them monthly — providing wisdom, guidance, and accountability across all areas of life. Required for husbands; optional for wives.',
	),
	array(
		'title' => 'Small groups',
		'icon'  => 'users',
		'copy'  => 'Groups of 4–5 participants meet weekly or bi-weekly for prayer, honest sharing, and mutual accountability. For many, these become the most significant relationships of the entire experience.',
	),
);

$exp_numbers = array(
	array( '18', 'Months together' ),
	array( '6', 'Retreats over 18 months' ),
	array( '13', 'Dinner gatherings' ),
	array( '18+', 'Mentoring sessions' ),
	array( 'Weekly', 'Small group rhythm' ),
	array( '30+', 'Years of CLF legacy' ),
);
?>

<style>
.clf-experience-page .clf-exp-hero{min-height:690px;background:var(--ink);color:#f4efe6;position:relative;display:flex;align-items:flex-end;padding:0 clamp(22px,11vw,170px) 88px;overflow:hidden}
.clf-experience-page .clf-exp-hero:after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(15,28,42,.98),rgba(15,28,42,.72) 55%,rgba(15,28,42,.2));pointer-events:none}
.clf-experience-page .clf-exp-heroart{position:absolute;inset:0;background:url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/clf-hero.jpg') center/cover no-repeat;opacity:.24;filter:saturate(.65)}
.clf-experience-page .clf-exp-heroinner{position:relative;z-index:1;max-width:820px}
.clf-experience-page .clf-exp-hero h1{font-size:clamp(58px,9vw,132px);line-height:.87;letter-spacing:-.08em;margin:28px 0 29px}
.clf-experience-page .clf-exp-hero h1 em{font-family:"Playfair Display",serif;color:#d6a18f;font-weight:600}
.clf-experience-page .clf-exp-hero p:not(.clf-kicker){max-width:550px;color:#d4d4ce;font-size:17px;line-height:1.7}
.clf-experience-page .clf-exp-marker{position:absolute;right:42px;top:50%;z-index:1;font:10px "DM Mono";letter-spacing:.18em;writing-mode:vertical-rl;transform:rotate(180deg);color:#d2cfc5}
.clf-experience-page .clf-exp-intro{display:grid;grid-template-columns:1fr 2fr;gap:3rem;padding:122px clamp(22px,11vw,170px);background:var(--paper)}
.clf-experience-page .clf-exp-introcopy{max-width:600px}
.clf-experience-page .clf-exp-introcopy p{font-size:19px;line-height:1.75;color:#56606a}
.clf-experience-page .clf-exp-tags{display:flex;flex-wrap:wrap;gap:9px;margin-top:30px}
.clf-experience-page .clf-exp-tag{font:11px "DM Mono";letter-spacing:.05em;text-transform:uppercase;border:1px solid #c8bdab;padding:9px 11px;color:#62645f}
.clf-experience-page .clf-exp-elements{padding:124px clamp(22px,11vw,170px);background:#d8cbb5}
.clf-experience-page .clf-exp-head{display:flex;justify-content:space-between;align-items:end;margin:65px 0 57px}
.clf-experience-page .clf-exp-head h2,.clf-experience-page .clf-exp-numbers h2{font-size:clamp(54px,7vw,96px);line-height:.9;letter-spacing:-.08em;margin:0}
.clf-experience-page .clf-exp-head h2 em,.clf-experience-page .clf-exp-numbers h2 em{font-family:"Playfair Display",serif;color:var(--rust)}
.clf-experience-page .clf-exp-head p{max-width:310px;line-height:1.7;font-size:14px;color:#5b5c56}
.clf-experience-page .clf-exp-list{display:flex;flex-direction:column;gap:1px;background:#bbae99}
.clf-experience-page .clf-exp-row{display:grid;grid-template-columns:76px 1fr;background:var(--paper);min-height:190px}
.clf-experience-page .clf-exp-icon{padding:27px 0;text-align:center;color:var(--rust);border-right:1px solid #c8bdab}
.clf-experience-page .clf-exp-body{padding:25px 30px}
.clf-experience-page .clf-exp-body h3{font-size:22px;margin:0 0 12px}
.clf-experience-page .clf-exp-body p{font-size:14px;line-height:1.65;color:#62645f;max-width:720px}
.clf-experience-page .clf-exp-meta{font:10px "DM Mono";letter-spacing:.08em;text-transform:uppercase;color:var(--rust);margin-top:18px}
.clf-experience-page .clf-exp-retreats{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-top:18px;max-width:650px}
.clf-experience-page .clf-exp-pill{padding:13px;background:#e4dccd}
.clf-experience-page .clf-exp-pill strong{display:block;font-size:12px}
.clf-experience-page .clf-exp-pill span{display:block;font:10px "DM Mono";color:#77736a;margin-top:5px}
.clf-experience-page .clf-exp-months{display:flex;flex-wrap:wrap;gap:6px;margin-top:8px}
.clf-experience-page .clf-exp-month{font:10px "DM Mono";color:#62645f;border:1px solid #c8bdab;padding:5px 9px}
.clf-experience-page .clf-exp-year{font:10px "DM Mono";color:var(--rust);margin-top:14px}
.clf-experience-page .clf-exp-numbers{padding:124px clamp(22px,11vw,170px);background:var(--ink);color:var(--paper)}
.clf-experience-page .clf-exp-numbers h2{margin:64px 0 52px}
.clf-experience-page .clf-exp-numbergrid{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:#485160}
.clf-experience-page .clf-exp-number{background:var(--ink);padding:27px 24px;min-height:145px}
.clf-experience-page .clf-exp-number strong{font-size:45px;letter-spacing:-.08em;color:#e7dcca}
.clf-experience-page .clf-exp-number span{display:block;font-size:12px;color:#aeb4b3;margin-top:10px}
.clf-experience-page .clf-exp-applycopy{max-width:570px}
@media(max-width:720px){
  .clf-experience-page .clf-exp-hero{min-height:690px;padding:0 22px 76px}
  .clf-experience-page .clf-exp-hero h1{font-size:68px}
  .clf-experience-page .clf-exp-marker{display:none}
  .clf-experience-page .clf-exp-intro{display:block;padding:78px 22px}
  .clf-experience-page .clf-exp-introcopy{margin-top:58px}
  .clf-experience-page .clf-exp-elements,.clf-experience-page .clf-exp-numbers{padding:78px 22px}
  .clf-experience-page .clf-exp-head{display:block;margin:58px 0 44px}
  .clf-experience-page .clf-exp-head p{margin-top:30px}
  .clf-experience-page .clf-exp-row{grid-template-columns:49px 1fr}
  .clf-experience-page .clf-exp-body{padding:23px 17px}
  .clf-experience-page .clf-exp-body h3{font-size:18px}
  .clf-experience-page .clf-exp-retreats{grid-template-columns:1fr}
  .clf-experience-page .clf-exp-numbergrid{grid-template-columns:repeat(2,1fr)}
}
</style>

<section class="clf-exp-hero" id="top">
  <div class="clf-exp-heroart"></div>
  <div class="clf-exp-heroinner clf-reveal">
    <p class="clf-kicker">The CLF experience <span>— 18 months</span></p>
    <h1>Transformational,<br><em>not informational.</em></h1>
    <?php if ( has_excerpt() ) : ?>
      <p><?php echo esc_html( get_the_excerpt() ); ?></p>
    <?php else : ?>
      <p>CLF isn't a class or a curriculum — it's an 18-month experience designed to help couples grow in character, clarify their calling, and build relationships that last.</p>
    <?php endif; ?>
    <div class="clf-actions"><a class="clf-button" href="#included">See what's included <?php clf_icon( 'arrow-down-right', 17 ); ?></a></div>
  </div>
  <div class="clf-exp-marker">CHARLOTTE, NORTH CAROLINA <span>&#8600;</span></div>
</section>

<section class="clf-exp-intro" id="story">
  <div class="clf-sectiontag clf-reveal">01 / Our approach</div>
  <div class="clf-exp-introcopy clf-reveal">
    <?php
    $exp_content = get_the_content();
    if ( $exp_content ) {
      echo '<div class="clf-wpcontent">';
      the_content();
      echo '</div>';
    } else {
      ?>
      <p>Developed over 30 years, CLF is built around the conviction that lasting change happens through community, not content alone. All teaching is rooted in Scripture — but the goal is never information for its own sake. It's transformation: in your relationship with Christ, your marriage, your parenting, and your sense of purpose.</p>
      <?php
    }
    ?>
    <div class="clf-exp-tags">
      <span class="clf-exp-tag"><?php clf_icon( 'check', 12 ); ?> Faith-centered</span>
      <span class="clf-exp-tag"><?php clf_icon( 'check', 12 ); ?> Marriage-strengthening</span>
      <span class="clf-exp-tag"><?php clf_icon( 'check', 12 ); ?> Purpose-driven</span>
      <span class="clf-exp-tag"><?php clf_icon( 'check', 12 ); ?> Community-based</span>
      <span class="clf-exp-tag"><?php clf_icon( 'check', 12 ); ?> Biblically-grounded</span>
    </div>
  </div>
</section>

<section class="clf-exp-elements" id="included">
  <div class="clf-sectiontag clf-reveal">02 / What's included</div>
  <div class="clf-exp-head clf-reveal">
    <h2>Four rhythms.<br><em>One formation.</em></h2>
    <p>Four core elements woven together across 18 months. Each one makes the others matter more.</p>
  </div>
  <div class="clf-exp-list clf-reveal">
    <?php foreach ( $exp_included as $index => $item ) : ?>
      <article class="clf-exp-row">
        <div class="clf-exp-icon"><?php clf_icon( $item['icon'], 20 ); ?></div>
        <div class="clf-exp-body">
          <h3><?php echo esc_html( $item['title'] ); ?></h3>
          <p><?php echo esc_html( $item['copy'] ); ?></p>
          <?php if ( 0 === $index ) : ?>
            <div class="clf-exp-retreats">
              <?php foreach ( $exp_retreats as $retreat ) : ?>
                <div class="clf-exp-pill"><strong><?php echo esc_html( $retreat[0] ); ?></strong><span><?php echo esc_html( $retreat[1] ); ?></span></div>
              <?php endforeach; ?>
            </div>
          <?php elseif ( 1 === $index ) : ?>
            <div class="clf-exp-year">Year 1</div>
            <div class="clf-exp-months">
              <?php foreach ( $exp_months_one as $month ) : ?>
                <span class="clf-exp-month"><?php echo esc_html( $month ); ?></span>
              <?php endforeach; ?>
            </div>
            <div class="clf-exp-year">Year 2</div>
            <div class="clf-exp-months">
              <?php foreach ( $exp_months_two as $month ) : ?>
                <span class="clf-exp-month"><?php echo esc_html( $month ); ?></span>
              <?php endforeach; ?>
            </div>
          <?php elseif ( 2 === $index ) : ?>
            <div class="clf-exp-meta">Monthly throughout the 18 months</div>
          <?php elseif ( 3 === $index ) : ?>
            <div class="clf-exp-meta">Weekly or bi-weekly throughout the 18 months</div>
          <?php endif; ?>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="clf-exp-numbers" id="alumni">
  <div class="clf-sectiontag clf-reveal">03 / By the numbers</div>
  <h2 class="clf-reveal">The shape of<br><em>commitment.</em></h2>
  <div class="clf-exp-numbergrid clf-reveal">
    <?php foreach ( $exp_numbers as $number ) : ?>
      <div class="clf-exp-number"><strong><?php echo esc_html( $number[0] ); ?></strong><span><?php echo esc_html( $number[1] ); ?></span></div>
    <?php endforeach; ?>
  </div>
</section>

<section class="clf-apply clf-reveal" id="apply">
  <div class="clf-exp-applycopy">
    <div class="clf-sectiontag">04 / Your next chapter</div>
    <h2>This sounds<br><em>like us.</em></h2>
    <p>CLF accepts a small group of couples each year. If you're motivated to live with more purpose and impact, we'd love to hear from you.</p>
  </div>
  <a class="clf-applybtn" href="<?php echo esc_url( $exp_apply_url ); ?>">Apply now <?php clf_icon( 'arrow-up-right', 21 ); ?></a>
</section>

<?php get_footer(); ?>
