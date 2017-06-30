<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_5810c4152dd10',
    'title' => __('Section settings', 'fredriksdal'),
    'fields' => array(
        0 => array(
            'key' => 'field_5810c42cd50a8',
            'label' => 'Enable horizontal scroll',
            'name' => 'horizontal_scroll',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => 'Yes. Enable horisontal scrolling.',
            'default_value' => 1,
        ),
        1 => array(
            'key' => 'field_5810c45c25a2d',
            'label' => 'Select background color',
            'name' => 'background_color',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
            ),
            'other_choice' => 0,
            'save_other_choice' => 0,
            'default_value' => 'white',
            'layout' => 'horizontal',
        ),
        2 => array(
            'key' => 'field_5819c24499e97',
            'label' => 'Keep the user on the same page',
            'name' => 'ajax_loading',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => 'Yes. Load content on the same page (only applies on modules with support).',
            'default_value' => 0,
        ),
        3 => array(
            'key' => 'field_581b13c74652e',
            'label' => 'Cover whole section',
            'name' => 'cover_section',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => 'Yes. Allow modules to cover the whole section (use with caution!)',
            'default_value' => 0,
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'onepage',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'left',
    'instruction_placement' => 'field',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));
}