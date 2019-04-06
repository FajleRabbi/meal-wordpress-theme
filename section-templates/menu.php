
<?php

global $meal_section_id;
    $meal_section = get_post($meal_section_id);
    $meal_section_title = $meal_section->post_title;
    $meal_section_description = $meal_section->post_content;


?>

<div class="section bg-light" id="<?php echo esc_attr($meal_section->post_name); ?>" data-aos="fade-up">
    <div class="container">
        <div class="row section-heading justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <h2 class="heading mb-3"><?php echo esc_html($meal_section_title); ?></h2>
                <p class="sub-heading mb-5"><?php echo esc_html($meal_section_description); ?></p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <ul class="nav site-tab-nav" id="pills-tab" role="tablist">

                    <?php
                        $meal_counter = 0;
                        $meal_feat_terms = get_terms(array(
                            'taxonomy' => 'category',
                            'meta_key' => 'meal_recipe_taxonomy',
                            'meta_value' => 'a:1:{s:8:"featured";b:1;}'
                        ));
                    ?>
                    <?php foreach($meal_feat_terms as $meal_feat_term) :
                        $meal_counter++;
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if($meal_counter == 1){echo esc_attr('active'); } ?>" id="pills-<?php echo esc_attr($meal_feat_term->name); ?>-tab" data-toggle="pill"
                           href="#pills-<?php echo esc_attr($meal_feat_term->name); ?>" role="tab" aria-controls="pills-<?php echo esc_attr($meal_feat_term->name); ?>"
                           aria-selected="<?php if($meal_counter == 1){echo esc_attr('true'); } ?>"><?php echo esc_html($meal_feat_term->name); ?></a>
                    </li>
                    <?php endforeach; ?>

                </ul>
                <div class="tab-content" id="pills-tabContent">

                    <?php
                        $meal_counter = 0;
                        foreach($meal_feat_terms as $meal_feat_term) :
                        $meal_counter++;
                    ?>
                    <div class="tab-pane fade <?php if($meal_counter == 1){ echo esc_attr('show active'); } ?>" id="pills-<?php echo esc_attr($meal_feat_term->name); ?>" role="tabpanel"
                         aria-labelledby="pills-<?php echo esc_attr($meal_feat_term->name); ?>-tab">
                        <?php
                        $meal_arguments = array(
                          'post_type' => 'recipe',
                          'posts_per_page' => -1,
                          'tax_query' => array(
                              array(
                                  'taxonomy' => 'category',
                                  'field' => 'slug',
                                  'terms' => $meal_feat_term->name
                              )
                          )

                        );
                        $meal_featured_recipes= new WP_Query($meal_arguments);

                        while($meal_featured_recipes->have_posts()) :
                            $meal_featured_recipes->the_post();
                        ?>
                        <div class="d-block d-md-flex menu-food-item">
                            <div class="text order-1 mb-3">
                                <?php the_post_thumbnail(array('100', '100')); ?>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php the_excerpt(); ?>
                            </div>
                            <?php
                            $meal_recipe_price = get_post_meta(get_the_ID(), 'meal_recipe_metabox', true);
                            if(!empty($meal_recipe_price)) :
                            ?>
                            <div class="price order-2">

                                <strong><?php echo esc_html($meal_recipe_price['price']); ?></strong>
                            </div>
                            <?php endif; ?>
                        </div> <!-- .menu-food-item -->
                        <?php endwhile; wp_reset_query(); ?>

                    </div>
                    <?php endforeach; ?>

                </div>
            </div>

        </div>
    </div>
</div> <!-- .section -->