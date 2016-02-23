<?php 
	
	if ( defined('SETUP_ENVIROMENT') && SETUP_ENVIROMENT === true ) {		

		add_action('init',function() {
			update_option('siteurl','http://' . $_SERVER['HTTP_HOST'] . '/wp/' );
		});
		
		add_action('init',function() {
			update_option('homeurl','http://' . $_SERVER['HTTP_HOST'] );
		});
		
	}