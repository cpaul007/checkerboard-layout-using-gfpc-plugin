<?php
//* Copy the code below this line

add_image_size( 'cb-thumb', 640, 640, true );

//* Register checkerbord sidebar
genesis_register_sidebar( array(
	'id'          => 'checkerboard',
	'name'        => __( 'Checkerboard Template Widget', 'gfpc' ),
	'description' => __( 'This widget area is for checkerboard template', 'gfpc' ),
) );
