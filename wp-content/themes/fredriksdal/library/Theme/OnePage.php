<?php

namespace Fredriksdal\Theme;

class OnePage
{
    public function __construct()
    {
        add_filter('ModularityOnePage/section_class', array($this, 'addCustomClass'), 10, 3);

        add_action('ModularityOnePage/after_section', array($this, 'addSectionContentAfter'));
        add_action('ModularityOnePage/before_section', array($this, 'addSectionContentBefore'));

        add_action('ModularityOnePage\after_modules', array($this, 'addWidgetContentAfter'));
        add_action('ModularityOnePage\before_modules', array($this, 'addWidgetContentBefore'));

    }

    public function addCustomClass($input, $postId)
    {
        $post_data = array();
        $post_data[] = get_field('horizontal_scroll', $postId) ? 'section-horizontal-scroll' : '';
        $post_data[] = get_field('background_color', $postId) ? 'background-'.get_field('background_color', $postId) : '';
        return array_filter(array_merge($input, (array) $post_data));
    }

    public function addSectionContentBefore($input)
    {
        $html = array(
            '<button class="prevPage">' .__('Previous'). '</button>',
            '<button class="nextPage">' .__('Next'). '</button>'
        );
        return $input.implode($html, '');
    }

    public function addSectionContentAfter($input)
    {
        return '<ul class="pages"></ul>'.$input;
    }

    public function addWidgetContentBefore($input)
    {
        return $input.'<div class="widget-slider">';
    }

    public function addWidgetContentAfter($input)
    {
        return '</div>'.$input;
    }
}
