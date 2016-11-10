<?php

namespace Fredriksdal\Theme;

class CustomTemplates
{
    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'addCampaignTemplate'));
    }

    public function addCampaignTemplate()
    {
        \Municipio\Helper\Template::add(
            __('Campaign', 'fredriksdal'),
            \Municipio\Helper\Template::locateTemplate('campaign.blade.php')
        );
    }
}
