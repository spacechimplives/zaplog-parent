<?php

add_filter( 'template_include', 'zlp_zap_list' );
function zlp_zap_list( $template ) {
  if ( is_front_page() ) {
    return plugin_dir_path( __FILE__ ) . '../templates/front-page.php';
  }
  return $template;
}