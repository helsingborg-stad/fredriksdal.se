<?php

namespace Dunkers\Controller;

class ArchiveEvent extends \Municipio\Controller\BaseController
{
    public function init()
    {
        $this->data['enabledHeaderFilters'] = get_field('archive_' . sanitize_title(get_post_type()) . '_post_filters_header', 'option');
        $this->data['enabledSidebarFilters'] = get_field('archive_' . sanitize_title(get_post_type()) . '_post_filters_sidebar', 'option');
    }
}
