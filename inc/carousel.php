<?php
// Handles getting and rendering items for the carousel.
// 
class EUSF_Gallery {
    function __construct($post_id) {
        $this->post_id = $post_id;
    }

    function get_attachments($args) {
        $defaults = array(
            'post_parent' => $this->post_id,
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'posts_per_page' => -1, // -1 to show all
            'post_mime_type' => 'image%',
            'orderby' => 'menu_order',
            'order' => 'ASC'
        );

        $attachments = new WP_Query(array_merge($defaults, $args));
        return $attachments;
    }

    function view_slide($attachment, $i) {
        $id = $attachment->ID;

        $img = wp_get_attachment_image($id, 'hero', false);
        $url = get_post_meta($attachment->ID, '_eusf_url', true);
        $slide = $url ? '<a href="'.$url.'">'.$img.'</a>' : $img;

        $content = eusf_format($attachment->post_content);

        $classes = $i === 0 ? 'active item' : 'item';

        $slide = '<li class="' . $classes . '">' .
                 $slide .
                 '<div class="carousel--slide-content"><div class="in">' . $content . '</div></div>' .
                 '</li>';

        return $slide;
    }

    function view($args = array()) {
        $attachments = $this->get_attachments($args);
        $slides = '';

        for ($i=0; $i < count($attachments->posts); $i++) {
            $attachment = $attachments->posts[$i];
            $slides .= $this->view_slide($attachment, $i);            
        }

        return $slides;
    }
}

function eusf_carousel($post_id, $args = array()) {
    $gallery = new EUSF_Gallery($post_id);
    echo $gallery->view($args);
}
?>