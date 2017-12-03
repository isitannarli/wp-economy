<?php

class hisse extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'hisse', // Base ID
            esc_html__('WP Ekonomi - Hisse', 'hisse'), // Name
            array('description' => esc_html__('WP Ekonomi Hisse Widget', 'hisse'),) // Args
        );
    }

    public function widget($args, $instance)
    {

        $list = $instance['list'];

        add_action( 'wp_footer', function() use ( $list ) {
            echo '<script>';
            if(empty($list) || $list == "") {
                echo 'stocks("ISKUR, ISCTR, GARAN, AKBNK, YKBNK, KCHOL, SAHOL, HALKB", "#hisseler")';
            } else {
                echo 'stocks("' . $list . '", "#hisseler")';
            }
            echo '</script>';
        });

        echo $args['before_widget'];
        echo $args['before_title'] . apply_filters('widget_title', 'hisse') . $args['after_title'];
        echo '<div id="hisseler"></div>';

        echo $args['after_widget'];

    }

    public function form($instance)
    {
        if ( isset( $instance[ 'list' ] ) ) {
            $list = $instance[ 'list' ];
        }
        else {
            $list = __( 'List', 'hisse' );
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'list' ); ?>"><?php _e( 'Liste:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'list' ); ?>" name="<?php echo $this->get_field_name( 'list' ); ?>" type="text" value="" />
        </p>
        <?php
    }



    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['list'] = strip_tags( $new_instance['list'] );
        return $instance;
    }
}