<?php

namespace Fredriksdal\Controller;

class Campaign extends \Municipio\Controller\BaseController
{
    public function init()
    {
        $this->getSettings();
    }

    public function getSettings()
    {
        $this->data['background_color'] = get_field('background_color', get_the_id()) ? get_field('background_color', get_the_id()) : '#B9C12D';
        $this->data['text_color'] = get_field('text_color', get_the_id()) ? get_field('text_color', get_the_id()) : '#FFFFFF';
        $this->data['title_type'] = get_field('title', get_the_id()) ? get_field('title', get_the_id()) : 'default';
        $this->data['title_custom'] = get_field('title_custom', get_the_id()) ? get_field('title_custom', get_the_id()) : null;
        $this->data['title_alignment'] = get_field('title_alignment', get_the_id()) ? get_field('title_alignment', get_the_id()) : 'left';
    }
}
