<?php
/*
Plugin Name: ABDUL Widget
Plugin URI: http://wordpress.org/extend/plugins/abdul-wp-plugin/
Description: Chat with ABDUL
Version: 0.1.3.3
Author: DreamBuilder Inc.
Author URI: http://www.conan.in.th/
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
		
        extract( $args );
        echo $before_widget;
        $title = apply_filters('widget_title', $instance['title']);
        if( $title ) echo $before_title . $title . $after_title;


?>

<script type="text/javascript" src="<?php echo WP_PLUGIN_URL;?>/abdul-wp-plugin/yui/yahoo/yahoo-min.js"></script> 
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL;?>/abdul-wp-plugin/yui/event/event-min.js"></script> 
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL;?>/abdul-wp-plugin/yui/connection/connection-min.js"></script> 

<br /><br/>
<center>
<form id="abdul" name="abdul" onSubmit="return false;">
<input type="text" name="q" id="q" onKeyPress="javascript:myquery(event);" size="20">
<input type="hidden" name="from" id="from" value="wb:widget">
<input type="hidden" name="bot" id="bot" value="abdul">
</form> 
<br/>
<table border="0" style="border:0px">
<tr style="border:none" align="left"><td width="90%" align="left" style="border:none">
<span id="abdulanswer" style="border:0px"></span>
</td></tr></table>

</center>


<script>
var handleEvent = {
		start:function(eventType, args){
		// do something when startEvent fires.
		document.getElementById('abdulanswer').innerHTML = "<center><img src=<?php echo WP_PLUGIN_URL;?>/abdul-wp-plugin/images/wait.gif></center>";
		},

		complete:function(eventType, args){
		// do something when completeEvent fires.
			document.abdul.q.select();
		},

		success:function(eventType, args){
		// do something when successEvent fires.
			if(args[0].responseText !== undefined){
				document.getElementById('abdulanswer').innerHTML = args[0].responseText;
				document.abdul.q.select();
			}
		},

		failure:function(eventType, args){
		// do something when failureEvent fires.
			alert('answering system error');
		},

		abort:function(eventType, args){
		// do something when abortEvent fires.
		}
	};

	var callback = {
		customevents:{
			onStart:handleEvent.start,
			onComplete:handleEvent.complete,
			onSuccess:handleEvent.success,
			onFailure:handleEvent.failure,
			onAbort:handleEvent.abort
		},
		scope:handleEvent,
	 	argument:["foo","bar","baz"]
	};


	function makeRequest(){
		var q = encodeURIComponent(document.getElementById("q").value);
		if(q!=""){
			var sUrl = "<?php echo WP_PLUGIN_URL;?>/abdul-wp-plugin/abdul.php";
			var data = "q="+q;
			var request = YAHOO.util.Connect.asyncRequest('POST', sUrl, callback,data);
		}
	}

	function myquery(e){
		var n = e.keyCode;
		if(n==13){//key of Enter Key
			makeRequest();
			document.abdul.q.select();
		}
		
	}
</script>


<?php
		
		
		
	}

    //////////////////////////////////////////////////////
    //Update the widget settings
    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        return $instance;
    }

    ////////////////////////////////////////////////////
    //Display the widget settings on the widgets admin panel
    function form( $instance )
    {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
        </p>
     <?php
    }

}

add_action( 'widgets_init', 'abdul_widget_init' );

function abdul_widget_init() {
	register_widget('ABDUL_Widget');
}

?>