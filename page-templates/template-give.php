<?php
/**
 * Template Name: Give
 * Template Post Type: page
 */
$GLOBALS['clf_page_class'] = 'clf-give clf-nav-light';
get_header();

if ( have_posts() ) {
	the_post();
}

$paypal_url    = clf_get( 'clf_paypal_url', 'https://www.paypal.com/donate/?business=NM2PEQDVYDWFW&no_recurring=0&currency_code=USD' );
$contact_email = clf_get( 'clf_contact_email', 'info@charlotteforum.org' );
$mailing_addr  = clf_get( 'clf_mailing_address', "Attention: Treasurer<br>CLF<br>4609 Crownvista Drive<br>Charlotte, NC 28269" );

$funding = array(
	array( '01', 'Retreats & events', 'Covering the cost of six retreats per class — venues, meals, speakers, and materials across 18 months.' ),
	array( '02', 'Scholarships', 'Ensuring no couple is turned away because of financial constraints. CLF is for those called, not just those who can afford it.' ),
	array( '03', 'Mentoring resources', 'Supporting the mentors who invest their time and wisdom into each participant across 18 months.' ),
	array( '04', 'Small group materials', 'Resources that help small groups go deeper — books, guides, and shared materials throughout the year.' ),
);

$impact = array(
	array( '$50', "Covers materials for one participant's small group for a month" ),
	array( '$100', 'Helps sponsor one dinner gathering for the cohort' ),
	array( '$250', 'Contributes toward a weekend retreat for one couple' ),
	array( '$1,000', "Fully sponsors one couple's participation for the year" ),
);

$gift_amounts = array( '$50', '$100', '$250', '$500' );
?>

