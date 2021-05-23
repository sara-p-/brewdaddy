<?php 
    $featured_image = get_the_post_thumbnail_url( $id );
    $image_alt = get_post_meta( get_post_thumbnail_id($id), '_wp_attachment_image_alt', true );
    $stats = get_field('stats', $id);
?>
<li class="glide__slide">
    <div class="row">
        <?php if($featured_image) : ?>
            <div class="col">
                <div
                    class="image"
                    style="
                        background-image: url(<?php echo $featured_image; ?>);
                    "
                >
                    <img
                        src="<?php echo $featured_image; ?>"
                        alt="<?php echo $image_alt; ?>"
                        class="visually-hidden"
                    />
                </div>
            </div>
        <?php endif; ?>
        <div class="col">
            <div class="content">
                <?php the_beer_color($stats['color']); ?>
                <?php the_beer_style($id); ?>
                <h2 class="title h1"><?php echo get_the_title($id); ?></h2>
                <div class="description">
                    <?php trim_words($stats['description']); ?>
                </div>
                <?php the_stats($stats['abv'], $stats['ibu'], $stats['batch_number']); ?>
                <div class="buttons">
                    <a href="#" class="btn white"
                        >Quick View
                        <i
                            class="far fa-eye"
                            aria-hidden="true"
                        ></i
                    ></a>
                    <a href="<?php echo get_the_permalink( $id ); ?>" class="btn"
                        >Full Recipe
                        <i
                            class="fas fa-long-arrow-alt-right"
                            aria-hidden="true"
                        ></i
                    ></a>
                </div>
            </div>
        </div>
    </div>
    <?php include( locate_template('../modals/recipe-modal.php') ); ?>
</li>