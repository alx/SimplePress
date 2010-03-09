<?php
/*
* Widget to show Media RSS icons and links
* 
* @author Vincent Prat
*/

// Stop direct call
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { 	die('You are not allowed to call this page directly.'); }

// The Widget class
if (!class_exists("nggMediaRssWidget")) {

class nggMediaRssWidget {

	var $options;
	
	/**
	* Constructor
	*/
	function nggMediaRssWidget() {
		
		$this->load_options();
		add_action('widgets_init', array(&$this, 'register_widget'));
	}
		
	/**
	* Function to register the Widget functions
	*/
	function register_widget() {
		$name = __('NextGEN Media RSS', 'nggallery');
		$control_ops = array(
			'width' => 250, 'height' => 350, 
			'id_base' => 'ngg-mrssw');
		$widget_ops = array(
			'classname' => 'ngg_mrssw', 
			'description' => __('Widget that displays Media RSS links for NextGEN Gallery.', 
								'nggallery'));

		if (!is_array($this->options)) {
			$this->options = array();
		}
								
		$registered = false;
		foreach (array_keys($this->options) as $o) {
			// Old widgets can have null values for some reason
			//--
			if ( !isset($this->options[$o]['show_global_mrss']) )
				continue;
			
			// $id should look like {$id_base}-{$o}
			//--
			$id = "ngg-mrssw-$o";
			$registered = true;
			wp_register_sidebar_widget( 
				$id, $name, 
				array(&$this, 'render_widget'), 
				$widget_ops, array( 'number' => $o ) );
			wp_register_widget_control( 
				$id, $name, 
				array(&$this, 'render_control_panel'), 
				$control_ops, array( 'number' => $o ) );
		}

		// If there are none, we register the widget's existance with a generic template
		//--
		if (!$registered) {
			wp_register_sidebar_widget( 
				'ngg-mrssw-1', $name, 
				array(&$this, 'render_widget'), 
				$widget_ops, array( 'number' => -1 ) );
			wp_register_widget_control( 
				'ngg-mrssw-1', $name, 
				array(&$this, 'render_control_panel'), 
				$control_ops, array( 'number' => -1 ) );
		}
	}
	
	/**
	* Function to render the widget control panel
	*/
	function render_control_panel( $widget_args = 1 ) {
		global $wp_registered_widgets;
		static $updated = false;
		
		// Get the widget ID
		if (is_numeric($widget_args)) {
			$widget_args = array('number' => $widget_args);
		}
		$widget_args = wp_parse_args($widget_args, array('number' => -1));
		extract($widget_args, EXTR_SKIP);
	
		if (!$updated && !empty($_POST['sidebar'])) {
			$sidebar = (string) $_POST['sidebar'];

			$sidebars_widgets = wp_get_sidebars_widgets();
			if ( isset($sidebars_widgets[$sidebar]) )
				$this_sidebar = &$sidebars_widgets[$sidebar];
			else
				$this_sidebar = array();

			foreach ( $this_sidebar as $_widget_id ) {
				// Remove all widgets of this type from the sidebar.  We'll add the new data in a second.  This makes sure we don't get any duplicate data
				// since widget ids aren't necessarily persistent across multiple updates
				if (	'ngg_mrssw' == $wp_registered_widgets[$_widget_id]['classname'] 
					&& 	isset($wp_registered_widgets[$_widget_id]['params'][0]['number']) ) {
					
					$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
					if (!in_array( "ngg-mrssw-$widget_number", $_POST['widget-id'])) // the widget has been removed.
						unset($this->options[$widget_number]);
				}
			}

			foreach ( (array) $_POST['widget_ngg_mrssw'] as $widget_number => $widget_ngg_mrssw ) {
				if ( !isset($widget_ngg_mrssw['show_global_mrss']) && isset($this->options[$widget_number]) ) // user clicked cancel
					continue;
					
				$this->options[$widget_number]['show_global_mrss']	= $widget_ngg_mrssw['show_global_mrss'];
				$this->options[$widget_number]['widget_title'] 		= stripslashes($widget_ngg_mrssw['widget_title']);
				$this->options[$widget_number]['show_icon'] 		= $widget_ngg_mrssw['show_icon'];
				$this->options[$widget_number]['mrss_text'] 		= stripslashes($widget_ngg_mrssw['mrss_text']);
				$this->options[$widget_number]['mrss_title'] 		= strip_tags(stripslashes($widget_ngg_mrssw['mrss_title']));
				// remove from pre V1.4.0 options
				unset ( $this->options[$widget_number]['mrss_icon_url'] );				
			}

			$this->save_options();
			$updated = true;
		}

		if ( -1 == $number ) {
			$widget_title 		= '';
			$show_global_mrss 	= true;
			$show_icon			= true;
			$mrss_text			= __('Media RSS', 'nggallery');
			$mrss_title			= __('Link to the main image feed', 'nggallery');
			$number 			= '%i%';
		} else {
			$widget_title 		= esc_attr($this->options[$number]['widget_title']);
			$show_global_mrss 	= $this->options[$number]['show_global_mrss'];
			$show_icon			= $this->options[$number]['show_icon'];
			$mrss_text			= stripslashes($this->options[$number]['mrss_text']);
			$mrss_title			= strip_tags(stripslashes($this->options[$number]['mrss_title']));
		}

		// The widget control
	?>
	
<input type="hidden" id="ngg_mrssw-submit-<?php echo $number; ?>" name="widget_ngg_mrssw[<?php echo $number; ?>][submit]" value="1" />
<p>
	<label><?php _e('Title:', 'nggallery'); ?><br />
		<input class="widefat" id="ngg_mrssw-widget_title-<?php echo $number; ?>" name="widget_ngg_mrssw[<?php echo $number; ?>][widget_title]" type="text" value="<?php echo $widget_title; ?>" />
	</label>
</p>

<p>
	<label>
		<input id="ngg_mrssw-show_icon-<?php echo $number; ?>" name="widget_ngg_mrssw[<?php echo $number; ?>][show_icon]" type="checkbox" value="1" <?php $this->render_checked($show_icon); ?> />
		<?php _e('Show Media RSS icon', 'nggallery'); ?>
	</label>
</p>

<p>
	<label>
		<input id="ngg_mrssw-show_global_mrss-<?php echo $number; ?>" name="widget_ngg_mrssw[<?php echo $number; ?>][show_global_mrss]" type="checkbox" value="1" <?php $this->render_checked($show_global_mrss); ?> /> <?php _e('Show the global Media RSS link', 'nggallery'); ?>
	</label>
</p>

<p>
	<label><?php _e('Text for the global Media RSS link:', 'nggallery'); ?><br />
		<input class="widefat" id="ngg_mrssw-mrss_text-<?php echo $number; ?>" name="widget_ngg_mrssw[<?php echo $number; ?>][mrss_text]" type="text" value="<?php echo $mrss_text; ?>" /></label>
	</label>
</p>

<p>
	<label><?php _e('Tooltip text for the global Media RSS link:', 'nggallery'); ?><br />
		<input class="widefat" id="ngg_mrssw-mrss_title-<?php echo $number; ?>" name="widget_ngg_mrssw[<?php echo $number; ?>][mrss_title]" type="text" value="<?php echo $mrss_title; ?>" /></label>
	</label>
</p>

<?php
	}
	
	/**
	* Function to render the widget
	*/
	function render_widget($args, $widget_args=1) {
		global $ngg_mrssw_plugin;
		$ngg_options = nggGallery::get_option('ngg_options');
		
		// Get the options
		extract($args, EXTR_SKIP);	
		if (is_numeric($widget_args)) {
			$widget_args = array('number' => $widget_args);
		}
		$widget_args = wp_parse_args($widget_args, array('number' => -1));
		extract($widget_args, EXTR_SKIP);
		
		$title = empty($this->options[$number]['widget_title']) 
					? __('Media RSS', 'nggallery') 
					: $this->options[$number]['widget_title'];
		$show_global_mrss 	= $this->options[$number]['show_global_mrss'];
		$show_icon		 	= $this->options[$number]['show_icon'];
		// Compat reason for settings pre V1.4.X
		$show_icon		 	= (empty( $this->options[$number]['mrss_icon_url']) ) ? $show_icon : true;
		$mrss_text			= stripslashes($this->options[$number]['mrss_text']);
		$mrss_title			= strip_tags(stripslashes($this->options[$number]['mrss_title']));

		echo '<!-- NextGen Gallery Media RSS -->';	
		
		echo $before_widget; 
			echo $before_title . $title . $after_title;
			echo "<ul class='ngg-media-rss-widget'>\n";
			if ($show_global_mrss) {
				echo "  <li>";
				echo $this->get_mrss_link(nggMediaRss::get_mrss_url(), $show_icon, 
								stripslashes($mrss_title), stripslashes($mrss_text), 
								$ngg_options['usePicLens']);
				echo "</li>\n";
			}
			echo "</ul>\n";
		echo $after_widget;
		
		echo '<!-- /NextGen Gallery Media RSS -->';
	}
	
	/**
	 * Get a link to a Media RSS
	 */
	function get_mrss_link($mrss_url, $show_icon = true, $title, $text, $use_piclens) {
		$out  = '';
		
		if ($show_icon) {
			$icon_url = NGGALLERY_URLPATH . 'images/mrss-icon.gif';
			$out .= "<a href='$mrss_url' title='$title' class='ngg-media-rss-link'" . ($use_piclens ? ' onclick="PicLensLite.start({feedUrl:\'' . $mrss_url . '\'}); return false;"' : "") . " >";
			$out .= "<img src='$icon_url' alt='MediaRSS Icon' title='" . (!$use_piclens ? $title : __('[View with PicLens]','nggallery')). "' class='ngg-media-rss-icon' />";
			$out .=  "</a> ";
		}
		
		if ($text != '') {
			$out .= "<a href='$mrss_url' title='$title' class='ngg-media-rss-link'>";
			$out .= $text;
			$out .=  "</a>";
		}
				
		return $out;
	}
	
	/**
	* Load the options from database (set default values in case options are not set)
	*/
	function load_options() {
		$this->options = get_option('ngg_mrss_widget');
		
		if ( !is_array($this->options) ) {
			$this->options = array(
				-1 => array(
					'show_global_mrss' => true,
					'show_icon' => true,
					'mrss_text' => __('Media RSS', 'nggallery'),
					'mrss_title' => __('Link to the main image feed', 'nggallery')
				)
			);
		}
	}
	
	/**
	* Save options to database
	*/
	function save_options() {
		update_option('ngg_mrss_widget', $this->options);
	}
	
	/**
	* Helper function to output the checked attribute of a checkbox
	*/
	function render_checked($var) {
		if ($var==1 || $var==true) {
			echo 'checked="checked"';
		}
	}
	
	/**
	* Helper function to output the selected attribute of an option
	*/
	function render_selected($var) {
		if ($var==1 || $var==true) {
			echo 'selected="selected"';
		}
	}
} // class nggMediaRssWidget

} // if (!class_exists("nggMediaRssWidget"))

// let's start it
$ngg_mrss_widget = new nggMediaRssWidget();

?>