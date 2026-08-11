<?php
/**
 * Front page — Bold Conviction home.
 * Editable via Appearance → Customize → CLF Content → Home Page.
 */
get_header();

$hero_line1  = clf_get( 'clf_home_hero_line1', 'Lead well.' );
$hero_line2  = clf_get( 'clf_home_hero_line2', 'Live fully.' );
$hero_sub    = clf_get( 'clf_home_hero_subtext', 'CLF is an 18-month experience for young married couples who want to live with more purpose, clarity, and impact.' );
$kicker_note = clf_get( 'clf_home_kicker_note', '— since 1995' );
$stats_note  = clf_get( 'clf_stats_note', 'A generation of leaders in motion.' );
$mission     = clf_get( 'clf_home_mission_text', "We help motivated couples discover God's call on their lives — and build the character to live it out." );
$quote       = clf_get( 'clf_home_quote', 'The people we became together started with the questions we were willing to ask.' );
$quote_attr  = clf_get( 'clf_home_quote_attr', '— CLF Alumni Couple, Class of 2019' );
$apply_url   = clf_page_url( 'apply' );

$pillars = array(
	array( '01', 'Purpose',    'Who am I, and what am I here for?' ),
	array( '02', 'Talents',    'Discover your unique gifts and how to use them.' ),
	array( '03', 'Vision',     "What is God's vision for your life and family?" ),
	array( '04', 'Priorities', 'Navigate the competing claims on your time.' ),
);

$programs = array(
	array( 'Retreats',          'Six retreats over 18 months — couples retreats and gender-specific retreats for deeper focus on marriage, leadership, and mission.' ),
	array( 'Dinner gatherings', '13 monthly evening gatherings with speakers, dinner, and time for real community.' ),
	array( 'Mentoring',         'Monthly one-on-one time with an experienced Christian mentor across all areas of life.' ),
	array( 'Small groups',      'Weekly or bi-weekly gatherings for prayer, accountability, and honest sharing.' ),
);
?>

<section class="clf-hero" id="top">
  <div class="clf-heroimage"></div>
  <div class="clf-herooverlay"></div>
  <div class="clf-heroinner clf-reveal">
    <p class="clf-kicker"><?php echo esc_html( get_bloginfo( 'name' ) ?: 'Charlotte Leadership Forum' ); ?> <span><?php echo esc_html( $kicker_note ); ?></span></p>
    <h1><?php echo esc_html( $hero_line1 ); ?><br><em><?php echo esc_html( $hero_line2 ); ?></em></h1>
    <p class="clf-herobody"><?php echo esc_html( $hero_sub ); ?></p>
    <div class="clf-actions">
      <a class="clf-button" href="<?php echo esc_url( $apply_url ); ?>">Apply now <?php clf_icon( 'arrow-up-right', 17 ); ?></a>
      <a class="clf-textlink" href="<?php echo esc_url( clf_page_url( 'experience' ) ); ?>">See what's involved <?php clf_icon( 'arrow-down-right', 17 ); ?></a>
    </div>
  </div>
  <div class="clf-heroside">CHARLOTTE, NORTH CAROLINA <span>&#8600;</span></div>
  <div class="clf-scroll">SCROLL TO EXPLORE <span></span></div>
</section>

<section class="clf-stats clf-reveal">
  <div><strong><?php echo esc_html( clf_get( 'clf_stat_1_num', '30+' ) ); ?></strong><p><?php echo esc_html( clf_get( 'clf_stat_1_label', 'Years of impact' ) ); ?></p></div>
  <div><strong><?php echo esc_html( clf_get( 'clf_stat_2_num', '~375' ) ); ?></strong><p><?php echo esc_html( clf_get( 'clf_stat_2_label', "Couples who've participated" ) ); ?></p></div>
  <div><strong><?php echo esc_html( clf_get( 'clf_stat_3_num', '15' ) ); ?></strong><p><?php echo esc_html( clf_get( 'clf_stat_3_label', 'Classes since 1995' ) ); ?></p></div>
  <div class="clf-statsnote"><?php echo esc_html( $stats_note ); ?></div>
</section>

<section class="clf-mission" id="mission">
  <div class="clf-sectiontag clf-reveal">01 / Our mission</div>
  <div class="clf-missioncopy clf-reveal">
    <h2>There is more<br>to your <em>life</em><br>than busy.</h2>
    <p><?php echo esc_html( $mission ); ?></p>
  </div>
  <div class="clf-pillarwrap clf-reveal">
    <?php foreach ( $pillars as $p ) : ?>
      <article class="clf-pillar">
        <span><?php echo esc_html( $p[0] ); ?></span>
        <h3><?php echo esc_html( $p[1] ); ?></h3>
        <p><?php echo esc_html( $p[2] ); ?></p>
        <?php clf_icon( 'chevron-right', 17 ); ?>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="clf-experience" id="experience">
  <div class="clf-sectiontag clf-reveal">02 / The experience</div>
  <div class="clf-experiencehead clf-reveal">
    <h2>Built for the<br><em>long haul.</em></h2>
    <p>Not a conference. Not a class. An 18-month rhythm of challenge, reflection, and the kind of community that stays with you.</p>
  </div>
  <div class="clf-programs clf-reveal">
    <?php foreach ( $programs as $i => $pr ) : ?>
      <article class="clf-program">
        <span>0<?php echo (int) ( $i + 1 ); ?></span>
        <h3><?php echo esc_html( $pr[0] ); ?></h3>
        <p><?php echo esc_html( $pr[1] ); ?></p>
        <?php clf_icon( 'arrow-up-right', 18 ); ?>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<section class="clf-quote clf-reveal">
  <p>&ldquo;<?php echo esc_html( $quote ); ?>&rdquo;</p>
  <span><?php echo esc_html( strtoupper( $quote_attr ) ); ?></span>
</section>

<section class="clf-apply clf-reveal" id="apply">
  <div>
    <div class="clf-sectiontag">03 / Your next chapter</div>
    <h2>Ready to<br><em>apply?</em></h2>
    <p>Applications are open for the next cohort. We select a small group of couples each year — don't wait.</p>
  </div>
  <a class="clf-applybtn" href="<?php echo esc_url( $apply_url ); ?>">Start your application <?php clf_icon( 'arrow-up-right', 21 ); ?></a>
</section>

<?php get_footer(); ?>
