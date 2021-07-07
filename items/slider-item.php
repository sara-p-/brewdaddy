<?php $stats = get_field("stats", $id); ?>
<li class="glide__slide">
    <div class="row">
        <?php the_beer_image(get_field('glassware', $id), $stats['color']); ?>
        <div class="col">
            <div class="content">
                <?php the_beer_color($stats['color']); ?>
                <?php the_beer_style($id); ?>
                <h2 class="title h1"><?php echo get_the_title($id); ?></h2>
                <?php the_batch_number($id); ?>
                <div class="description">
                    <?php trim_words($stats['description']); ?>
                </div>
                <?php the_stats($stats['abv'], $stats['ibu'], $stats['batch_number']); ?>
                <?php // include( locate_template( '/blocks/components/recipe-buttons.php' )); ?>
                <div class="buttons">
                    <a href="<?php echo get_the_permalink( get_the_id() ); ?>" class="btn">Full Recipe
                        <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php // include( locate_template('/modals/recipe-modal.php') ); ?>
</li>