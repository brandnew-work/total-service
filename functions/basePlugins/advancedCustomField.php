<?php

/*----------------------------------------------------------
  ページ固有cssフィールド
----------------------------------------------------------*/

if (function_exists('acf_add_local_field_group')):

  acf_add_local_field_group(array(
    'key' => 'group_620e88d9cd128',
    'title' => 'ページ固有css',
    'fields' => array(
      array(
        'key' => 'field_620e88e3abf40',
        'label' => 'cssファイル名',
        'name' => 'css_file_name',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => 'ex. top.css',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'page',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'side',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));

endif;
