<?php

class doviz extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'doviz', // Base ID
            esc_html__('WP Ekonomi - Döviz', 'doviz'), // Name
            array('description' => esc_html__('WP Ekonomi Döviz Widget', 'doviz'),) // Args
        );
    }

    public function widget($args, $instance)
    {

        $list = $instance['list'];

        add_action( 'wp_footer', function() use ( $list ) {
            echo '<script>';
            if(empty($list) || $list == "") {
                echo 'currency("doviz", "USD, EUR, RUB", "#dovizParite")';
            } else {
                echo 'currency("doviz", "' . $list . '", "#dovizParite")';
            }
            echo '</script>';
        });

        echo $args['before_widget'];
        echo $args['before_title'] . apply_filters('widget_title', 'Döviz') . $args['after_title'];
        echo '<div id="dovizParite"></div>';

        echo $args['after_widget'];

    }

    public function form($instance)
    {
        if ( isset( $instance[ 'list' ] ) ) {
            $list = $instance[ 'list' ];
        }
        else {
            $list = __( 'List', 'doviz' );
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