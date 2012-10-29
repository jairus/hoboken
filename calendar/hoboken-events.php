<?php include "../wp-load.php";
global $wpdb;
header('Content-Type:application/json');

$eventtype = 'Hoboken Event';
$result = new WP_Query( array( 'post_type' => array( 'events' ), 'meta_key' => 'ecpt_typeofevent', 'meta_value' => $eventtype, 'meta_compare' => '=' ) );

$event_hour = get_post_meta($post->ID, 'ecpt_eventhour', true);
$event_minute = get_post_meta($post->ID, 'ecpt_eventminute', true);

$posturl = 'http://hoboken.mommies247.com/events/';
foreach($result->posts as $post) {
  $events[] = array(
    'title'   => $post->post_title,
    'start'   => date('Y-m-d H:i:s', get_post_meta($post->ID, 'ecpt_eventstart', true)),
    'end'     => date('Y-m-d H:i:s', get_post_meta($post->ID, 'ecpt_eventstart', true)),
    'allDay'  => false,
    'url'     => $posturl . "" . $post->post_name . "/",
    );
}
echo json_encode($events);
exit;
?>