<?php

function meal_page_section_metabox($metaboxes)
{

    $page_id = 0;
    if ( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ) {
        $page_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }

    $current_page_template = get_post_meta( $page_id, '_wp_page_template', true );
    if ( ! in_array( $current_page_template, array( 'about-us.php', 'contact-us.php' ) ) ) {
        return $metaboxes;
    }


    $metaboxes[] = array(
        'id' => 'meal_page_sections',
        'title' => __('Page Sections', 'meal'),
        'post_type' => 'page',
        'context' => 'normal',
        'priority' => 'default',
        'sections' => array(
            // begin: a section
            array(
                'name' => 'page_sections',
                // 'title' => __('Select Sections', 'meal'),
                'icon' => 'fa fa-image',
                'fields' => array(
                    array(
                        'id' => 'sections',
                        'type' => 'group',
                        'title' => __('Select a Section', 'meal'),
                        'button_title' => __('New Section', 'meal'),
                        'according_title' => __('Add New Section', 'meal'),
                        'fields' => array(
                            array(
                                'id' => 'section',
                                'type' => 'select',
                                'options' => 'post',
                                'title' => __('Choose a section', 'meal'),
                                'query_args' => array(
                                    'post_type' => 'section',
                                    'posts_per_page' => -1
                                )
                            ),
                        )
                    )
                ),
            ),
            // End: a Section
        ),
    );

    return $metaboxes;
}

add_filter('cs_metabox_options', 'meal_page_section_metabox');