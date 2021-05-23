<?php
/* Template Name: Recipes */
get_header();
?>

	<?php if(acf_activated() && have_rows('blocks')) : ?>

		<?php while (acf_activated() && have_rows('blocks')) : the_row(); ?>
			<?php $block_type = get_row_layout();?>

			<?php include(locate_template('blocks/' . $block_type . '.php')); ?>
		<?php endwhile; ?>

	<?php endif; ?>

<section class="block filters">
	<div class="wrapper">
		<div class="search-box">
			<?php echo facetwp_display( 'facet', 'recipe_search' ); ?>
			<button class="btn white submit">Submit</button>
			<button value="Reset" onclick="FWP.reset()" class="btn reset facet-reset-button">Reset</button>
		</div>
		<div class="filter-box">
			<div class="fieldset">
				<?php echo facetwp_display( 'facet', 'beer_style' ); ?>
			</div>
			<div class="fieldset">
				<?php echo facetwp_display( 'facet', 'fermentables' ); ?>
			</div>
			<div class="fieldset">
				<?php echo facetwp_display( 'facet', 'hops' ); ?>
			</div>
			<div class="fieldset">
				<?php echo facetwp_display( 'facet', 'yeast' ); ?>
			</div>
			<div class="fieldset">
				<?php echo facetwp_display( 'facet', 'other' ); ?>
			</div>
			<div class="fieldset slider abv">
				<label for="abv">ABV</label>
				<div class="false-select">
					<div class="top">
						<button class="false-button">
							<span class="value abv-value">All</span
							><i
								class="fas fa-chevron-down"
								aria-hidden="true"
							></i>
						</button>
					</div>
					<div class="bottom">
						<?php echo facetwp_display( 'facet', 'abv' ); ?>
					</div>
				</div>
			</div>
			<div class="fieldset slider ibu">
				<label for="ibu">IBU</label>
				<div class="false-select">
					<div class="top">
						<button class="false-button">
							<span class="value ibu-value">All</span
							><i
								class="fas fa-chevron-down"
								aria-hidden="true"
							></i>
						</button>
					</div>
					<div class="bottom">
						<?php echo facetwp_display( 'facet', 'ibu' ); ?>
					</div>
				</div>
			</div>
			<div class="fieldset slider color">
				<label for="color">Color</label>
				<div class="false-select">
					<div class="top">
						<button class="false-button">
							<span class="value color-value">All</span
							><i
								class="fas fa-chevron-down"
								aria-hidden="true"
							></i>
						</button>
					</div>
					<div class="bottom">
						<?php echo facetwp_display( 'facet', 'color' ); ?>
					</div>
				</div>
			</div>
			<div class="fieldset date-range-fieldset">
				<?php echo facetwp_display( 'facet', 'brew_date' ); ?>
			</div>
		</div>
	</div>

</section>

<?php
	$args = [
        'post_type'         => 'recipe',
        'posts_per_page'    => -1,
        'order'             => 'DESC',
        'orderby'           => 'date',
		// 'meta_key'			=>
        'facetwp'         	=> true,
        
    ];

    $query = new WP_Query( $args );
?>


<section class="block listing">
	<div class="wrapper">
		<div class="items">
			<?php if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); ?>
                <?php include( locate_template('./items/recipe-item.php' )); ?>
            <?php endwhile; endif; ?>
            <?php wp_reset_postdata(); ?>
		</div>
	</div>
</section>



<?php get_footer(); ?>