<?php if(get_sub_field('enable_intro') == 1) : ?>
    <div class="component intro <?php the_sub_field('spacing'); ?>">
        <div class="wrapper">
            <div class="intro-content">
                <h2 class="title"><?php the_sub_field('title'); ?></h2>
                <?php if(get_sub_field('content')) : the_sub_field('content'); endif;?>
            </div>
        </div>
    </div>
<?php endif; ?>