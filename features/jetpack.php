<?php

/**
 * Remove Jetpack's External Media feature.
 */
add_action(
    'enqueue_block_editor_assets',
    function () {
        $disable_external_media = <<<JS
document.addEventListener( 'DOMContentLoaded', function() {
    wp.hooks.removeFilter( 'blocks.registerBlockType', 'external-media/individual-blocks' );
    wp.hooks.removeFilter( 'editor.MediaUpload', 'external-media/replace-media-upload' );
} );
JS;
        wp_add_inline_script( 'jetpack-blocks-editor', $disable_external_media );
    }
);
