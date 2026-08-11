<?php
/**
 * CLF Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ============================================================
   Theme Setup
   ============================================================ */
function clf_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	add_theme_support( 'custom-logo' );

	// Primary navigation menu
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'clf' ),
		'footer'  => __( 'Footer Navigation', 'clf' ),
	) );
}
add_action( 'after_setup_theme', 'clf_theme_setup' );

/* ============================================================
   Enqueue Styles & Scripts
   ============================================================ */
function clf_enqueue_assets() {
	// Google Fonts — Manrope, Playfair Display, DM Mono (Bold Conviction design)
	wp_enqueue_style( 'clf-fonts', 'https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap', array(), null );

	// Main stylesheet
	wp_enqueue_style( 'clf-style', get_stylesheet_uri(), array( 'clf-fonts' ), '2.0.0' );

	// Main JS (scroll reveals, mobile nav, apply form steps, give page interactions)
	wp_enqueue_script( 'clf-main', get_template_directory_uri() . '/assets/js/clf-main.js', array(), '2.0.0', true );

	// Pass apply page URL to JS for any dynamic links
	wp_localize_script( 'clf-main', 'clfData', array(
		'applyUrl' => clf_page_url( 'apply' ),
		'homeUrl'  => home_url( '/' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'clf_enqueue_assets' );

/* ============================================================
   Helper: Get page URL by slug
   ============================================================ */
function clf_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		return get_permalink( $page->ID );
	}
	return home_url( '/' . $slug . '/' );
}

/* ============================================================
   Custom Walker: Primary Nav with CTA button on last item
   ============================================================ */
class CLF_Nav_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		// Check if the item has a "nav-cta" class set in the menu admin
		$is_cta = in_array( 'nav-cta', $classes, true );

		$atts = array();
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';
		$atts['class']  = $is_cta ? 'nav-cta' : '';

		// Add current-page active indicator
		if ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current-page-ancestor', $classes, true ) ) {
			$atts['class'] = trim( $atts['class'] . ' active' );
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		// CTA items get the arrow icon, matching the design
		$icon = '';
		if ( $is_cta && function_exists( 'clf_icon' ) ) {
			ob_start();
			clf_icon( 'arrow-up-right', 15 );
			$icon = ' ' . ob_get_clean();
		}

		$output .= '<a' . $attributes . '>' . esc_html( $title ) . $icon . '</a>';
	}

	// Suppress <li> wrappers — we render links directly in a flex div
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}

/* ============================================================
   Customizer: Editable site-wide content
   ============================================================ */
function clf_customizer_settings( $wp_customize ) {

	/* ---- Panel ---- */
	$wp_customize->add_panel( 'clf_content', array(
		'title'    => __( 'CLF Content', 'clf' ),
		'priority' => 30,
	) );

	/* ---- Section: Contact & Footer ---- */
	$wp_customize->add_section( 'clf_contact', array(
		'title' => __( 'Contact & Footer', 'clf' ),
		'panel' => 'clf_content',
	) );

	clf_add_text_setting( $wp_customize, 'clf_contact_email', 'clf_contact', __( 'Contact Email', 'clf' ), 'info@charlotteforum.org' );
	clf_add_text_setting( $wp_customize, 'clf_paypal_url', 'clf_contact', __( 'PayPal Donate URL', 'clf' ), 'https://www.paypal.com/donate/?business=NM2PEQDVYDWFW&no_recurring=0&currency_code=USD' );
	clf_add_text_setting( $wp_customize, 'clf_mailing_address', 'clf_contact', __( 'Mailing Address (HTML allowed)', 'clf' ), "Attention: Treasurer<br>CLF<br>4609 Crownvista Drive<br>Charlotte, NC 28269" );
	clf_add_text_setting( $wp_customize, 'clf_apply_form_id', 'clf_contact', __( 'Gravity Forms — Application Form ID', 'clf' ), '' );

	/* ---- Section: Home Hero ---- */
	$wp_customize->add_section( 'clf_home', array(
		'title' => __( 'Home Page — Hero', 'clf' ),
		'panel' => 'clf_content',
	) );

	clf_add_text_setting( $wp_customize, 'clf_home_hero_line1', 'clf_home', __( 'Hero Heading — Line 1', 'clf' ), 'Lead well.' );
	clf_add_text_setting( $wp_customize, 'clf_home_hero_line2', 'clf_home', __( 'Hero Heading — Line 2 (italic accent)', 'clf' ), 'Live fully.' );
	clf_add_textarea_setting( $wp_customize, 'clf_home_hero_subtext', 'clf_home', __( 'Hero Subtext', 'clf' ), 'CLF is an 18-month experience for young married couples who want to live with more purpose, clarity, and impact.' );
	clf_add_text_setting( $wp_customize, 'clf_home_kicker_note', 'clf_home', __( 'Hero Kicker Note (after site name)', 'clf' ), '— since 1995' );
	clf_add_text_setting( $wp_customize, 'clf_stat_1_num', 'clf_home', __( 'Stat 1 Number', 'clf' ), '30+' );
	clf_add_text_setting( $wp_customize, 'clf_stat_1_label', 'clf_home', __( 'Stat 1 Label', 'clf' ), 'Years of impact' );
	clf_add_text_setting( $wp_customize, 'clf_stat_2_num', 'clf_home', __( 'Stat 2 Number', 'clf' ), '~375' );
	clf_add_text_setting( $wp_customize, 'clf_stat_2_label', 'clf_home', __( 'Stat 2 Label', 'clf' ), 'Couples who\'ve participated' );
	clf_add_text_setting( $wp_customize, 'clf_stat_3_num', 'clf_home', __( 'Stat 3 Number', 'clf' ), '15' );
	clf_add_text_setting( $wp_customize, 'clf_stat_3_label', 'clf_home', __( 'Stat 3 Label', 'clf' ), 'Classes since 1995' );
	clf_add_text_setting( $wp_customize, 'clf_stats_note', 'clf_home', __( 'Stats Bar Note (italic)', 'clf' ), 'A generation of leaders in motion.' );
	clf_add_text_setting( $wp_customize, 'clf_home_mission_text', 'clf_home', __( 'Mission Statement', 'clf' ), "We help motivated couples discover God's call on their lives — and build the character to live it out." );
	clf_add_textarea_setting( $wp_customize, 'clf_home_quote', 'clf_home', __( 'Testimonial Quote', 'clf' ), 'The people we became together started with the questions we were willing to ask.' );
	clf_add_text_setting( $wp_customize, 'clf_home_quote_attr', 'clf_home', __( 'Testimonial Attribution', 'clf' ), '— CLF Alumni Couple, Class of 2019' );
}
add_action( 'customize_register', 'clf_customizer_settings' );

