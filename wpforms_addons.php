<?php
/*
* Plugin Name: PFS-WPForms_AddOns
* Description: Provide adding for WPForms - inc User Agent Smart Tag
* Version: 1.0.1
* Author: Pink Fizz Social
* Author URI: http://pinkfizz.social
* License: GPL2
*/

/*
 * Register the User-Agent Smart Tag so it will be available to select in the form builder.
 */
 
function wpf_dev_register_smarttag( $tags ) {
  
    $tags[ 'user_agent' ] = 'User Agent';
    
    return $tags;
}
add_filter( 'wpforms_smart_tags', 'wpf_dev_register_smarttag' );
  
//Define what the Smart Tag is
function wpf_dev_custom_smarttags( $content, $tag ) {
  
    $user_agent = ! empty( $_SERVER[ 'HTTP_USER_AGENT' ] ) ? substr( $_SERVER[ 'HTTP_USER_AGENT' ], 0, 256 ) : '';
  
   if ( $tag === 'user_agent' ) {
      $content = str_replace( '{' . $tag . '}', $user_agent, $content );
   }
   return $content;
};
add_filter( 'wpforms_smart_tag_process', 'wpf_dev_custom_smarttags', 10, 2 );
