<?php
/*
Plugin Name: ABDUL Widget
Plugin URI: http://wordpress.org/extend/plugins/abdul-wp-plugin/
Description: Chat with ABDUL
Version: 0.1
Author: DreamBuilder Inc.
Author URI: http://conan.in.th/
*/


global $wp_version;

if ( version_compare( $wp_version, '2.9', '<' ) ) {
//	include_once( dirname( __FILE__ ) . '/abdul/abdul.php' );
}


class ABDUL_Widget extends WP_Widget {

	function ABDUL_Widget() {
		$widget_ops = array('classname' => 'widget_abdul', 'description' => __( "Chat with ABDUL") );
		$this->WP_Widget('abdul', __('ABDUL'), $widget_ops);
	}

	function widget( $args, $instance ) {
		
		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = __( 'Chat to ABDUL' );


?>

<script type="text/javascript" src="/wp-content/plugins/abdul-wp-plugin/yui/yahoo/yahoo-min.js"></script> 
<script type="text/javascript" src="/wp-content/plugins/abdul-wp-plugin/yui/event/event-min.js"></script> 
<script type="text/javascript" src="/wp-content/plugins/abdul-wp-plugin/yui/connection/connection-min.js"></script> 
<script type="text/javascript" src="/wp-content/plugins/abdul-wp-plugin/js/abdul.js"></script> 

<br /><br/>
<center>
<h2>คุยกับอับดุล</h2>

<form id="abdul" name="abdul" onSubmit="return false;">
<input type="text" name="q" id="q" onKeyPress="javascript:myquery(event);" size="20">
<input type="hidden" name="from" id="from" value="wb:widget">
<input type="hidden" name="bot" id="bot" value="abdul">
</form> 

<br /><br/>

<table border="0" style="border:0px">
<tr style="border:none" align="left"><td width="90%" align="left" style="border:none">
<span id="abdulanswer" style="border:0px"></span>
</td></tr></table>

</center>


<?php
		
		
		
	}

	function update( $new_instance, $old_instance ) {

	}

}

add_action( 'widgets_init', 'abdul_widget_init' );

function abdul_widget_init() {
	register_widget('ABDUL_Widget');
}

?>