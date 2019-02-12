<?php

function meal_section_type_metabox($metaboxes)
{
    $metaboxes[] = array(
        'id' => 'meal_section_type',
        'title' => __('Select section', 'meal'),
        'post_type' => 'section',
        'context' => 'normal',
        'priority' => 'default',
        'sections' => array(
            // begin: a section
            array(
                'name' => 'meal_section_type_section_one',
               // 'title' => __('Section Type', 'meal'),
                'icon' => 'fa fa-image',
                'fields' => array(
                    array(
                        'id' => 'type',
                        'type' => 'select',
                        'title' => __('Select a Section', 'meal'),
                        'options' => array(
                            'banner' => __('Banner', 'meal'),
                            'featured' => __('Featured Recipes', 'meal'),
                            'gallery' => __('Gallery', 'meal'),
                            'chef' => __('Chef', 'meal'),
                            'menu' => __('Menu', 'meal'),
                            'service' => __('Services', 'meal'),
                            'reservation' => __('Reservation', 'meal'),
                            'testimonial' => __('Testimonials', 'meal'),
                            'contact' => __('Contact', 'meal'),
                        )
                    )
                ),
            ),
            // End: a Section
        ),
    );

    return $metaboxes;
}

add_filter('cs_metabox_options', 'meal_section_type_metabox');