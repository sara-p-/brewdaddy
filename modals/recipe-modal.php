<div id="modal-<?php echo $id; ?>" class="modal" aria-hidden="true">
	<div class="modal__overlay" tabindex="-1" data-micromodal-close>
		<div
			class="modal__container"
			role="dialog"
			aria-modal="true"
			aria-labelledby="modal-<?php echo $id; ?>-title"
		>
            <?php if(have_rows('stats')) : while(have_rows('stats')) : the_row(); ?>
                <div class="modal__content">
                    <button
                        class="modal__close styled-btn"
                        aria-label="Close modal"
                        data-micromodal-close
                    >
                        Close
                    </button>
                    <?php the_beer_color(get_sub_field('color')); ?>
                    <?php the_beer_style(get_the_ID()); ?>
                    <h2 id="modal-<?php echo $id; ?>-title" class="title h1">
                        <?php the_title(); ?>
                    </h2>
                    <div class="description">
                        <?php trim_words(get_sub_field('description'), 55); ?>
                    </div>
                    <?php the_stats(get_sub_field('abv'), get_sub_field('ibu'), get_sub_field('batch_number')); ?>

                    <?php if(have_rows('ingredients')) : while (have_rows('ingredients')) : the_row(); ?>
                        <h3 class="table-title">Ingredients</h3>
                        <div class="table-content grid">
                            <?php if(have_rows('grains')) : ?>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Grains</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while(have_rows('grains')) : the_row(); ?>
                                            <tr>
                                                <td><?php the_sub_field('name'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                            <?php if(have_rows('hops')) : ?>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Hops</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while(have_rows('hops')) : the_row(); ?>
                                            <tr>
                                                <td><?php the_sub_field('name'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                            <?php if(have_rows('other')) : ?>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Other</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while(have_rows('other')) : the_row(); ?>
                                            <tr>
                                                <td><?php the_sub_field('name'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                            <?php if(have_rows('yeast')) : ?>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Yeast</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while(have_rows('yeast')) : the_row(); ?>
                                            <tr>
                                                <td><?php the_sub_field('name'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; endif; ?>
                    <div class="buttons">
                        <a href="<?php the_permalink(); ?>" class="btn recipe-button"
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
	</div>
</div>
