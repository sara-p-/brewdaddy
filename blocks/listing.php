<?php 

 include( locate_template('./blocks/global/global_settings.php') ); 

	
	$orderby = get_sub_field('orderby');
	$order = get_sub_field('order');
    $posts_per_page = -1;
    $amount = get_sub_field('amount');
    $beer_styles = get_sub_field('beer_styles');
    if($amount == 'some') {
        $posts_per_page = get_sub_field('how_many');
    }
	$post__in = '';
    $tax_query = '';

    if (get_sub_field('enable_filtering') == 1 && $beer_styles !== "") {
        $tax_query = [
            [
                "taxonomy"  => "beer_style",
                "field"     => "term_id",
                "terms"     => $beer_styles,
            ]
        ];
    }

	if(get_sub_field('enable_custom_selection') == 1) {
		$orderby = 'post__in';
		$posts_per_page = -1;
		$post__in = get_sub_field('custom_selection');
	}

	$args = [
        'post_type'         => 'recipe',
        'posts_per_page'    => $posts_per_page,
        'order'             => $order,
        'orderby'           => $orderby,
        'post__in'          => $post__in,
        'tax_query'         => $tax_query,
        
    ];

    $query = new WP_Query( $args );
?>


<section id="<?php echo $block_id; ?>" class="block listing">
    <?php include( locate_template('./blocks/components/intro.php') ); ?>
    <div class="wrapper">
        <div class="items">
            <?php if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); ?>
                <?php include( locate_template('./items/recipe-item.php' )); ?>
            <?php endwhile; endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</section>