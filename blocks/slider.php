<?php 
 include( locate_template('./blocks/global/global_settings.php') ); 

    $style = get_sub_field('style');

    if($style == "style-1") {
        $images = get_sub_field('images'); 
    } else {
        $recipes = get_sub_field('recipes');
    }

?>

<section id="<?php echo $block_id; ?>" class="block slider <?php the_sub_field('style'); ?>">
    <?php include( locate_template('./blocks/components/intro.php') ); ?>
	<div class="wrapper">
		<div class="glide">
			<div class="glide__track" data-glide-el="track">
				<ul class="glide__slides">
                    <?php if($style == "style-1") : ?>
                        <?php foreach($images as $image) : ?>
                            <li class="glide__slide">
                                <figure class="image">
                                    <img
                                        src="<?php echo esc_url($image['sizes']['large']); ?>"
                                        alt="<?php echo esc_attr($image['alt']); ?>"
                                    />
                                </figure>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if($style == "style-2") : ?>
                        <?php foreach($recipes as $recipe) : ?>
                                <?php include( locate_template('./items/slider-item.php') ); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
				</ul>
			</div>
			<div class="glide__nav">
                <div class="glide__arrows" data-glide-el="controls">
                    <button
                        class="btn white glide__arrow glide__arrow--left"
                        data-glide-dir="<"
                    >
                        <i
                            class="left fas fa-long-arrow-alt-left"
                            aria-hidden="true"
                        ></i>
                        prev
                    </button>
                    <button
                        class="btn white glide__arrow glide__arrow--right"
                        data-glide-dir=">"
                    >
                        next
                        <i
                            class="fas fa-long-arrow-alt-right"
                            aria-hidden="true"
                        ></i>
                    </button>
                </div>
                <?php $i = 0; ?>
                <div class="glide__bullets" data-glide-el="controls[nav]">
                    <?php if ($style == "style-1") : ?>
                        <?php foreach($images as $image) : ?>
                            <button class="glide__bullet" data-glide-dir="=<?php echo $i; ?>"></button>
                        <?php $i++; endforeach; ?>
                    <?php endif; ?>
                    <?php if ($style == "style-2") : ?>
                        <?php foreach($recipes as $recipe) : ?>
                            <button class="glide__bullet" data-glide-dir="=<?php echo $i; ?>"></button>
                        <?php $i++; endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
		</div>
	</div>
</section>