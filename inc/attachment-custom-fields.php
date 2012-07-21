<?php
// Instantiate this class to create a new form field for an attachment.
// See <http://net.tutsplus.com/tutorials/wordpress/creating-custom-fields-for-attachments-in-wordpress/>
class EUSF_Attachment_Custom_Field {
    // $name is required. Do NOT prepend with a _, since that will cause it
    // to be hidden!
    function __construct($name, $args = array(), $escape = 'esc_html', $sanitize = 'sanitize_text_field') {
        $defaults = array(
            'label' => 'My custom field',
            'input' => 'text'
        );
        $this->args = array_merge($defaults, $args);
        $this->name = $name;
        $this->escape = $escape;
        $this->sanitize = $sanitize;
    }

    function attach_hooks() {
        add_filter( 'attachment_fields_to_edit', array( $this, 'attachment_fields_to_edit'), 10, 2 );
        add_filter( 'attachment_fields_to_save', array( $this, 'attachment_fields_to_save'), 10, 2 );
    }

    function get_meta_key() {
        return sanitize_key('_'.$this->name);
    }

    function attachment_fields_to_edit($form_fields, $post) {
        $args = $this->args;
        $name = $this->name;
        $escape = $this->escape;

        $value = get_post_meta($post->ID, $this->get_meta_key(), true);
        if (!$value) {
            $value = '';
        }

        $form_fields[$name] = array_merge($args, array(
            'value' => $escape($value)
        ));

        return $form_fields;
    }

    function attachment_fields_to_save($post, $attachment) {
        if( isset($attachment[$this->name]) ) {
            $this->update($post['ID'], $this->get_meta_key(), $attachment[$this->name]);
        }
        return $post;
    }

    function update($post_id, $meta_key, $meta_value) {
        $sanitize = $this->sanitize;
        $escape = $this->escape;
        return update_post_meta( $post_id, $meta_key, $sanitize($escape($meta_value)) );
    }
}
?>