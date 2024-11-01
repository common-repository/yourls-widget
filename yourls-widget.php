<?php

/**
 * Plugin Name: YOURLS Widget
 * Version: 0.3
 * Plugin URI: http://foolrulez.org/blog/2009/09/yourls-widget-released/
 * Description: A widget that will connect to your (or someone else's with pubic API) YOURLS URL shortening system.
 * Author: Woxxy
 * Author URI: http://woxxy.org/blog
 */
 
 /*  Copyright 2009  Woxxy  (email : woxxap@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'yourls_load_widgets' );

/* Function that registers our widget. */
function yourls_load_widgets() {
	register_widget( 'YOURLS_Widget' );
}

class yourls_Widget extends WP_Widget {
	function YOURLS_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'YOURLS', 'description' => 'Embed YOURLS in your sidebar' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'yourls-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'yourls-widget', 'YOURLS Widget', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$api_url = $instance['api_url'];
		$home = get_bloginfo('home');		

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

 echo <<<RESULT
	<script type="text/javascript">
	jQuery(document).ready(function() {
	jQuery("#yourlsbutton").click(function(){
	if (jQuery("#yourlsurl").val() != "") {
	jQuery('#yourlscredits').text('Loading...');
	jQuery("#yourlsresult").load("$home/wp-content/plugins/yourls-widget/yourls-widget-hook.php", {
	url: jQuery("#yourlsurl").val(),
	api_url: "$api_url"
	}, function(){
	jQuery('#yourlscredits').empty();
	jQuery('#yourlscredits').hide();
	});}});});</script>
	
	<p>
		Paste here the URL to shorten:<br/><input id='yourlsurl' size="30">
		<button id='yourlsbutton'>Shorten</button></p>
		<p><div id='yourlscredits'>Powered by <a href="http://yourls.org">Yourls.org.</a></div>
		<div id='yourlsresult'></div>
	</p>
RESULT;

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['api_url'] = strip_tags( $new_instance['api_url'] );

		return $instance;
	}
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'YOURLS');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'api_url' ); ?>">Api url:</label>
			<input id="<?php echo $this->get_field_id( 'api_url' ); ?>" name="<?php echo $this->get_field_name( 'api_url' ); ?>" value="<?php echo $instance['api_url']; ?>" style="width:100%;" />
		</p>

		<?php
	}
}
?>