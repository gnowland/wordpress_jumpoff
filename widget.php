<?php
/**
 * @category Blank Widget (schema-tagged)
 * @package  wordpress-jumpoff
 * @author   Gifford Nowland
 *
 */

namespace Gnowland\WordPress_Jumpoff\Widgets;

// Prevent direct file access
if(!defined('ABSPATH')) { exit; }

if(!class_exists('\Gnowland\WordPress_Jumpoff\Widget\Blank_Widget')){

	/**
	 * Adds Rich_Address widget.
	 */
	class Blank_Widget extends \WP_Widget {

		/**
		 * Register widget with WordPress.
		 */
		function __construct() {

			$widget_ops = array(
				//'classname' => 'blank-widget',
				'description' => __( 'Blank Widget')
			);

			parent::__construct(
				'blank_widget',	// Base ID
				__('&#9733; Blank Widget', 'gnowland' ), // Name
				$widget_ops
			);

		}

		/*--------------------------------------------------*/
		/* Widget API Functions
		/*--------------------------------------------------*/

		/**
		 * Outputs the content of the widget.
		 *
		 * @param array args  The array of form elements
		 * @param array instance The current instance of the widget
		 */
		public function widget( $args, $instance ) {

			extract($args, EXTR_SKIP);

			echo $before_widget;

			// Display Widget Title
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Blank Widget' ) : $instance['title'], $instance, $this->id_base );
			if ($title){
				echo $before_title . $title . $after_title;
			}

			echo $after_widget;

		} // end widget

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$new_instance = wp_parse_args(
				(array) $new_instance,
				array(
					'title' => '',
					//'count' => 0,
				)
			);

			$instance['title'] = strip_tags($new_instance['title']);
			//$instance['count'] = $new_instance['count'] ? 1 : 0;

			return $instance;
		} // end update

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {

			// Set Defaults
			$instance = wp_parse_args(
				(array) $instance,
				array(
					'title' => '',
					//'count' => 0,
				)
			);

			$title = strip_tags($instance['title']);
			//$count = $instance['count'] ? 'checked="checked"' : '';

			?>
			<p><label><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<?php
			/* <p><input class="checkbox" type="checkbox" <?php echo $count; ?> id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" /> <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts'); ?></label></p> */

		} // end back-end form

	}// class Rich_Address

	// Register Rich_Address widget
	add_action( 'widgets_init', function(){
		register_widget( '\Gnowland\WordPress_Jumpoff\Widget\Blank_Widget' );
	});

} // end if(!class_exists)
