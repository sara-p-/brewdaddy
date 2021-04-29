<?php 
    $id = $recipe;
    $featured_image = get_the_post_thumbnail_url( $id );
    $image_alt = get_post_meta( get_post_thumbnail_id($id), '_wp_attachment_image_alt', true );
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
                <div class="color"></div>
                <h1 class="label h6">
                    Beer Style - Beer Sub Style
                </h1>
                <h2 class="title h1"><?php echo get_the_title($id); ?></h2>
                <div class="description">
                    <?php the_field('description', $id); ?>
                </div>
                <?php the_stats(get_field('abv', $id), get_field('ibu', $id), get_field('batch_number', $id)); ?>
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
</li>