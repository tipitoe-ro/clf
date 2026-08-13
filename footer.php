<footer class="clf-footer">
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="clf-mark">
    <?php clf_logo(); ?><small><?php echo esc_html( strtoupper( get_bloginfo( 'name' ) ?: 'Charlotte Leadership Forum' ) ); ?></small>
  </a>
  <div>
    <?php
    if ( has_nav_menu( 'footer' ) ) {
      wp_nav_menu( array(
        'theme_location' => 'footer',
        'items_wrap'     => '%3$s',
        'container'      => false,
        'walker'         => new CLF_Nav_Walker(),
        'fallback_cb'    => false,
      ) );
    } else {
      $contact_email = clf_get( 'clf_contact_email', 'info@charlotteforum.org' );
      ?>
      <a href="<?php echo esc_url( clf_page_url( 'experience' ) ); ?>">Experience</a>
      <a href="<?php echo esc_url( clf_page_url( 'our-story' ) ); ?>">Our story</a>
      <a href="<?php echo esc_url( clf_page_url( 'give' ) ); ?>">Give</a>
      <a href="mailto:<?php echo esc_attr( $contact_email ); ?>">Contact</a>
      <?php
    }
    ?>
  </div>
  <small>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ?: 'Charlotte Leadership Forum' ); ?></small>
</footer>

</div><!-- .clf -->

<?php wp_footer(); ?>
</body>
</html>
