<?php

function meal_chef_section_metabox($metaboxes)
{

    $meal_section_id = 0;

    if ( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ) {
        $meal_section_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }

    if('section'!=get_post_type($meal_section_id)){
        return $metaboxes;
    }

    $section_meta = get_post_meta($meal_section_id, 'meal_section_type', true);
    $section_type = $section_meta['type'];
    if('chef' != $section_type){
        return $metaboxes;
    }


    $metaboxes[] = array(
        'id' => 'meal_section_chef',
        'title' => __('Chef Sections', 'meal'),
        'post_type' => 'section',
        'context' => 'normal',
        'priority' => 'default',
        'sections' => array(
            // begin: a section
            array(
                'name' => 'section_chef',
                // 'title' => __('Select Sections', 'meal'),
                'icon' => 'fa fa-image',
                'fields' => array(
                    array(
                        'id' => 'chef',
                        'type' => 'group',
                        'title' => __('Our Chef', 'meal'),
                        'button_title' => __('New Chef', 'meal'),
                        'according_title' => __('Add New Chef', 'meal'),
                        'fields' => array(
                            array(
                                'id' => 'name',
                                'type' => 'text',
                                'title' => __('Name', 'meal')
                            ),
                            array(
                                'id' => 'title',
                                'type' => 'text',
                                'title' => __('Title', 'meal')
                            ),
                            array(
                                'id' => 'image',
                                'type' => 'image',
                                'title' => __('Image', 'meal')
                            ),
                            array(
                                'id' => 'bio',
                                'type' => 'textarea',
                                'title' => __('Bio', 'meal'),

                            ),
                            array(
                                'id'        => 'social_profile',
                                'type'      => 'fieldset',
                                'title'     => __('Social profile', 'meal'),
                                'fields'    => array(

                                    array(
                                        'id'    => 'facebook',
                                        'type'  => 'text',
                                        'title' => __('Facebook', 'meal'),
                                    ),
                                    array(
                                        'id'    => 'twitter',
                                        'type'  => 'text',
                                        'title' => __('Twitter', 'meal'),
                                    ),
                                    array(
                                        'id'    => 'instagram',
                                        'type'  => 'text',
                                        'title' => __('instagram', 'meal'),
                                    ),

                                ),
                            ),
                        )
                    ),

                ),
            ),
            // End: a Section
        ),
    );

    return $metaboxes;
}

add_filter('cs_metabox_options', 'meal_chef_section_metabox');