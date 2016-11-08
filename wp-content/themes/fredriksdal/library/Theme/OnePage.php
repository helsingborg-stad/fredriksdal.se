<?php

namespace Fredriksdal\Theme;

class OnePage
{
    public function __construct()
    {

        //Section
        add_filter('ModularityOnePage/section_class', array($this, 'addCustomClass'), 10, 3);
        add_filter('ModularityOnePage/section_id', array($this, 'setSectionId'), 100, 3);

        //Module
        add_action('ModularityOnePage/after_modules', array($this, 'addWidgetContentAfter'));
        add_action('ModularityOnePage/before_modules', array($this, 'addWidgetContentBefore'));

        //No titles
        add_filter('get_post_metadata', array($this, 'removeAllModuleTitles'), 100, 4);
    }

    public function addCustomClass($input, $postId)
    {
        $post_data = array();
        $post_data[] = get_field('horizontal_scroll', $postId) ? 'section-horizontal-scroll' : '';
        $post_data[] = get_field('background_color', $postId) ? 'background-'.get_field('background_color', $postId) : '';
        $post_data[] = get_field('ajax_loading', $postId) ? 'async-loading' : '';

        $post_data[] = get_field('cover_section', $postId) ? 'full-screen' : '';

        return array_filter(array_merge($input, (array) $post_data));
    }

    public function addWidgetContentBefore($input)
    {
        return '<div class="widget-slider grid">';
    }

    public function addWidgetContentAfter($input)
    {
        return '</div>';
    }

    public function removeAllModuleTitles($metadata, $object_id, $meta_key, $single)
    {
        if (isset($meta_key) && $meta_key == 'modularity-module-hide-title') {
            if (!in_array(get_post_type($object_id), array('mod-text'))) {
                return true;
            }
        }
        return $metadata;
    }

    public function setSectionId($input, $postId)
    {
        return !empty(get_field('section_menu_item', $postId)) ? get_field('section_menu_item', $postId) : $input;
    }
}
