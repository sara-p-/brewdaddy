<div class="buttons">
    <button class="btn white modal-<?php echo get_the_id(); ?>">Quick View
        <i
            class="far fa-eye"
            aria-hidden="true"
        ></i
    ></button>
    <a href="<?php echo get_the_permalink( get_the_id() ); ?>" class="btn"
        >Full Recipe
        <i
            class="fas fa-long-arrow-alt-right"
            aria-hidden="true"
        ></i
    ></a>
</div>