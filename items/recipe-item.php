<div class="item">
    <div class="content">
        <div class="color"></div>
        <h1 class="label h6">Beer Style - Beer Sub Style</h1>
        <h2 class="title h1"><?php the_title(); ?></h2>
        <p class="description">
            <?php trim_words(get_field('description'), 20); ?>
        </p>
        <?php the_stats(get_field('abv'), get_field('ibu'), get_field('batch_number')); ?>
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
</div>