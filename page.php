<?php

get_header();
the_post();
?>

<div class="main" style="padding: 200px 0;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                the_content();
                echo '<hr>';
                echo get_transient('res_count');
                echo '</hr>';
                ?>
            </div>
        </div>
    </div>
</div>



<?php get_footer(); ?>
