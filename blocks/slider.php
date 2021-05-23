<?php 
 include( locate_template('./blocks/global/global_settings.php') ); 

    $style = get_sub_field('style');
    $classes = $style;

    if($style == "style-1") {
        $images = get_sub_field('images'); 
    } else {
        $classes = 'top-card ' . $style;
        $recipes = get_sub_field('recipes');
        $type = get_sub_field('recipe_type');
        $how_many = get_sub_field('how_many');

        $args = [
            'post_type'         => 'recipe',
            'posts_per_page'    => $how_many,
            'order'             => 'DESC',
            'facetwp'           => false,
            'meta_key'          => 'stats_brew_date',
            'orderby'           => 'meta_value',
        ];

        $query = new WP_Query( $args );
        // var_dump($query);
    }



?>

<section id="<?php echo $block_id; ?>" class="block slider <?php echo $classes; ?>">
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
                        <?php if($type == "recent") : ?>
                            <?php if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); ?>
                                <?php $id = get_the_ID(); ?> 
                                  
                                <?php include( locate_template('./items/slider-item.php' )); ?>
                            <?php endwhile; endif; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php else : ?>
                            <?php foreach($recipes as $recipe) : ?>
                                <?php $id = $recipe; ?>
                                <?php include( locate_template('./items/slider-item.php') ); ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
                        <?php if($type == "recent") : ?>
                            <?php if($query->have_posts()) : $x = 0; while($query->have_posts()) : $query->the_post(); ?>
                                <button class="glide__bullet" data-glide-dir="=<?php echo $x; ?>"></button>  
                            <?php endwhile; $x++; endif; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php else : ?>
                            <?php foreach($recipes as $recipe) : ?>
                                <button class="glide__bullet" data-glide-dir="=<?php echo $i; ?>"></button>
                            <?php $i++; endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
		</div>
	</div>
</section>