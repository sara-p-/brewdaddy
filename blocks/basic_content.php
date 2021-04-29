<?php include( locate_template('./blocks/global/global_settings.php') ); ?>
<section id="<?php echo $block_id; ?>" class="block basic-content <?php the_sub_field('alignment'); ?>">
    <?php include( locate_template('./blocks/components/intro.php') ); ?>
	<div class="wrapper">
		<div class="row">
			<div class="content">
				<?php the_sub_field('content'); ?>
			</div>
            <?php include( locate_template('./blocks/components/buttons.php') ); ?>
		</div>
	</div>
</section>