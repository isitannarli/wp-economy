<?php

class parite extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'parite', // Base ID
            esc_html__('WP Ekonomi - Parite', 'parite'), // Name
            array('description' => esc_html__('WP Ekonomi Parite Widget', 'parite'),) // Args
        );
    }

    public function widget($args, $instance)
    {

        $list = $instance['list'];

        add_action( 'wp_footer', function() use ( $list ) {
            echo '<script>';
            if(empty($list) || $list == "") {
                echo 'parity("USDTRY, EURTRY, USDJPY ,EURUSD, GBPTRY, XAUUSD", "#parite")';
            } else {
                echo 'parity("' . $list . '", "#parite")';
            }
            echo '</script>';
        });

        echo $args['before_widget'];
        echo $args['before_title'] . apply_filters('widget_title', 'Parite') . $args['after_title'];
        echo '<div id="parite"></div>';

        echo $args['after_widget'];

    }

    public function form($instance)
    {
        if ( isset( $instance[ 'list' ] ) ) {
            $list = $instance[ 'list' ];
        }
        else {
            $list = __( 'List', 'parite' );
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