/* ---- Helper: add text control ---- */
function clf_add_text_setting( $wp_customize, $id, $section, $label, $default ) {
	$wp_customize->add_setting( $id, array( 'default' => $default, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( $id, array( 'label' => $label, 'section' => $section, 'type' => 'text' ) );
}

/* ---- Helper: add textarea control ---- */
function clf_add_textarea_setting( $wp_customize, $id, $section, $label, $default ) {
	$wp_customize->add_setting( $id, array( 'default' => $default, 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh' ) );
	$wp_customize->add_control( $id, array( 'label' => $label, 'section' => $section, 'type' => 'textarea' ) );
}

/* ============================================================
   Helper: Get customizer value
   ============================================================ */
function clf_get( $key, $fallback = '' ) {
	return get_theme_mod( $key, $fallback );
}

/* ============================================================
   Helper: Inline SVG icons (replaces icon-font dependency)
   ============================================================ */
function clf_icon( $name, $size = 16 ) {
	$paths = array(
		'arrow-up-right'   => '<line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/>',
		'arrow-down-right' => '<line x1="7" y1="7" x2="17" y2="17"/><polyline points="17 7 17 17 7 17"/>',
		'arrow-right'      => '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>',
		'arrow-left'       => '<line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>',
		'chevron-right'    => '<polyline points="9 18 15 12 9 6"/>',
		'check'            => '<polyline points="20 6 9 17 4 12"/>',
		'mail'             => '<rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,7 12,13 22,7"/>',
		'lock'             => '<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
		'users'            => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
		'heart'            => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>',
		'shield-check'     => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/>',
		'search'           => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
		'calendar'         => '<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
		'clock'            => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
		'message'          => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
		'send'             => '<line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>',
		'save'             => '<path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>',
		'tent'             => '<path d="M3.5 21 12 3l8.5 18"/><path d="M12 13l4 8"/><path d="M12 13l-4 8"/><line x1="2" y1="21" x2="22" y2="21"/>',
		'utensils'         => '<path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/><path d="M7 2v20"/><path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3zm0 0v7"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) return;
	printf(
		'<svg class="clf-icon" viewBox="0 0 24 24" width="%1$d" height="%1$d" aria-hidden="true">%2$s</svg>',
		(int) $size,
		$paths[ $name ] // static trusted markup
	);
}

/* ============================================================
   Remove WordPress admin bar padding (optional)
   ============================================================ */
function clf_remove_admin_bar_style() {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
}
add_action( 'get_header', 'clf_remove_admin_bar_style' );

/* ============================================================
   Favicon — used unless a Site Icon is set in the Customizer
   ============================================================ */
function clf_favicon() {
	if ( has_site_icon() ) {
		return; // WordPress outputs the site icon itself
	}
	$base = get_template_directory_uri() . '/assets/images';
	echo '<link rel="icon" type="image/png" sizes="48x48" href="' . esc_url( $base . '/favicon-48.png' ) . '">' . "\n";
	echo '<link rel="icon" type="image/png" sizes="512x512" href="' . esc_url( $base . '/favicon-512.png' ) . '">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url( $base . '/favicon-512.png' ) . '">' . "\n";
}
add_action( 'wp_head', 'clf_favicon', 1 );
