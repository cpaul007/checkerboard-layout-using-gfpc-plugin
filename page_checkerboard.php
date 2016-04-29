<?php
/**
 * Creating Checkerboard template 
 * 
 * Template Name: Checkerboard
 * 
 * @author        Chinmoy Paul
 * @copyright     Copyright (c) 2016, Genesis Developer
 * @license       GPL-3.0+
 * @link
 */
 
 //* Copy the code below this line
 
global $loop_counter;
$loop_counter = 1;  

//* Force full width content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Add a custom body class
add_filter( 'body_class', 'checkerboard_add_body_class' );
function checkerboard_add_body_class( $classes ) {
  
  $classes[] = 'checkerboard-tpl';
  return $classes;
	
}

//* Enqueue ionicons file
add_action( 'wp_enqueue_scripts', 'checkerboard_enqueue_scripts' );
function checkerboard_enqueue_scripts() {
  //* Loading IonIcons CSS
  wp_enqueue_style( 'ionicons', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), CHILD_THEME_VERSION );
}

//* Remove genesis default loop  
remove_action('genesis_loop', 'genesis_do_loop');

add_action('genesis_loop', 'checkerboard_checkerboard_widget_area');
function checkerboard_checkerboard_widget_area() {

  //* Check "checkboard" sidebar is active
  if( is_active_sidebar('checkerboard') ) {   
      
    genesis_widget_area( 
      'checkerboard', 
      array(
  		 'before' => '<div class="checkerboard widget-area clearfix">',
  		 'after'  => '</div>',
  	  ) 
    );
    
  } else {
  
    //* Run standard loop
    genesis_standard_loop();
    
  }
}

//* Echo the opening markup. Basically using for center alignment
add_action( 'gfpc_entry_header', 'checkerboard_markup_open', 4.598, 2 );
function checkerboard_markup_open( $instance, $widget_id ) {  
  echo '<div class="checkerboard-wrapper">' . "\n";
  echo '<div class="checkerboard-wrap">' . "\n";
}

//* Echo the closing markup.
add_action( 'gfpc_entry_footer', 'checkerboard_markup_close', 20, 2 );
function checkerboard_markup_close( $instance, $widget_id ) {
  echo '</div>' . "\n";
  echo '</div>' . "\n";
  
  global $loop_counter; 
  $loop_counter++;
}

//* Add share buttons below the entry content
add_action( 'gfpc_entry_footer', 'checkerboard_post_share', 19, 2 );
function checkerboard_post_share( $instance, $widget_id ) {
  
  if ( has_post_thumbnail() ) {
    $image = wp_get_attachment_url( get_post_thumbnail_id() );
  }
  
  $fb     = 'ion ion-social-facebook'; 
  $tw     = 'ion ion-social-twitter';
  $pin    = 'ion ion-social-pinterest';
  $gp     = 'ion ion-social-googleplus'; 
  $ln     = 'ion ion-social-linkedin';
  $reddit = 'ion ion-social-reddit';
?>
  <div class="post-sharing">
    <p class="label"><?php _e( 'Share This Article', 'gfpc' ); ?></p>
    <ul class="social-sharing">

  		<li class="facebook">
  			<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() ; ?>"><i class="<?php echo $fb; ?>"></i></a>
  		</li>
  	
  		<li class="twitter">
  			<a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&via=genesisdevelopr&url=<?php echo get_permalink() ; ?>"><i class="<?php echo $tw; ?>"></i></a>
  		</li>
  	
  		<li class="pinterest">
  			<a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo get_permalink() ; ?>&amp;media=<?php echo esc_url( $image ); ?>"><i class="<?php echo $pin; ?>"></i></a>
  		</li>
  	
  		<li class="google-plus">
  			<a target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"><i class="<?php echo $gp; ?>"></i></a>
  		</li>
  	
  		<li class="linkedin">
  			<a target="_blank" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo get_permalink() ; ?>&amp;title=<?php the_title() ; ?>"><i class="<?php echo $ln; ?>"></i></a>
  		</li>
  	
  		<li class="reddit">
  			<a target="_blank" href="http://www.reddit.com/submit?url=<?php echo get_permalink(); ?>&amp;title=<?php the_title(); ?>"><i class="<?php echo $reddit; ?>"></i></a>
  		</li>

    </ul>
  
  </div>
<?php
}

//* Filter the post class
add_filter( 'gfpc_post_class', 'checkerboard_post_class' );
function checkerboard_post_class( $classes ) {
  global $loop_counter;

  if( $loop_counter % 2 == 0 )
    $classes[] = 'even';
  else
    $classes[] = 'odd';
    
  return $classes;
}

//* Reposition Post Info
remove_action( 'gfpc_entry_header', 'gfpc_do_post_info', 12, 2 );
add_action( 'gfpc_entry_header', 'gfpc_do_post_info', 6, 2 );

genesis();
