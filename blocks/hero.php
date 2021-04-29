<?php 
    include( locate_template('./blocks/global/global_settings.php') ); 

    $classes = ' ' . get_sub_field('alignment') . ' ' . get_sub_field('title_size');
    if(get_sub_field('full_screen') == 1) {
        $classes .= ' full-screen';
    }
    if(get_sub_field('background') == 1) {
        $classes .= ' bg';
    }

?>
<section id="<?php echo $block_id; ?>" class="block hero<?php echo $classes; ?>">
	<div class="wrapper">
		<div class="row">
			<div class="content">
                <?php if(get_sub_field('enable_icon') == 1) : ?>
                    <div class="icon">
                        <i class="fas fa-heart" aria-hidden="true"></i>
                    </div>
                <?php endif; ?>
				<h1 class="title"><?php the_sub_field('title'); ?></h1>
                <?php if(get_sub_field('content')) : ?>
                    <div class="description">
                        <?php the_sub_field('content'); ?>
                    </div>
                <?php endif; ?>
                <?php include( locate_template('./blocks/components/buttons.php') ); ?>
			</div>
		</div>
	</div>
</section>