<style>
  .clf-give-hero { background: var(--sand); color: var(--ink); padding: 178px clamp(22px,11vw,170px) 120px; position: relative; overflow: hidden; }
  .clf-give-hero:after { content: "G"; position: absolute; right: 5vw; bottom: -8vw; color: rgba(169,77,59,.13); font: 700 43vw/.7 Manrope,sans-serif; letter-spacing: -.12em; pointer-events: none; }
  .clf-give-hero-inner { position: relative; z-index: 1; max-width: 890px; }
  .clf-give-hero h1 { font-size: clamp(62px,9.4vw,142px); line-height: .86; letter-spacing: -.085em; margin: 30px 0 38px; max-width: 900px; }
  .clf-give-hero h1 em { font-family: "Playfair Display", serif; color: var(--rust); font-weight: 600; letter-spacing: -.07em; }
  .clf-give-hero p { max-width: 490px; font-size: 17px; line-height: 1.7; color: #525a5c; }
  .clf-give-rule { width: 100%; height: 1px; background: rgba(23,38,56,.2); margin-top: 84px; }
  .clf-give-section { padding: 120px clamp(22px,11vw,170px); border-bottom: 1px solid #c8bdab; }
  .clf-give-two { display: grid; grid-template-columns: 1fr 2fr; gap: clamp(35px,7vw,110px); align-items: start; }
  .clf-give-label { font: 11px "DM Mono"; letter-spacing: .13em; text-transform: uppercase; color: var(--rust); }
  .clf-give-label em { display: block; color: #77756d; font: italic 15px "Playfair Display"; letter-spacing: 0; margin-top: 12px; }
  .clf-give-card { background: #f4f0e8; border: 1px solid #c8bdab; }
  .clf-give-card-head { padding: 27px 30px 24px; border-bottom: 1px solid #c8bdab; }
  .clf-give-card-head h2 { font-size: 25px; letter-spacing: -.04em; margin: 0 0 9px; }
  .clf-give-card-head p, .clf-give-alt p { color: #62645f; font-size: 15px; line-height: 1.65; }
  .clf-give-card-body { padding: 30px; }
  .clf-give-toggle { display: flex; border: 1px solid #bdb4a4; margin-bottom: 23px; }
  .clf-give-toggle button { flex: 1; padding: 13px 8px; color: #666960; font-size: 11px; text-transform: uppercase; letter-spacing: .05em; }
  .clf-give-toggle button.selected { background: var(--ink); color: var(--paper); }
  .clf-give-amounts { display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; margin-bottom: 12px; }
  .clf-give-amounts button { border: 1px solid #bdb4a4; padding: 14px 5px; font: 16px "DM Mono"; color: var(--ink); }
  .clf-give-amounts button.selected { background: var(--rust); color: #fff4ea; border-color: var(--rust); }
  .clf-give-input { width: 100%; background: transparent; border: 0; border-bottom: 1px solid #bdb4a4; padding: 14px 2px; font: 14px Manrope,sans-serif; color: var(--ink); outline: none; margin-bottom: 24px; }
  .clf-give-input:focus { border-color: var(--rust); }
  .clf-paypal { width: 100%; background: var(--rust) !important; color: #fff4ea !important; padding: 17px 20px; display: flex; justify-content: space-between; align-items: center; font-size: 11px; text-transform: uppercase; letter-spacing: .08em; font-weight: 700; }
  .clf-paypal:hover { background: #bb5e49 !important; transform: translateY(-2px); }
  .clf-give-note { color: #858078; font: 10px "DM Mono"; line-height: 1.6; margin-top: 14px; text-align: center; }
  .clf-give-alt { margin-top: 17px; background: #d8cbb5; padding: 27px 30px; }
  .clf-give-alt h3 { margin: 0 0 10px; font-size: 16px; }
  .clf-give-alt address { display: inline-block; margin-top: 18px; padding: 14px 17px; background: rgba(238,233,223,.6); border-left: 2px solid var(--rust); font-style: normal; font: 12px/1.8 "DM Mono"; color: #555a57; }
  .clf-give-alt .clf-give-question { margin-top: 16px; font-size: 11px; }
  .clf-give-question a { color: var(--rust); }
  .clf-funding-intro, .clf-impact-intro { color: #62645f; font-size: 15px; line-height: 1.75; margin: 0 0 28px; max-width: 520px; }
  .clf-funding-grid { display: grid; grid-template-columns: 1fr 1fr; border-top: 1px solid #c8bdab; border-left: 1px solid #c8bdab; }
  .clf-funding-card { min-height: 210px; padding: 24px 22px; border-right: 1px solid #c8bdab; border-bottom: 1px solid #c8bdab; position: relative; }
  .clf-funding-card span { font: 10px "DM Mono"; color: var(--rust); }
  .clf-funding-card h3 { font-size: 18px; margin: 30px 0 11px; letter-spacing: -.03em; }
  .clf-funding-card p { max-width: 275px; color: #62645f; font-size: 14px; line-height: 1.6; }
  .clf-funding-card:after { content: "\2197"; position: absolute; right: 20px; bottom: 19px; color: var(--rust); font-size: 18px; }
  .clf-impact { background: var(--ink); color: var(--paper); border-bottom: 0; }
  .clf-impact .clf-give-label { color: #d4a492; }
  .clf-impact .clf-give-label em { color: #b7b9b1; }
  .clf-impact-intro { color: #b8bcb7; }
  .clf-impact-row { display: grid; grid-template-columns: repeat(4, 1fr); border: 1px solid #485160; }
  .clf-impact-cell { padding: 25px 20px 28px; min-height: 180px; border-right: 1px solid #485160; }
  .clf-impact-cell:last-child { border: 0; }
  .clf-impact-cell strong { display: block; color: #d4a492; font: 25px "DM Mono"; margin-bottom: 20px; }
  .clf-impact-cell p { color: #b8bcb7; font-size: 14px; line-height: 1.6; }
  .clf-give-success { color: #e7c5b6; font: 11px "DM Mono"; display: flex; gap: 8px; align-items: center; margin-top: 15px; }
  @media(min-width:1500px) {
    .clf-give-hero-inner { max-width: 60vw; }
    .clf-give-hero h1 { font-size: clamp(62px,9.4vw,180px); max-width: none; }
    .clf-give-hero p { max-width: 620px; font-size: 19px; }
  }
  @media(max-width:720px) {
    .clf-give-hero { padding: 140px 22px 80px; }
    .clf-give-hero h1 { font-size: 70px; }
    .clf-give-rule { margin-top: 58px; }
    .clf-give-section { padding: 78px 22px; }
    .clf-give-two { grid-template-columns: 1fr; gap: 38px; }
    .clf-give-card-body, .clf-give-card-head, .clf-give-alt { padding: 23px; }
    .clf-give-toggle button { font-size: 9px; }
    .clf-funding-grid { grid-template-columns: 1fr; }
    .clf-impact-row { grid-template-columns: 1fr 1fr; }
    .clf-impact-cell:nth-child(2) { border-right: 0; }
    .clf-impact-cell:nth-child(-n+2) { border-bottom: 1px solid #485160; }
  }
</style>

<section class="clf-give-hero" id="top">
  <div class="clf-give-hero-inner clf-reveal">
    <div class="clf-kicker">04 / Give <span>&mdash; Charlotte, North Carolina</span></div>
    <h1>Invest in the next generation of <em>leaders.</em></h1>
    <?php if ( has_excerpt() ) : ?>
      <p><?php echo esc_html( get_the_excerpt() ); ?></p>
    <?php else : ?>
      <p>CLF runs entirely on the generosity of donors who believe in this mission. Your gift helps couples discover their calling, strengthen their marriages, and lead with greater purpose.</p>
    <?php endif; ?>
    <div class="clf-give-rule"></div>
  </div>
</section>

<section class="clf-give-section" id="give">
  <div class="clf-give-two">
    <div class="clf-give-label clf-reveal">01 / Make a gift<em>A practical act of belief.</em></div>
    <div class="clf-reveal">
      <div class="clf-give-card">
        <div class="clf-give-card-head"><h2>Give online</h2><p>The easiest way to give — one-time or recurring gifts accepted through PayPal.</p></div>
        <div class="clf-give-card-body">
          <div class="clf-give-toggle">
            <button class="selected" onclick="clfGiveFreq(this)">Give once</button>
            <button onclick="clfGiveFreq(this)">Give monthly</button>
            <button onclick="clfGiveFreq(this)">Give annually</button>
          </div>
          <div class="clf-give-amounts">
            <?php foreach ( $gift_amounts as $amt ) : ?>
              <button class="<?php echo ( '$100' === $amt ) ? 'selected' : ''; ?>" onclick="clfGiveAmount(this)"><?php echo esc_html( $amt ); ?></button>
            <?php endforeach; ?>
          </div>
          <input class="clf-give-input" type="text" oninput="clfGiveCustom(this)" placeholder="Or enter a custom amount" aria-label="Custom gift amount">
          <a class="clf-paypal" href="<?php echo esc_url( $paypal_url ); ?>" target="_blank" rel="noopener noreferrer" onclick="clfGiveStart(this)">Continue to PayPal <?php clf_icon( 'arrow-up-right', 17 ); ?></a>
          <div class="clf-give-success" id="clfGiveSuccess" style="display:none;"><?php clf_icon( 'check', 14 ); ?> Your gift details are ready to continue.</div>
          <div class="clf-give-note">You&apos;ll be taken to PayPal to complete your gift securely.</div>
        </div>
      </div>
      <div class="clf-give-alt">
        <h3>Prefer to give by check?</h3>
        <p>Make checks payable to <strong>Charlotte Leadership Forum</strong> and mail to our treasurer. If mailing cash, please use a secure envelope.</p>
        <address><?php echo wp_kses( $mailing_addr, array( 'br' => array() ) ); ?></address>
        <p class="clf-give-question">Questions? Email us at <a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?></a></p>
      </div>
    </div>
  </div>
</section>

<section class="clf-give-section" id="experience">
  <div class="clf-give-two">
    <div class="clf-give-label clf-reveal">02 / Where it goes<em>Every dollar moves the work forward.</em></div>
    <div class="clf-reveal">
      <p class="clf-funding-intro">CLF is a volunteer-led ministry. Every dollar goes toward making the experience possible for the couples who participate.</p>
      <div class="clf-funding-grid">
        <?php foreach ( $funding as $f ) : ?>
          <article class="clf-funding-card">
            <span><?php echo esc_html( $f[0] ); ?></span>
            <h3><?php echo esc_html( $f[1] ); ?></h3>
            <p><?php echo esc_html( $f[2] ); ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<section class="clf-give-section clf-impact" id="alumni">
  <div class="clf-give-two">
    <div class="clf-give-label clf-reveal">03 / Your impact<em>Small acts. Lasting formation.</em></div>
    <div class="clf-reveal">
      <p class="clf-impact-intro">Here&apos;s what a gift to CLF can make possible.</p>
      <div class="clf-impact-row">
        <?php foreach ( $impact as $i ) : ?>
          <div class="clf-impact-cell"><strong><?php echo esc_html( $i[0] ); ?></strong><p><?php echo esc_html( $i[1] ); ?></p></div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  window.clfGiveFreq = function (el) {
    document.querySelectorAll('.clf-give-toggle button').forEach(function (b) { b.classList.remove('selected'); });
    el.classList.add('selected');
  };
  window.clfGiveAmount = function (el) {
    document.querySelectorAll('.clf-give-amounts button').forEach(function (b) { b.classList.remove('selected'); });
    el.classList.add('selected');
    var input = document.querySelector('.clf-give-input');
    if (input) input.value = '';
  };
  window.clfGiveCustom = function (el) {
    if (el.value) {
      document.querySelectorAll('.clf-give-amounts button').forEach(function (b) { b.classList.remove('selected'); });
    }
  };
  window.clfGiveStart = function (link) {
    // Pass the selected/custom amount through to PayPal so the choice actually carries over.
    var amount = '';
    var selected = document.querySelector('.clf-give-amounts button.selected');
    var input = document.querySelector('.clf-give-input');
    if (input && input.value) { amount = input.value; }
    else if (selected) { amount = selected.textContent; }
    amount = (amount || '').replace(/[^0-9.]/g, '');
    if (link && amount) {
      var url = new URL(link.href);
      url.searchParams.set('amount', amount);
      link.href = url.toString();
    }
    var s = document.getElementById('clfGiveSuccess');
    if (s) s.style.display = 'flex';
  };
})();
</script>

<?php get_footer(); ?>
