<?php
/**
 * @package Attachment_Analytics
 * @version 1.0
 */
/*
Plugin Name: Attachment Analytics
Description: Adds Google Analytics tracking to attachment URLs
Author: Tony O' Hare
Version: 1.0
*/

add_action("wp_enqueue_scripts", "addJavascriptToTheme" );
add_filter("wp_get_attachment_link", "addClickListenerToAttachmentLink", 10, 5);


if ( ! function_exists( 'epc_add_class_pdf' ) ) :

    function epc_add_class_pdf( $html, $id ) {

        $attachment = get_post( $id );
        $mime_type = $attachment->post_mime_type;

        // I only needed PDF but you can use whatever mime_type you need
        if ( $mime_type == 'application/pdf' ) {
            $src = wp_get_attachment_url( $id );
            $html = '<a onclick="if ( typeof attachmentAnalytics !== \'undefined\' ) {attachmentAnalytics.trackView(\'' . $src .'\')}" href="'. $src .'">'. $attachment->post_title .'</a>';
        }

        return $html;
}
endif;
add_filter('media_send_to_editor', 'epc_add_class_pdf', 20, 3);

function addClickListenerToAttachmentLink($id, $size, $permalink, $icon, $text) {
	$permalink = "shamu";
	return $permalink;
}

function addJavascriptToTheme() 
{
	wp_register_script("attachment-analytics", plugins_url("/js/attachment-analytics.js", __FILE__ ) , [], "1.0", true);
	wp_enqueue_script( 'attachment-analytics' );
}