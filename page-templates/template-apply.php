<?php
/**
 * Template Name: Apply
 * Template Post Type: page
 *
 * NOTE: This template renders the multi-step application form (Bold Conviction design).
 * For production form submission and data capture, install a plugin such as WPForms,
 * Gravity Forms, or Formidable Forms and embed its shortcode inside the "step" divs,
 * or replace this form with your preferred solution. The JS step-navigation in
 * clf-main.js (clfGoTo / clfToggle) continues to work regardless of which form tool
 * you use.
 */
$GLOBALS['clf_page_class'] = 'ba-page clf-nav-light';
get_header();

if ( have_posts() ) {
	the_post();
}

/* Gravity Forms integration: set the form ID under Appearance → Customize →
   CLF Content → Contact & Footer → "Gravity Forms — Application Form ID".
   When set (and GF is active), the GF form renders instead of the static mockup. */
$clf_gf_id  = (int) clf_get( 'clf_apply_form_id' );
$clf_use_gf = $clf_gf_id && function_exists( 'gravity_form' );
?>

<style>
  .ba-page { min-height:100vh; background:var(--paper); color:var(--ink); }
  .ba-page .clf-nav { position:relative; color:var(--ink); background:var(--paper); border-color:#d6cebf; }
  .ba-page .clf-navlinks a, .ba-page .clf-navlinks button { color:#59616a; }
  .ba-page .clf-navlinks a:hover, .ba-page .clf-navlinks button:hover { color:var(--rust); }
  .ba-page .clf-navcta, .ba-page .clf-navlinks a.nav-cta { color:var(--ink); border-color:var(--ink)!important; }
  .ba-hero { background:var(--ink); color:#eee9df; padding:clamp(68px,10vw,126px) clamp(22px,11vw,170px) clamp(60px,8vw,100px); position:relative; overflow:hidden; }
  .ba-hero:after { content:"APPLICATIONS / 2025"; position:absolute; right:clamp(22px,6vw,90px); top:50%; writing-mode:vertical-rl; transform:rotate(180deg); font:10px "DM Mono"; letter-spacing:.18em; color:#aaa9a1; }
  .ba-kicker { color:#d4a492; font:11px "DM Mono"; letter-spacing:.13em; text-transform:uppercase; }
  .ba-hero h1 { font-size:clamp(65px,10vw,142px); line-height:.84; letter-spacing:-.08em; margin:33px 0 30px; max-width:800px; }
  .ba-hero h1 em { font-family:"Playfair Display",serif; color:#d6a18f; font-weight:600; }
  .ba-hero p { max-width:560px; color:#c6c8c3; font-size:17px; line-height:1.7; }
  .ba-layout { display:grid; grid-template-columns:220px minmax(0,690px); gap:clamp(34px,6vw,96px); padding:clamp(65px,9vw,120px) clamp(22px,11vw,170px); align-items:start; }
  .ba-sidebar { position:sticky; top:28px; }
  .ba-stepnav { border-top:1px solid #c8bdab; }
  .ba-step { display:flex; align-items:center; gap:12px; padding:14px 0; border-bottom:1px solid #d5cabb; color:#72736c; cursor:pointer; text-align:left; width:100%; }
  .ba-step:hover { color:var(--rust); }
  .ba-step.active { color:var(--ink); }
  .ba-step.done { color:#687168; }
  .ba-stepnum { width:24px; height:24px; border:1px solid #b9ab97; display:grid; place-items:center; font:10px "DM Mono"; }
  .ba-step.active .ba-stepnum { color:#f6eee5; background:var(--rust); border-color:var(--rust); }
  .ba-step.done .ba-stepnum { background:#d7cab4; color:var(--ink); }
  .ba-steplabel { font-size:12px; letter-spacing:.04em; }
  .ba-savenote { display:flex; gap:8px; margin-top:24px; color:#77766e; font-size:11px; line-height:1.6; }
  .ba-savenote svg { color:var(--rust); flex:none; }
  .ba-form { min-width:0; }
  .ba-progress { height:2px; background:#d5cabb; margin-bottom:47px; }
  .ba-progress span { display:block; height:100%; background:var(--rust); transition:width .4s ease; }
  .ba-stepheading { font-size:28px; letter-spacing:-.05em; margin-bottom:8px; }
  .ba-stephead { color:#646861; font-size:14px; line-height:1.65; margin-bottom:38px; }
  .ba-section { color:var(--rust); font:10px "DM Mono"; letter-spacing:.14em; text-transform:uppercase; border-bottom:1px solid #c8bdab; padding-bottom:10px; margin:34px 0 21px; }
  .ba-fields { display:flex; flex-direction:column; gap:18px; }
  .ba-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
  .ba-field { display:flex; flex-direction:column; gap:7px; }
  .ba-field > span { color:#5d635e; font-size:12px; line-height:1.4; }
  .ba-field small { color:#9b8f82; font-size:10px; }
  .ba-field input,.ba-field textarea { width:100%; border:1px solid #c8bdab; border-radius:0; background:#f3eee5; color:var(--ink); padding:12px 13px; font:13px Manrope,sans-serif; outline:none; transition:border-color .2s,background .2s; }
  .ba-field textarea { min-height:88px; resize:vertical; line-height:1.55; }
  .ba-field input:focus,.ba-field textarea:focus { border-color:var(--rust); background:#f7f1e8; }
  .ba-field input::placeholder,.ba-field textarea::placeholder { color:#aaa59b; }
  .ba-actions { display:flex; justify-content:space-between; align-items:center; border-top:1px solid #c8bdab; margin-top:43px; padding-top:23px; }
  .ba-primary,.ba-secondary { display:flex; align-items:center; gap:13px; padding:14px 17px; font-size:11px; font-weight:700; letter-spacing:.09em; text-transform:uppercase; cursor:pointer; }
  .ba-primary { background:var(--rust)!important; color:#fff!important; }
  .ba-primary:hover { background:#c26b55!important; transform:translateY(-2px); }
  .ba-secondary { color:#69706a!important; padding-left:0; }
  .ba-choice { display:flex; gap:9px; }
  .ba-choice label { display:flex; align-items:center; gap:7px; padding:10px 15px; border:1px solid #c8bdab; font-size:12px; color:#5d635e; cursor:pointer; }
  .ba-choice label:has(input:checked) { border-color:var(--rust); color:var(--ink); background:#e7d9c7; }
  .ba-choice input { accent-color:var(--rust); }
  .ba-conditional { display:none; margin-top:12px; }
  .ba-conditional.visible { display:block; }
  .ba-commitment,.ba-info { background:#e1d4bf; padding:21px 22px; margin:20px 0 30px; }
  .ba-commitment p,.ba-info p { color:#5f625c; font-size:15px; line-height:1.7; margin-bottom:16px; }
  .ba-check { display:flex; gap:10px; color:var(--ink); font-size:12px; line-height:1.5; cursor:pointer; }
  .ba-check input { accent-color:var(--rust); margin-top:2px; }
  .ba-info { display:flex; flex-direction:column; gap:10px; }
  .ba-info p { margin:0; display:flex; gap:8px; align-items:flex-start; }
  .ba-info svg { color:var(--rust); flex:none; margin-top:2px; }
  .ba-ref { border:1px solid #c8bdab; padding:21px; margin:13px 0; }
  .ba-refhead { display:flex; gap:12px; align-items:center; margin-bottom:21px; }
  .ba-badge { font:10px "DM Mono"; letter-spacing:.1em; text-transform:uppercase; padding:6px 9px; background:#d7cab4; color:var(--ink); }
  .ba-badge.husband { background:#ead0c4; color:#804332; }.ba-badge.wife { background:#d7ddd2; color:#4d6252; }
  .ba-ref h4 { font-size:14px; font-weight:600; }
  .ba-refnote { border-top:1px solid #d5cabb; margin-top:20px; padding-top:15px; color:#77766e; display:flex; gap:8px; font-size:11px; line-height:1.5; }
  .ba-success { padding:65px 0; }.ba-success h2 { font-size:64px; line-height:.9; letter-spacing:-.08em; margin:28px 0; }.ba-success h2 em { font-family:"Playfair Display"; color:var(--rust); }
  .form-step { display:none; }
  .form-step.active { display:block; }
  /* ---- Gravity Forms restyle (Bold Conviction) ---- */
  .ba-form .gform_wrapper.gravity-theme { font-family:Manrope,sans-serif; }
  .ba-form .gform_wrapper .gform_validation_errors { background:#f3e2dc; border:1px solid var(--rust); border-radius:0; box-shadow:none; padding:16px 18px; margin-bottom:30px; }
  .ba-form .gform_wrapper .gform_validation_errors > h2 { color:var(--rust); font:12px Manrope,sans-serif; font-weight:700; letter-spacing:.05em; }
  .ba-form .gform_wrapper .gf_page_steps { border:0; border-top:1px solid #c8bdab; padding:0 0 34px; margin-bottom:14px; display:flex; gap:4px; }
  .ba-form .gform_wrapper .gf_step { margin:0; padding:12px 14px 0 0; opacity:1; display:flex; align-items:center; gap:9px; }
  .ba-form .gform_wrapper .gf_step_number { width:24px; height:24px; border:1px solid #b9ab97; border-radius:0; background:transparent; display:grid; place-items:center; font:10px "DM Mono"; color:#72736c; }
  .ba-form .gform_wrapper .gf_step_active .gf_step_number { color:#f6eee5; background:var(--rust); border-color:var(--rust); }
  .ba-form .gform_wrapper .gf_step_completed .gf_step_number { background:#d7cab4; color:var(--ink); border-color:#d7cab4; }
  .ba-form .gform_wrapper .gf_step_completed .gf_step_number:before, .ba-form .gform_wrapper .gf_step_completed .gf_step_number:after { display:none; }
  .ba-form .gform_wrapper .gf_step_label { font-size:11px; letter-spacing:.04em; color:#72736c; font-family:Manrope,sans-serif; font-weight:600; }
  .ba-form .gform_wrapper .gf_step_active .gf_step_label { color:var(--ink); }
  .ba-form .gform_wrapper .gf_progressbar_wrapper { margin-bottom:47px; }
  .ba-form .gform_wrapper .gf_progressbar { height:2px; background:#d5cabb; border-radius:0; padding:0; }
  .ba-form .gform_wrapper .gf_progressbar_percentage { height:2px; background:var(--rust); border-radius:0; font-size:0; min-width:0; }
  .ba-form .gform_wrapper .gf_progressbar_title { font:10px "DM Mono"; letter-spacing:.14em; text-transform:uppercase; color:var(--rust); margin-bottom:10px; }
  .ba-form .gform_wrapper .gsection { border-bottom:1px solid #c8bdab; padding:0 0 10px; margin:34px 0 5px; }
  .ba-form .gform_wrapper .gsection .gsection_title { color:var(--rust); font:10px "DM Mono"; letter-spacing:.14em; text-transform:uppercase; }
  .ba-form .gform_wrapper .gfield_label { color:#5d635e; font-size:12px; font-weight:400; line-height:1.4; font-family:Manrope,sans-serif; letter-spacing:0; }
  .ba-form .gform_wrapper .gfield_required { color:var(--rust); }
  .ba-form .gform_wrapper input[type=text], .ba-form .gform_wrapper input[type=email], .ba-form .gform_wrapper input[type=tel], .ba-form .gform_wrapper input[type=number], .ba-form .gform_wrapper select, .ba-form .gform_wrapper textarea { width:100%; border:1px solid #c8bdab; border-radius:0; background:#f3eee5; color:var(--ink); padding:12px 13px; font:13px Manrope,sans-serif; outline:none; transition:border-color .2s, background .2s; }
  .ba-form .gform_wrapper textarea { min-height:88px; resize:vertical; line-height:1.55; }
  .ba-form .gform_wrapper input:focus, .ba-form .gform_wrapper textarea:focus, .ba-form .gform_wrapper select:focus { border-color:var(--rust); background:#f7f1e8; box-shadow:none; }
  .ba-form .gform_wrapper input::placeholder, .ba-form .gform_wrapper textarea::placeholder { color:#aaa59b; }
  .ba-form .gform_wrapper .gfield_description { color:#77766e; font-size:12px; line-height:1.6; }
  .ba-form .gform_wrapper .gfield_radio { display:flex; gap:9px; }
  .ba-form .gform_wrapper .gfield_radio .gchoice { display:flex; }
  .ba-form .gform_wrapper .gfield_radio label { display:flex; align-items:center; gap:7px; padding:10px 15px; border:1px solid #c8bdab; font-size:12px; color:#5d635e; cursor:pointer; margin:0; max-width:none; }
  .ba-form .gform_wrapper .gfield_radio .gchoice:has(input:checked) label { border-color:var(--rust); color:var(--ink); background:#e7d9c7; }
  .ba-form .gform_wrapper .gfield_radio input, .ba-form .gform_wrapper .gfield_checkbox input { accent-color:var(--rust); }
  .ba-form .gform_wrapper .gfield_radio input { position:static; margin:0; }
  .ba-form .gform_wrapper .gfield.clf-commitment { background:#e1d4bf; padding:21px 22px; }
  .ba-form .gform_wrapper .gfield.clf-commitment .gfield_description { color:#5f625c; font-size:15px; line-height:1.7; margin-bottom:16px; padding-top:0; }
  .ba-form .gform_wrapper .gfield_checkbox label { color:var(--ink); font-size:12px; line-height:1.5; cursor:pointer; max-width:none; }
  .ba-form .gform_wrapper .gform_page_footer, .ba-form .gform_wrapper .gform_footer { display:flex; justify-content:space-between; align-items:center; border-top:1px solid #c8bdab; margin-top:43px; padding:23px 0 0; }
  .ba-form .gform_wrapper .gform_next_button, .ba-form .gform_wrapper .gform_button { background:var(--rust)!important; color:#fff!important; border:0; border-radius:0; padding:14px 17px; font:11px Manrope,sans-serif; font-weight:700; letter-spacing:.09em; text-transform:uppercase; cursor:pointer; margin-left:auto; transition:background .2s, transform .2s; }
  .ba-form .gform_wrapper .gform_next_button:hover, .ba-form .gform_wrapper .gform_button:hover { background:#c26b55!important; transform:translateY(-2px); }
  .ba-form .gform_wrapper .gform_previous_button { background:transparent; border:0; color:#69706a!important; padding:14px 17px 14px 0; font:11px Manrope,sans-serif; font-weight:700; letter-spacing:.09em; text-transform:uppercase; cursor:pointer; }
  .ba-form .gform_wrapper .gform_save_link { color:var(--rust); font-size:11px; letter-spacing:.05em; text-transform:uppercase; font-weight:700; }
  .ba-form .gform_wrapper .gfield_error input, .ba-form .gform_wrapper .gfield_error textarea { border-color:var(--rust); }
  .ba-form .gform_wrapper .gfield_error .gfield_label { color:var(--rust); }
  .ba-form .gform_wrapper .gfield_validation_message, .ba-form .gform_wrapper .validation_message { background:transparent; border:0; color:var(--rust); font-size:11px; padding:6px 0 0; }
  .ba-form .gform_wrapper .form_saved_message, .ba-form .gform_wrapper .form_saved_message_sent { background:#e1d4bf; border:0; border-radius:0; color:var(--ink); font-size:14px; line-height:1.7; padding:28px 30px; text-align:left; }
  .ba-form .gform_wrapper .form_saved_message form { margin-top:18px; }
  .ba-form .gform_wrapper .form_saved_message input[type=email], .ba-form .gform_wrapper .form_saved_message input[type=text] { max-width:340px; margin-bottom:12px; }
  .ba-form .gform_wrapper .form_saved_message input[type=submit], .ba-form .gform_wrapper .form_saved_message button { background:var(--rust)!important; color:#fff!important; border:0; border-radius:0; padding:14px 17px; font:11px Manrope,sans-serif; font-weight:700; letter-spacing:.09em; text-transform:uppercase; cursor:pointer; }
  .ba-form .gform_wrapper .resume_form_link_wrapper { word-break:break-all; }
  @media(max-width:720px){ .ba-form .gform_wrapper .gf_page_steps { flex-wrap:wrap; } }
  @media(min-width:1500px){ .ba-hero h1{font-size:clamp(65px,10vw,190px);max-width:60vw} }
  @media(max-width:720px){ .ba-hero:after{display:none}.ba-hero{padding:65px 22px 68px}.ba-hero h1{font-size:75px}.ba-layout{display:block;padding:62px 22px}.ba-sidebar{position:static;margin-bottom:55px}.ba-stepnav{display:grid;grid-template-columns:repeat(5,1fr);gap:4px}.ba-step{display:block;padding:10px 0;border-bottom:2px solid #c8bdab}.ba-step.active{border-color:var(--rust)}.ba-stepnum{margin-bottom:8px}.ba-steplabel{font-size:10px;line-height:1.2}.ba-savenote{max-width:310px}.ba-row{grid-template-columns:1fr}.ba-stepheading{font-size:25px}.ba-success h2{font-size:59px} }
</style>

<header class="ba-hero clf-reveal">
  <p class="ba-kicker"><?php echo esc_html( get_bloginfo( 'name' ) ?: 'Charlotte Leadership Forum' ); ?> <span>— applications</span></p>
  <h1>Make room<br>for <em>more.</em></h1>
  <?php if ( has_excerpt() ) : ?>
    <p><?php echo esc_html( get_the_excerpt() ); ?></p>
  <?php else : ?>
    <p>We accept a small group of couples each year. Applications take about 30&ndash;40 minutes &mdash; you can save your progress and return at any time.</p>
  <?php endif; ?>
</header>

<div class="ba-layout">
  <aside class="ba-sidebar clf-reveal">
    <?php if ( ! $clf_use_gf ) : ?>
    <div class="ba-stepnav" id="stepNav">
      <button type="button" class="ba-step step-item active" onclick="clfGoTo(1)"><span class="ba-stepnum">01</span><span class="ba-steplabel">About you</span></button>
      <button type="button" class="ba-step step-item" onclick="clfGoTo(2)"><span class="ba-stepnum">02</span><span class="ba-steplabel">Your work</span></button>
      <button type="button" class="ba-step step-item" onclick="clfGoTo(3)"><span class="ba-stepnum">03</span><span class="ba-steplabel">Your faith</span></button>
      <button type="button" class="ba-step step-item" onclick="clfGoTo(4)"><span class="ba-stepnum">04</span><span class="ba-steplabel">Your goals</span></button>
      <button type="button" class="ba-step step-item" onclick="clfGoTo(5)"><span class="ba-stepnum">05</span><span class="ba-steplabel">References</span></button>
    </div>
    <?php endif; ?>
    <div class="ba-savenote"><?php clf_icon( 'save', 14 ); ?> <?php echo $clf_use_gf ? 'Use &ldquo;Save and continue later&rdquo; at the bottom of any step and we&rsquo;ll email you a link to pick up where you left off.' : "Your progress is saved automatically. We'll email you a link to return at any time."; ?></div>
  </aside>

  <section class="ba-form clf-reveal">
    <?php if ( $clf_use_gf ) : ?>
      <?php /* ajax=false: AJAX embedding breaks GF's Save & Continue screen */ ?>
      <?php gravity_form( $clf_gf_id, false, false, false, null, false ); ?>
    <?php else : ?>
    <div class="ba-progress"><span id="progressFill" style="width:20%;"></span></div>

    <!-- STEP 1: About you -->
    <div class="form-step active" id="step1">
      <h2 class="ba-stepheading">About you</h2>
      <p class="ba-stephead">Basic information about both of you as a couple.</p>

      <div class="ba-section">Husband</div>
      <div class="ba-fields">
        <div class="ba-row">
          <label class="ba-field"><span>First name</span><input type="text" name="h_first" placeholder="James"></label>
          <label class="ba-field"><span>Last name</span><input type="text" name="h_last" placeholder="Smith"></label>
        </div>
        <div class="ba-row">
          <label class="ba-field"><span>Name tag preference</span><input type="text" name="h_nametag" placeholder="What should your name tag say?"></label>
          <label class="ba-field"><span>Date of birth</span><input type="text" name="h_dob" placeholder="MM/DD/YYYY"></label>
        </div>
        <div class="ba-row">
          <label class="ba-field"><span>Mobile number</span><input type="tel" name="h_phone" placeholder="704-555-0100"></label>
          <label class="ba-field"><span>Email address</span><input type="email" name="h_email" placeholder="james@email.com"></label>
        </div>
      </div>

      <div class="ba-section">Wife</div>
      <div class="ba-fields">
        <div class="ba-row">
          <label class="ba-field"><span>First name</span><input type="text" name="w_first" placeholder="Sarah"></label>
          <label class="ba-field"><span>Last name</span><input type="text" name="w_last" placeholder="Smith"></label>
        </div>
        <div class="ba-row">
          <label class="ba-field"><span>Name tag preference</span><input type="text" name="w_nametag" placeholder="What should your name tag say?"></label>
          <label class="ba-field"><span>Date of birth</span><input type="text" name="w_dob" placeholder="MM/DD/YYYY"></label>
        </div>
        <div class="ba-row">
          <label class="ba-field"><span>Mobile number</span><input type="tel" name="w_phone" placeholder="704-555-0101"></label>
          <label class="ba-field"><span>Email address</span><input type="email" name="w_email" placeholder="sarah@email.com"></label>
        </div>
      </div>

      <div class="ba-section">Together</div>
      <div class="ba-fields">
        <label class="ba-field"><span>Home address</span><input type="text" name="address" placeholder="Street address"></label>
        <div class="ba-row">
          <label class="ba-field"><span>City</span><input type="text" name="city" placeholder="Charlotte"></label>
          <label class="ba-field"><span>ZIP code</span><input type="text" name="zip" placeholder="28202"></label>
        </div>
        <div class="ba-row">
          <label class="ba-field"><span>Wedding date</span><input type="text" name="wedding_date" placeholder="Month, Year"></label>
          <label class="ba-field"><span>Children's names and ages<small> (optional)</small></span><input type="text" name="children" placeholder="e.g. Emma (4), Jack (2)"></label>
        </div>
      </div>

      <div class="ba-section">Education</div>
      <div class="ba-fields">
        <label class="ba-field"><span>Husband — school, degree(s), major, graduation year</span><textarea name="h_education" placeholder="e.g. UNC Charlotte, B.S. Business Administration, 2015"></textarea></label>
        <label class="ba-field"><span>Wife — school, degree(s), major, graduation year</span><textarea name="w_education" placeholder="e.g. Queens University, B.A. Communications, 2016"></textarea></label>
      </div>

      <div class="ba-actions">
        <span></span>
        <button type="button" class="ba-primary" onclick="clfGoTo(2)">Continue <?php clf_icon( 'arrow-right', 16 ); ?></button>
      </div>
    </div>

    <!-- STEP 2: Your work -->
    <div class="form-step" id="step2">
      <h2 class="ba-stepheading">Your work</h2>
      <p class="ba-stephead">Tell us about your professional experience. List your current or most recent position first.</p>

      <div class="ba-section">Husband's employment</div>
      <div class="ba-fields">
        <label class="ba-field"><span>Organization, location, position, responsibilities, and dates</span><textarea name="h_employment" placeholder="Company name / Charlotte, NC / Marketing Director / Led a team of 6, managed $2M budget / 2019–present"></textarea></label>
      </div>

      <div class="ba-section">Wife's employment</div>
      <div class="ba-fields">
        <label class="ba-field"><span>Organization, location, position, responsibilities, and dates</span><textarea name="w_employment" placeholder="Company name / Charlotte, NC / Account Manager / Managed key client relationships / 2020–present"></textarea></label>
      </div>

      <div class="ba-actions">
        <button type="button" class="ba-secondary" onclick="clfGoTo(1)"><?php clf_icon( 'arrow-left', 16 ); ?> Back</button>
        <button type="button" class="ba-primary" onclick="clfGoTo(3)">Continue <?php clf_icon( 'arrow-right', 16 ); ?></button>
      </div>
    </div>

    <!-- STEP 3: Your faith -->
    <div class="form-step" id="step3">
      <h2 class="ba-stepheading">Your faith</h2>
      <p class="ba-stephead">CLF is grounded in Scripture and rooted in community. Help us understand where you are spiritually.</p>

      <div class="ba-section">Your church</div>
      <div class="ba-fields">
        <div class="ba-row">
          <label class="ba-field"><span>Church name</span><input type="text" name="church_name" placeholder="Church name"></label>
          <label class="ba-field"><span>Church phone number</span><input type="tel" name="church_phone" placeholder="704-555-0200"></label>
        </div>
        <div class="ba-row">
          <label class="ba-field"><span>Pastor's name</span><input type="text" name="pastor_name" placeholder="Full name"></label>
          <label class="ba-field"><span>Church website</span><input type="text" name="church_website" placeholder="www.yourchurch.com"></label>
        </div>
      </div>

      <div class="ba-section">Faith journey</div>
      <div class="ba-fields">
        <label class="ba-field"><span>Husband — briefly describe your conversion experience</span><textarea name="h_faith" placeholder="Share as much or as little as you'd like..."></textarea></label>
        <label class="ba-field"><span>Wife — briefly describe your conversion experience</span><textarea name="w_faith" placeholder="Share as much or as little as you'd like..."></textarea></label>
      </div>

      <div class="ba-section">Mentoring</div>
      <div class="ba-fields">
        <div class="ba-field">
          <span>Husband — do you currently have a mentor relationship with an older mentor?</span>
          <div class="ba-choice">
            <label><input type="radio" name="hMentor" value="yes" onchange="clfToggle('hMentorDetail', true)"> Yes</label>
            <label><input type="radio" name="hMentor" value="no" onchange="clfToggle('hMentorDetail', false)"> No</label>
          </div>
          <div class="ba-conditional" id="hMentorDetail">
            <label class="ba-field"><span>Describe the length and nature of this relationship</span><textarea name="h_mentor_detail" placeholder="How long, how often you meet, what you discuss..."></textarea></label>
          </div>
        </div>
        <div class="ba-field">
          <span>Wife — do you currently have a mentor relationship with an older mentor?<small> (optional to participate in CLF)</small></span>
          <div class="ba-choice">
            <label><input type="radio" name="wMentor" value="yes" onchange="clfToggle('wMentorDetail', true)"> Yes</label>
            <label><input type="radio" name="wMentor" value="no" onchange="clfToggle('wMentorDetail', false)"> No</label>
          </div>
          <div class="ba-conditional" id="wMentorDetail">
            <label class="ba-field"><span>Describe the length and nature of this relationship</span><textarea name="w_mentor_detail" placeholder="How long, how often you meet, what you discuss..."></textarea></label>
          </div>
        </div>
      </div>

      <div class="ba-section">Peer groups</div>
      <div class="ba-fields">
        <div class="ba-field">
          <span>Husband — do you currently meet with a group of peers for ministry and personal growth?</span>
          <div class="ba-choice">
            <label><input type="radio" name="hGroup" value="yes" onchange="clfToggle('hGroupDetail', true)"> Yes</label>
            <label><input type="radio" name="hGroup" value="no" onchange="clfToggle('hGroupDetail', false)"> No</label>
          </div>
          <div class="ba-conditional" id="hGroupDetail">
            <label class="ba-field"><span>Describe the length and nature of this group</span><textarea name="h_group_detail" placeholder="How long, how often you meet, what you discuss..."></textarea></label>
          </div>
        </div>
        <div class="ba-field">
          <span>Wife — do you currently meet with a group of peers for ministry and personal growth?</span>
          <div class="ba-choice">
            <label><input type="radio" name="wGroup" value="yes" onchange="clfToggle('wGroupDetail', true)"> Yes</label>
            <label><input type="radio" name="wGroup" value="no" onchange="clfToggle('wGroupDetail', false)"> No</label>
          </div>
          <div class="ba-conditional" id="wGroupDetail">
            <label class="ba-field"><span>Describe the length and nature of this group</span><textarea name="w_group_detail" placeholder="How long, how often you meet, what you discuss..."></textarea></label>
          </div>
        </div>
      </div>

      <div class="ba-actions">
        <button type="button" class="ba-secondary" onclick="clfGoTo(2)"><?php clf_icon( 'arrow-left', 16 ); ?> Back</button>
        <button type="button" class="ba-primary" onclick="clfGoTo(4)">Continue <?php clf_icon( 'arrow-right', 16 ); ?></button>
      </div>
    </div>

    <!-- STEP 4: Your goals -->
    <div class="form-step" id="step4">
      <h2 class="ba-stepheading">Your goals</h2>
      <p class="ba-stephead">Help us understand what you're hoping to accomplish — and confirm your commitment to the experience.</p>

      <div class="ba-section">Leadership</div>
      <div class="ba-fields">
        <label class="ba-field"><span>Briefly describe a significant achievement in leadership for each of you as a couple</span><textarea name="leadership_achievement" placeholder="Tell us about a time you led something together or individually that you're proud of..."></textarea></label>
      </div>

      <div class="ba-section">Development objectives</div>
      <div class="ba-fields">
        <label class="ba-field"><span>Why do you want to participate in CLF? State three clear development objectives.</span><textarea name="objectives_intro" placeholder="What is one specific area of growth you're pursuing?"></textarea></label>
        <label class="ba-field"><span>Objective 1</span><textarea name="objective_1" placeholder="What is one specific area of growth you're pursuing?"></textarea></label>
        <label class="ba-field"><span>Objective 2</span><textarea name="objective_2" placeholder="A second area of growth..."></textarea></label>
        <label class="ba-field"><span>Objective 3</span><textarea name="objective_3" placeholder="A third area of growth..."></textarea></label>
      </div>

      <div class="ba-section">Commitment</div>
      <div class="ba-commitment">
        <p>CLF is an 18-month experience that includes 6 retreats, 13 dinner gatherings, monthly mentoring, and weekly or bi-weekly small groups. We ask that both partners are fully committed to participating throughout the duration.</p>
        <label class="ba-check"><input type="checkbox" name="commitment"> We have read and understand the time requirements of the CLF experience, and we are both committed to participating fully for the full 18 months.</label>
      </div>

      <div class="ba-section">Signatures</div>
      <div class="ba-fields">
        <label class="ba-field"><span>Husband — e-signature (type your full name)</span><input type="text" name="h_signature" placeholder="James Smith"></label>
        <label class="ba-field"><span>Wife — e-signature (type your full name)</span><input type="text" name="w_signature" placeholder="Sarah Smith"></label>
      </div>

      <div class="ba-actions">
        <button type="button" class="ba-secondary" onclick="clfGoTo(3)"><?php clf_icon( 'arrow-left', 16 ); ?> Back</button>
        <button type="button" class="ba-primary" onclick="clfGoTo(5)">Continue <?php clf_icon( 'arrow-right', 16 ); ?></button>
      </div>
    </div>

    <!-- STEP 5: References -->
    <div class="form-step" id="step5">
      <h2 class="ba-stepheading">References</h2>
      <p class="ba-stephead">We require five references. Once you submit, each reference will automatically receive a personalized email from CLF with a short form to complete.</p>

      <div class="ba-info">
        <p><?php clf_icon( 'send', 14 ); ?> References receive an automatic email from CLF immediately after you submit</p>
        <p><?php clf_icon( 'chevron-right', 14 ); ?> Their form takes about 10 minutes and is tailored to their role</p>
        <p><?php clf_icon( 'shield-check', 14 ); ?> All responses are confidential</p>
      </div>

      <div class="ba-ref">
        <div class="ba-refhead"><span class="ba-badge couple">Couple</span><h4>Church pastor</h4></div>
        <div class="ba-fields">
          <div class="ba-row">
            <label class="ba-field"><span>Pastor's name</span><input type="text" name="ref1_name" placeholder="Full name"></label>
            <label class="ba-field"><span>Email address</span><input type="email" name="ref1_email" placeholder="pastor@church.com"></label>
          </div>
          <div class="ba-row">
            <label class="ba-field"><span>Phone number</span><input type="tel" name="ref1_phone" placeholder="704-555-0200"></label>
            <label class="ba-field"><span>Relationship</span><input type="text" name="ref1_relationship" placeholder="Church pastor"></label>
          </div>
        </div>
      </div>

      <div class="ba-ref">
        <div class="ba-refhead"><span class="ba-badge husband">Husband</span><h4>Reference 1 — manager or supervisor</h4></div>
        <div class="ba-fields">
          <div class="ba-row">
            <label class="ba-field"><span>Name</span><input type="text" name="ref2_name" placeholder="Full name"></label>
            <label class="ba-field"><span>Email address</span><input type="email" name="ref2_email" placeholder="email@company.com"></label>
          </div>
          <div class="ba-row">
            <label class="ba-field"><span>Phone number</span><input type="tel" name="ref2_phone" placeholder="704-555-0200"></label>
            <label class="ba-field"><span>Relationship</span><input type="text" name="ref2_relationship" placeholder="e.g. Work colleague"></label>
          </div>
        </div>
      </div>

      <div class="ba-ref">
        <div class="ba-refhead"><span class="ba-badge husband">Husband</span><h4>Reference 2 — peer</h4></div>
        <div class="ba-fields">
          <div class="ba-row">
            <label class="ba-field"><span>Name</span><input type="text" name="ref3_name" placeholder="Full name"></label>
            <label class="ba-field"><span>Email address</span><input type="email" name="ref3_email" placeholder="email@company.com"></label>
          </div>
          <div class="ba-row">
            <label class="ba-field"><span>Phone number</span><input type="tel" name="ref3_phone" placeholder="704-555-0200"></label>
            <label class="ba-field"><span>Relationship</span><input type="text" name="ref3_relationship" placeholder="e.g. Work colleague"></label>
          </div>
        </div>
      </div>

      <div class="ba-ref">
        <div class="ba-refhead"><span class="ba-badge wife">Wife</span><h4>Reference 1 — mentor or manager</h4></div>
        <div class="ba-fields">
          <div class="ba-row">
            <label class="ba-field"><span>Name</span><input type="text" name="ref4_name" placeholder="Full name"></label>
            <label class="ba-field"><span>Email address</span><input type="email" name="ref4_email" placeholder="email@company.com"></label>
          </div>
          <div class="ba-row">
            <label class="ba-field"><span>Phone number</span><input type="tel" name="ref4_phone" placeholder="704-555-0200"></label>
            <label class="ba-field"><span>Relationship</span><input type="text" name="ref4_relationship" placeholder="e.g. Work colleague"></label>
          </div>
        </div>
      </div>

      <div class="ba-ref">
        <div class="ba-refhead"><span class="ba-badge wife">Wife</span><h4>Reference 2 — peer</h4></div>
        <div class="ba-fields">
          <div class="ba-row">
            <label class="ba-field"><span>Name</span><input type="text" name="ref5_name" placeholder="Full name"></label>
            <label class="ba-field"><span>Email address</span><input type="email" name="ref5_email" placeholder="email@company.com"></label>
          </div>
          <div class="ba-row">
            <label class="ba-field"><span>Phone number</span><input type="tel" name="ref5_phone" placeholder="704-555-0200"></label>
            <label class="ba-field"><span>Relationship</span><input type="text" name="ref5_relationship" placeholder="e.g. Work colleague"></label>
          </div>
        </div>
        <div class="ba-refnote"><?php clf_icon( 'send', 14 ); ?> After you submit, all five references will automatically receive a personalized email from CLF.</div>
      </div>

      <div class="ba-actions">
        <button type="button" class="ba-secondary" onclick="clfGoTo(4)"><?php clf_icon( 'arrow-left', 16 ); ?> Back</button>
        <button type="button" class="ba-primary" id="baSubmit">Submit application <?php clf_icon( 'check', 16 ); ?></button>
      </div>
    </div>

    <!-- Success state (shown after submit).
         NOTE: Online submission is not wired to a backend yet (form plugin decision pending).
         Until it is, the success message asks applicants to email their application. -->
    <div class="ba-success" id="baSuccess" style="display:none;">
      <p class="ba-kicker">One more step</p>
      <h2>Almost<br><em>there.</em></h2>
      <p class="ba-stephead">Online submission is coming soon. For now, please email your completed application details to <a href="mailto:<?php echo esc_attr( clf_get( 'clf_contact_email', 'info@charlotteforum.org' ) ); ?>" style="color:var(--rust);"><?php echo esc_html( clf_get( 'clf_contact_email', 'info@charlotteforum.org' ) ); ?></a> and we&rsquo;ll take it from there.</p>
    </div>
    <?php endif; ?>
  </section>
</div>

<script>
(function () {
  var submit = document.getElementById('baSubmit');
  if (submit) {
    submit.addEventListener('click', function () {
      document.querySelectorAll('.form-step').forEach(function (el) { el.classList.remove('active'); });
      var progress = document.getElementById('progressFill');
      if (progress) { progress.style.width = '100%'; }
      var success = document.getElementById('baSuccess');
      if (success) { success.style.display = 'block'; }
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }
})();
</script>

<?php get_footer(); ?>
