
<?php if(get_sub_field('enable_buttons') == 1) : ?> 
    <div class="buttons">
        <?php if(have_rows('buttons')) : while(have_rows('buttons')) : the_row(); ?>
            <?php $link = get_sub_field('link'); ?>
            <?php 
                $icon = "";
                $right = "";
                if(get_sub_field('enable_icon') == 1) {
                    $icon = '<i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>';
                    $right = ' right';
                }
            ?>
            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="btn <?php the_sub_field('button_type'); ?><?php echo $right; ?>"><?php echo $link['title']; ?> <?php echo $icon; ?></a>
        <?php endwhile; endif; ?>
    </div>
<?php endif; ?>