<?php
/**
 * Template Name: Our Story
 * Template Post Type: page
 */
$GLOBALS['clf_page_class'] = 'clf-story';
get_header();
if ( have_posts() ) { the_post(); }
?>

<style>
  .clf-story .story-hero{min-height:680px;height:78svh;max-height:820px;position:relative;background:#18283a;color:#f4efe6;display:flex;align-items:end}
  .clf-story .story-hero:before{content:"";position:absolute;inset:0;background:url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/clf-hero-story.jpg') center 42%/cover no-repeat;opacity:.32;filter:saturate(.65)}
  .clf-story .story-hero:after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(15,28,42,.98) 4%,rgba(15,28,42,.72) 58%,rgba(15,28,42,.3))}
  .story-hero-inner{position:relative;z-index:1;margin:0 clamp(22px,11vw,170px) 86px;max-width:850px}
  .story-hero h1{font-size:clamp(58px,9vw,134px);line-height:.88;letter-spacing:-.085em;margin:27px 0 28px}
  .story-hero h1 em,.story-band h2 em{font-family:"Playfair Display",serif;color:#d6a18f;font-weight:600}
  .story-hero p{font-size:17px;line-height:1.7;max-width:520px;color:#d9d9d3}
  .story-hero-side{position:absolute;right:42px;bottom:95px;z-index:2;font:10px "DM Mono";letter-spacing:.18em;writing-mode:vertical-rl;transform:rotate(180deg);color:#d2cfc5}
  .story-intro{background:#d8cbb5;padding:65px clamp(22px,11vw,170px);display:grid;grid-template-columns:repeat(4,1fr);gap:30px;border-bottom:1px solid #c4b69f}
  .story-intro strong{font-size:44px;letter-spacing:-.07em}.story-intro p{font-size:13px;margin-top:8px;color:#5c5b55}.story-intro-note{font:italic 17px "Playfair Display";line-height:1.3;align-self:center}
  .story-section{padding:125px clamp(22px,11vw,170px);background:var(--paper)}
  .story-two{display:grid;grid-template-columns:1fr 2fr;gap:3rem;align-items:start}
  .story-label{font:11px "DM Mono";letter-spacing:.13em;text-transform:uppercase;color:var(--rust);padding-top:5px}
  .story-copy p{font-size:17px;line-height:1.8;color:#56606a;max-width:640px;margin-bottom:21px}
  .story-copy p:last-child{margin-bottom:0}
  .story-pull{font:italic clamp(28px,3.2vw,47px) "Playfair Display";line-height:1.12;color:var(--ink);border-left:2px solid var(--rust);padding:7px 0 7px 28px;margin:42px 0;max-width:660px}
  .story-section.alt{background:#e1d5c1}.story-section.dark{background:var(--ink);color:var(--paper)}
  .story-section.dark .story-label{color:#d4a492}.story-section.dark .story-copy p{color:#b4b8b4}
  .story-heading{font-size:clamp(48px,6vw,88px);line-height:.9;letter-spacing:-.08em;margin:0 0 60px}
  .founder-grid{display:grid;grid-template-columns:repeat(4,1fr);border-top:1px solid #c8bdab}
  .founder-card{padding:25px 20px 28px 0;border-right:1px solid #c8bdab;min-height:180px}.founder-card:not(:first-child){padding-left:20px}.founder-card:last-child{border-right:0}
  .initials-story{width:43px;height:43px;border:1px solid #b9ab98;display:flex;align-items:center;justify-content:center;font:11px "DM Mono";color:var(--rust);margin-bottom:46px}
  .founder-name{font-size:17px;font-weight:700}.founder-note{font:10px "DM Mono";color:#6a6b64;margin-top:8px;text-transform:uppercase;letter-spacing:.08em}
  .timeline{border-top:1px solid #4b5763}.timeline-item{display:grid;grid-template-columns:140px 1fr;gap:30px;padding:28px 0;border-bottom:1px solid #4b5763}.timeline-year{font:10px "DM Mono";letter-spacing:.1em;color:#d4a492;text-transform:uppercase}.timeline-body h4{font-size:21px;margin-bottom:10px}.timeline-body p{font-size:16px;line-height:1.65;color:#b4b8b4;max-width:590px}
  .leader-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:#4b5763}.leader-card{background:var(--ink);padding:18px;display:flex;gap:12px;align-items:center;min-height:80px}.leader-name{font-size:13px}.leader-initials{font:10px "DM Mono";color:#d4a492;border:1px solid #53606a;width:31px;height:31px;display:flex;align-items:center;justify-content:center;flex:none}
  .testimonial-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:#c8bdab}.testimonial-card{background:#e1d5c1;padding:28px 22px 31px;min-height:245px}.testimonial-text{font:italic 18px/1.45 "Playfair Display";margin-bottom:33px}.testimonial-attribution{font-size:11px;font-weight:700}.testimonial-year{font:10px "DM Mono";color:#6b6d67;margin-top:7px}
  .story-band{background:var(--rust);color:#f7eee5;padding:92px clamp(22px,11vw,170px);display:flex;justify-content:space-between;align-items:end;gap:40px}.story-band h2{font-size:clamp(48px,6vw,83px);line-height:.9;letter-spacing:-.08em;margin:28px 0 23px}.story-band p{max-width:450px;color:#f0c3b1;font-size:16px;line-height:1.7}.story-band a{background:#f7eee5;color:var(--ink);padding:16px 19px;display:flex;gap:20px;align-items:center;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;white-space:nowrap}
  @media(min-width:1500px){.story-hero-inner{max-width:60vw}.story-hero h1{font-size:clamp(58px,9vw,180px)}}
  @media(max-width:720px){.clf-story .story-hero{min-height:670px!important}.story-hero-inner{margin:0 22px 70px}.story-hero h1{font-size:67px}.story-hero-side{display:none}.story-intro{grid-template-columns:repeat(2,1fr);padding:43px 22px}.story-intro-note{grid-column:span 2}.story-section{padding:78px 22px}.story-two{display:block}.story-label{margin-bottom:55px}.story-heading{font-size:61px;margin-bottom:45px}.founder-grid{grid-template-columns:1fr 1fr}.founder-card:nth-child(2){border-right:0}.founder-card:nth-child(3),.founder-card:nth-child(4){border-top:1px solid #c8bdab}.timeline-item{grid-template-columns:85px 1fr;gap:14px}.leader-grid,.testimonial-grid{grid-template-columns:1fr}.story-band{display:block;padding:78px 22px}.story-band a{margin-top:40px}}
</style>

<section class="story-hero" id="story-top">
  <div class="story-hero-inner clf-reveal">
    <p class="clf-kicker">Our story <span>&mdash; since 1995</span></p>
    <h1><?php the_title(); ?></h1>
    <?php if ( has_excerpt() ) : ?>
      <p><?php echo esc_html( get_the_excerpt() ); ?></p>
    <?php else : ?>
      <p>CLF was born out of friendship &mdash; and a deep conviction that the best thing older leaders can do is pour into younger ones.</p>
    <?php endif; ?>
  </div>
  <div class="story-hero-side">CHARLOTTE, NORTH CAROLINA <span>&#8600;</span></div>
  <div class="clf-scroll">SCROLL TO EXPLORE <span></span></div>
</section>

<section class="story-intro clf-reveal">
  <div><strong><?php echo esc_html( clf_get( 'clf_stat_1_num', '30+' ) ); ?></strong><p><?php echo esc_html( clf_get( 'clf_stat_1_label', 'Years of impact' ) ); ?></p></div>
  <div><strong><?php echo esc_html( clf_get( 'clf_stat_2_num', '~375' ) ); ?></strong><p><?php echo esc_html( clf_get( 'clf_stat_2_label', "Couples who've participated" ) ); ?></p></div>
  <div><strong><?php echo esc_html( clf_get( 'clf_stat_3_num', '15' ) ); ?></strong><p><?php echo esc_html( clf_get( 'clf_stat_3_label', 'Classes since 1995' ) ); ?></p></div>
  <div class="story-intro-note">A legacy carried<br><em>person to person.</em></div>
</section>

<section class="story-section" id="story-mission">
  <div class="story-two">
    <div class="story-label clf-reveal">01 / How it began</div>
    <div class="story-copy clf-reveal">
      <?php if ( get_the_content() ) : ?>
        <div class="clf-wpcontent"><?php the_content(); ?></div>
      <?php else : ?>
        <p>The idea behind CLF grew out of the desire of four men &mdash; Sam Cornwell, Steady Cash, Don Wrigley, and Bud Carrier &mdash; to help younger men grow in their relationship with God and in their effectiveness as leaders in their families, churches, and communities.</p>
        <p>These four friends, all in their 50s and 60s, had been meeting weekly for over 20 years, sharing their lives with one another. During those years together, they often discussed their concern for young family men caught in the middle of competing demands on their time and resources.</p>
        <div class="story-pull">What if we helped young leaders develop a vision for God's call on their lives &mdash; and then helped them learn how to live it out?</div>
        <p>That question became CLF. In 1995, the Charlotte Leadership Forum welcomed its first cohort.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="story-section alt clf-reveal">
  <div class="story-two">
    <div class="story-label">02 / The founders</div>
    <div>
      <h2 class="story-heading">Four friends.<br><em>One conviction.</em></h2>
      <div class="founder-grid">
        <?php
        $founders = array(
          array( 'SC', 'Sam Cornwell' ),
          array( 'SC', 'Steady Cash' ),
          array( 'DW', 'Don Wrigley' ),
          array( 'BC', 'Bud Carrier' ),
        );
        foreach ( $founders as $f ) : ?>
          <article class="founder-card">
            <div class="initials-story"><?php echo esc_html( $f[0] ); ?></div>
            <div class="founder-name"><?php echo esc_html( $f[1] ); ?></div>
            <div class="founder-note">Co-founder</div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<section class="story-section dark" id="story-experience">
  <div class="story-two">
    <div class="story-label clf-reveal">03 / How we've grown</div>
    <div class="clf-reveal">
      <h2 class="story-heading">Still moving<br><em>forward.</em></h2>
      <div class="timeline">
        <?php
        $timeline = array(
          array( '1995', 'CLF begins in Charlotte', 'Four friends launch the Charlotte Leadership Forum with a small cohort of young married couples, focused on purpose, faith, and leadership development.' ),
          array( 'Expanded', "Women's programming deepens", "The women's portion of the experience grows well beyond the original vision — with its own retreats, mentoring, and community that stand as a full complement to the men's track." ),
          array( 'Alumni-led', 'Carried forward by alumni', "CLF's legacy continues through volunteer alumni leaders who now shepherd the experience — a testament to the depth of impact on those who've been through it." ),
          array( 'Today', 'Rebranded as CLF — built to expand', 'The ministry rebrands from "Charlotte Leadership Forum" to "CLF," creating the foundation to carry this experience into new cities and communities.' ),
        );
        foreach ( $timeline as $t ) : ?>
          <article class="timeline-item">
            <div class="timeline-year"><?php echo esc_html( $t[0] ); ?></div>
            <div class="timeline-body">
              <h4><?php echo esc_html( $t[1] ); ?></h4>
              <p><?php echo esc_html( $t[2] ); ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<section class="story-section clf-reveal">
  <div class="story-two">
    <div class="story-label">04 / Who leads it today</div>
    <div>
      <h2 class="story-heading">The work is<br><em>in good hands.</em></h2>
      <div class="leader-grid">
        <?php
        $leaders = array(
          array( 'CA', 'Chris & Jamie Allen' ), array( 'SC', 'Scott & Kari Cornwell' ), array( 'BG', 'Bill & Carol Grier' ),
          array( 'PB', 'Percy & Sara Jo Burns' ), array( 'AW', 'Alan & Tammy Wise' ), array( 'BC', 'G.B. "Bud" & Kay Carrier' ),
          array( 'HF', 'Harry & Allyson Floyd' ), array( 'EC', 'Ed Clayton' ), array( 'JG', 'Joe & Linda Glass' ),
          array( 'BJ', 'Ben & Katie Johnson' ), array( 'TS', 'Tim & Linda Sittema' ), array( 'RW', 'Roger & Lynn Wilkerson' ),
          array( 'BK', 'Bryan & Suzanne Knupp' ), array( 'MD', 'Mark & Beth Decherd' ), array( 'JM', 'Jonathan & Jenna Michael' ),
        );
        foreach ( $leaders as $l ) : ?>
          <div class="leader-card">
            <div class="leader-initials"><?php echo esc_html( $l[0] ); ?></div>
            <div class="leader-name"><?php echo esc_html( $l[1] ); ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<section class="story-section alt clf-reveal">
  <div class="story-two">
    <div class="story-label">05 / In their own words</div>
    <div>
      <h2 class="story-heading">What stays<br><em>with you.</em></h2>
      <div class="testimonial-grid">
        <?php
        $testimonials = array(
          array( '"CLF gave us language for what we were already feeling — that God had something specific for our family — and then a community to help us figure out what that actually meant."', '[Alumnus couple name]', 'CLF Class of [year]' ),
          array( '"The friendships we made in our small group are still some of our closest relationships, years later. That\'s not something you can manufacture — CLF just creates the conditions for it."', '[Alumnus couple name]', 'CLF Class of [year]' ),
          array( '"I came in thinking it was a leadership program. I left with a clearer sense of who I am, what I\'m for, and how to actually live that out alongside my wife."', '[Alumnus name]', 'CLF Class of [year]' ),
        );
        foreach ( $testimonials as $tm ) : ?>
          <article class="testimonial-card">
            <div class="testimonial-text"><?php echo esc_html( $tm[0] ); ?></div>
            <div class="testimonial-attribution"><?php echo esc_html( $tm[1] ); ?></div>
            <div class="testimonial-year"><?php echo esc_html( $tm[2] ); ?></div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<section class="story-band clf-reveal" id="story-apply">
  <div>
    <div class="clf-sectiontag">06 / The next chapter</div>
    <h2>Be part of the<br><em>next chapter.</em></h2>
    <p>CLF is carried forward by people who believe in the mission. If that's you, we'd love to hear from you.</p>
  </div>
  <a href="<?php echo esc_url( clf_page_url( 'apply' ) ); ?>">Apply now <?php clf_icon( 'arrow-up-right', 19 ); ?></a>
</section>

<?php get_footer(); ?>
