<div class="item">
    <?php if(have_rows('stats')) : while(have_rows('stats')) : the_row(); ?>
        <div class="content">
            <?php the_beer_color(get_sub_field('color')); ?>
            <?php the_beer_style(get_the_ID()); ?>
            <h2 class="title h1"><?php the_title(); ?></h2>
            <div class="description">
                <?php trim_words(get_sub_field('description'), 10); ?>
            </div>
            <?php the_stats(get_sub_field('abv'), get_sub_field('ibu'), get_sub_field('batch_number')); ?>
            <div class="buttons full-width">
                <a href="#" class="btn white"
                    >Quick View
                    <i class="far fa-eye" aria-hidden="true"></i
                ></a>
                <a href="<?php the_permalink(); ?>" class="btn"
                    >Full Recipe
                    <i
                        class="fas fa-long-arrow-alt-right"
                        aria-hidden="true"
                    ></i
                ></a>
            </div>
        </div>
    <?php endwhile; endif; ?>
</div>