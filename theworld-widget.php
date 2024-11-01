<?php
class TheWorldWidget extends WP_Widget {
  function TheWorldWidget() {
    parent::WP_Widget(false, $name = 'TheWorldWidget');
  }


  function form($instance) {
    $title_value = esc_attr($instance['title']);
    $title_id    = $this->get_field_id('title');
    $title_name  = $this->get_field_name('title');
    $label       = _e('Title:');

    echo "<p>\n";
    echo "<label for='$title_id'>$label</label>\n";
    echo "<input class='widefat' id='$title_id' name='$title_name' type='text' value='$title_value' />\n";
    echo "</p>\n";
  }

  function update($new_instance, $old_instance) {
    return $new_instance;
  }

  function widget($args, $instance) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    if ( $title == "" )
      $title = "The World";

    $the_world = new TheWorld();
    $num = $the_world->getCountryNum();
    $img = $the_world->chartImg();

    echo $before_widget;
    echo $before_title . $title . $after_title;
    echo "$img";
    echo "<p>I've been to $num countries!!<br><span class='theworld-by'><a href='http://doa.travel/'>by doa.travel</a></span></p>";
    echo $after_widget;
  }
}
