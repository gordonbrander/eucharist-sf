<?php 
// A facade for WordPress' terribly named function.
function eusf_get_attachment_url($id) {
    return get_attachment_url($id);
}

// A facade for WordPress' terribly named function.
function eusf_get_attachment_image_url($id, $size = 'thumbnail') {
    $src = wp_get_attachment_image_src($id, $size, false);
    return $src[0];    
}

function eusf_view_attribution_link($attribution_url) {
    $text = __('Photo credit', 'eusf');
    return "<a rel='author' class='attribution' href='$attribution_url'>$text</a>";
}

// Template string function
function eusf_view_media($img) {
    return "<span class='media'>$img</span>";
}

// Template string function
function eusf_view_media_with_attribution($img, $attribution_url) {
    $attribution_link = eusf_view_attribution_link($attribution_url);
    return "<span class='media'>$attribution_link $img</span>";
}

// Template string function
function eusf_view_media_with_link($img, $link) {
    return "<span class='media'><a href='$link'>$img</a></span>";
}

// Template string function
function eusf_view_media_with_link_and_attribution($img, $link, $attribution_url) {
    $attribution_link = eusf_view_attribution_link($attribution_url);
    return "<span class='media'>$attribution_link <a href='$link'>$img</a></span>";
}

function eusf_view_attachment($id, $size = 'thumbnail', $link_to = 'image') {
    $attribution_url = get_post_meta($id, '_eusf_attribution_url', true);

    $url = '';
    if ($link_to === 'image') $url = eusf_get_attachment_image_url($id, $size);
    if ($link_to === 'attachment') $url = eusf_get_attachment_url($id);
    if ($link_to === 'attribution_url') $url = $attribution_url;
    if ($link_to === 'url') $url = get_post_meta($id, '_eusf_url', true);

    $img = wp_get_attachment_image($id, $size, false);

    if ($img && $url && $attribution_url)
        return eusf_view_media_with_link_and_attribution($img, $url, $attribution_url);

    if ($img && $attribution_url)
        return eusf_view_media_with_attribution($img, $attribution_url);

    if ($img && $url)
        return eusf_view_media_with_link($img, $url);

    return eusf_view_media($img);
}
?>