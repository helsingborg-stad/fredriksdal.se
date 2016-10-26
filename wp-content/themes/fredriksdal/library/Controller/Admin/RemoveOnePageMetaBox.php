<?php

namespace Fredriksdal\Controller\Admin;

/**
 * Remove one page Metaboxes
 */

class RemoveOnePageMetaBox
{
    private $removeFromPostType = 'onepage';

    public function __construct()
    {
        add_action('current_screen', array($this,'removeSeoFrameWorks'),999);
        add_action('admin_head', array($this,'visualHideMeta'),999);
    }

    public function removeSeoFrameWorks() {

        //Remove the seo framework
        if(isset(get_current_screen()->post_type) && get_current_screen()->post_type === $this->removeFromPostType) {
            add_filter( 'the_seo_framework_seobox_output', '__return_false' );
        }

        //Remove all in one seo framework
        remove_meta_box( 'aiosp', $this->removeFromPostType, 'normal');

        //Remove yoast seo
        remove_meta_box( 'wpseo_meta', $this->removeFromPostType, 'normal');

    }

    public function visualHideMeta() {
        if(isset(get_current_screen()->post_type) && get_current_screen()->post_type === $this->removeFromPostType) {
            echo '<style>#authordiv, #acf-group_56c33cf1470dc, #postimagediv {display: none !important;}</style>';
        }
    }
}
