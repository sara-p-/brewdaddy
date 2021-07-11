<?php include( locate_template('./blocks/global/global_settings.php') ); ?>
<section id="<?php echo $block_id; ?>" class="block basic-content <?php the_sub_field('alignment'); ?>">
    <?php if( get_sub_field('title')) : ?>
    <div class="component intro margin-small">
        <div class="wrapper">
            <div class="intro-content">
                <h2 class="title"><?php the_sub_field('title'); ?></h2>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="wrapper">
        <div class="row">
            <div class="content">
                <?php the_sub_field('content'); ?>
            </div>
            <?php include( locate_template('./blocks/components/buttons.php') ); ?>
        </div>
    </div>
</section>