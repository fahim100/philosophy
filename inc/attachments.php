<?php

function philosophy_attachments( $attachments )
{

    $post_id = null;
    if( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ){
        $post_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }

    if( !$post_id || get_post_format($post_id) != "gallery" ){
        return;
    }


    $fields         = array(
        array(
        'name'      => 'title',
        'type'      => 'text',
        'label'     => __( 'Title', 'philosophy' ),
        'default'   => 'title', 
        ),
    );

    $args = array(
        'label'         => 'Gallery',
        'post_type'     => array( 'post' ),
        'filetype'      => 'image',
        'button_text'   => __( 'Add Image', 'philosophy' ),
        'note'          => 'Attach Gallery Image',
        'fields'        => $fields,
    );

    $attachments->register( 'gallery', $args );
}

add_action( 'attachments_register', 'philosophy_attachments' );