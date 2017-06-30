<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_581b2c1c5fb02',
    'title' => __('OnePage Menu', 'fredriksdal'),
    'fields' => array(
        0 => array(
            'key' => 'field_581b2c28304ea',
            'label' => 'Link to menu item',
            'name' => 'section_menu_item',
            'type' => 'select',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                '' => 'No link',
                'omoss' => 'Om Fredriksdal',
                'karta' => 'Karta',
                'besoka' => 'Besöka',
                'handla' => 'Äta och handla',
                'boka' => 'Boka',
            ),
            'default_value' => array(
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 1,
            'ajax' => 0,
            'placeholder' => '',
            'disabled' => 0,
            'readonly' => 0,
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
    'position' => 'side',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));
}