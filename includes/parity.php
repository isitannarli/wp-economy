<?php

class parity extends WP_Widget {

  function __construct() {
    parent::__construct(
      'parity', // Base ID
      esc_html__( 'Parity - WP Economy', 'parity' ), // Name
      array( 'description' => esc_html__( 'Economy Parity Widget', 'parity' ), ) // Args
    );
  }

  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    echo $args['before_title'] . apply_filters( 'widget_title', 'Parite') . $args['after_title'];
    /*echo "<div class='order-text'>";
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    };
    echo '<a class="button" href="#popup"><span class="icon-chat"></span>Заказать сайт</a>';
    echo "</div>";
    */

    echo $args['after_widget'];
  }

  public function form( $instance ) {
      /*$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'webove' );
     $order_text = ! empty( $instance['order_text'] ) ? $instance['order_text'] : __( 'New order_text', 'webove' );
      ?>
      <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'webove' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
      </p>
      <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'order_text' ) ); ?>"><?php esc_attr_e( 'Text:', 'webove' ); ?></label>
      <textarea class="widefat" id="<?php echo $this->get_field_id( 'order_text' ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order_text' ) ); ?>" value="<?php echo $order_text ?>"><?php if (!empty($order_text)) echo $order_text; ?></textarea>
      </p>
      */
  }

  public function update( $new_instance, $old_instance ) {
    // $instance = $old_instance;
    // $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    // $instance['order_text'] = ( ! empty( $new_instance['order_text'] ) ) ? ( $new_instance['order_text'] ) : '';
    // return $instance;
  }
}
