<?php

add_action( 'widgets_init', 'wplms_dash_sample_widget' );

function wplms_dash_sample_widget() {
    register_widget('wplms_dash_sample');
}

class wplms_dash_sample extends WP_Widget {

    /** constructor -- name this the same as the class above */
    function wplms_dash_sample() {
    $widget_ops = array( 'classname' => 'wplms_dash_sample', 'description' => __('SAMPLE Widget for Dashboard', 'wplms-dashboard') );
    $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wplms_dash_sample' );
    $this->WP_Widget( 'wplms_dash_sample', __(' DASHBOARD : SAMPLE Widget', 'wplms-dashboard'), $widget_ops, $control_ops );
  }
        
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget( $args, $instance ) {
    extract( $args );

    //Our variables from the widget settings.
    $title = apply_filters('widget_title', $instance['title'] );
    $width =  $instance['width'];
    $content =  $instance['content'];

    echo '<div class="'.$width.'">
            <div class="dash-widget">'.$before_widget;

    // Display the widget title 
    if ( $title )
        echo $before_title . $title . $after_title;
            
        /*
            DO WIDGET CODE
        */
       
        echo $after_widget.'
        </div>
        </div>';
                
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {   
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['width'] = $new_instance['width'];
        /*
            MORE VARIABLES FOR WIDGET
        */
        return $instance;
    }
 
    
    function form($instance) {  
        $defaults = array( 
                        'title'  => __('SAMPLE','wplms-dashboard'),
                        'content' => '',
                        'width' => 'col-md-6 col-sm-12'
                    );
        
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title  = esc_attr($instance['title']);
        $width = esc_attr($instance['width']);
        ?>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','wplms-dashboard'); ?></label> 
          <input class="regular_text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        
        <!-- ADD MORE FILEDS -->

        <p>
          <label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Select Width','wplms-dashboard'); ?></label> 
          <select id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>">
            <option value="col-md-3 col-sm-6" <?php selected('col-md-3 col-sm-6',$width); ?>><?php _e('One Fourth','wplms-dashboard'); ?></option>
            <option value="col-md-4 col-sm-6" <?php selected('col-md-4 col-sm-6',$width); ?>><?php _e('One Third','wplms-dashboard'); ?></option>
            <option value="col-md-6 col-sm-12" <?php selected('col-md-6 col-sm-12',$width); ?>><?php _e('One Half','wplms-dashboard'); ?></option>
            <option value="col-md-8 col-sm-12" <?php selected('col-md-8 col-sm-12',$width); ?>><?php _e('Two Third','wplms-dashboard'); ?></option>
             <option value="col-md-8 col-sm-12" <?php selected('col-md-9 col-sm-12',$width); ?>><?php _e('Three Fourth','wplms-dashboard'); ?></option>
            <option value="col-md-12" <?php selected('col-md-12',$width); ?>><?php _e('Full','wplms-dashboard'); ?></option>
          </select>
        </p>
        <?php 
    }
} 

?>