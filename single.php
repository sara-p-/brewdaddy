<?php get_header(); ?>

<section class="block single post">
    <div class="wrapper">
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </div>
</section>

<?php 
    $featured_image = get_the_post_thumbnail_url( get_the_ID() );
    $image_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
?>

<section id="stats" class="block top-card">
	<div class="wrapper">
		<div class="row">
            <?php if ( $featured_image ) : ?>
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
					<h1 class="label h6">Beer Style - Beer Sub Style</h1>
					<h2 class="title h1"><?php the_title(); ?></h2>
					<div class="description">
						<?php the_field('description'); ?>
					</div>
					<div class="stats">
						<div class="stat">
							<p class="h3"><?php the_field('abv'); ?>% ABV | <?php the_field('ibu'); ?> IBU</p>
						</div>
						<div class="stat"><p class="h3">Batch No. <?php the_field('batch_number'); ?></p></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="block table">
	<div class="wrapper">
		<div class="table-content">
			<table class="table-fixed lines" data-mobile-table="true">
				<thead>
					<tr>
						<th>Batch Size</th>
						<th>Boil Time</th>
						<th>Pre Boil</th>
						<th>Post Boil</th>
						<th>Efficiency</th>
						<th>Target OG</th>
						<th>Target FG</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php the_field('batch_size'); ?></td>
						<td><?php the_field('boil_time'); ?></td>
						<td><?php the_field('pre_boil'); ?></td>
						<td><?php the_field('post_boil'); ?></td>
						<td><?php the_field('efficiency'); ?>%</td>
						<td><?php the_field('target_og'); ?></td>
						<td><?php the_field('target_fg'); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="table-content">
			<table class="table-fixed lines" data-mobile-table="true">
				<thead>
					<tr>
						<th>Brew Date</th>
						<th>Package Date</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php the_field('brew_date'); ?></td>
						<td><?php the_field('package_date'); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>

<section id="ingredients" class="block table">
					<div class="component intro margin-small">
						<div class="wrapper">
							<div class="intro-content">
								<h2 class="title">Ingredients</h2>
							</div>
						</div>
					</div>
					<div class="wrapper">
                        <?php if(have_rows('grains')) : ?>
                            <div class="table-content">
                                <h3 class="table-title">Grains</h3>
                                <table data-mobile-table="true">
                                    <thead>
                                        <tr>
                                            <th>Name:</th>
                                            <th>Quantity:</th>
                                            <th>Lovibond:</th>
                                            <th>% of Total:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while(have_rows('grains')) : the_row(); ?>
                                            <tr>
                                                <td><?php the_sub_field('name'); ?></td>
                                                <td><?php the_sub_field('quantity'); ?></td>
                                                <td><?php the_sub_field('lovibond'); ?></td>
                                                <td>78.53%</td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                        <?php if (have_rows('hops')) : ?>
                            <div class="table-content">
                                <h3 class="table-title">Hops</h3>
                                <table data-mobile-table="true">
                                    <thead>
                                        <tr>
                                            <th>Name:</th>
                                            <th>Quantity:</th>
                                            <th>AA:</th>
                                            <th>Timing:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while (have_rows('hops')) : the_row(); ?>
                                            <tr>
                                                <td><?php the_sub_field('name'); ?></td>
                                                <td><?php the_sub_field('quantity'); ?></td>
                                                <td><?php the_sub_field('aa'); ?></td>
                                                <td><?php the_sub_field('timing'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                        <?php if(have_rows('other')) : ?>
                            <div class="table-content">
                                <h3 class="table-title">Other</h3>
                                <table data-mobile-table="true">
                                    <thead>
                                        <tr>
                                            <th>Name:</th>
                                            <th>Quantity:</th>
                                            <th>Timing:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while(have_rows('other')) : the_row(); ?>
                                            <tr>
                                                <td><?php the_sub_field('name'); ?></td>
                                                <td><?php the_sub_field('quantity'); ?></td>
                                                <td><?php the_sub_field('timing'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                        <?php if(have_rows('yeast')) : while(have_rows('yeast')) : the_row() ?>
                            <div class="table-content">
                                <h3 class="table-title">Yeast</h3>
                                <?php if(have_rows('yeast_name')) : ?>
                                    <table class="yeast-names">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while (have_rows('yeast_name')) : the_row(); ?>
                                                <tr>
                                                    <td><?php the_sub_field('name'); ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                                <?php if(have_rows('schedule')) : ?>
                                    <table class="yeast-schedule">
                                        <thead>
                                            <tr>
                                                <th>Temperature:</th>
                                                <th>Duration:</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while (have_rows('schedule')) : the_row(); ?>
                                                <tr>
                                                    <td><?php the_sub_field('temperature'); ?></td>
                                                    <td><?php the_sub_field('duration'); ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; endif; ?>
					</div>
				</section>
                <section id="water" class="block table">
					<div class="component intro margin-small">
						<div class="wrapper">
							<div class="intro-content">
								<h2 class="title">Water</h2>
							</div>
						</div>
					</div>
					<div class="wrapper">
                        <?php if(have_rows('water_profile')) : ?>
                            <div class="table-content">
                                <h3 class="table-title">Water Profile</h3>
                                <table class="table-fixed lines" data-mobile-table="true">
                                    <thead>
                                        <tr>
                                            <th>CA<sup>+2</sup></th>
                                            <th>MG<sup>+2</sup></th>
                                            <th>NA<sup>+</sup></th>
                                            <th>CI<sup>-</sup></th>
                                            <th>SO4<sup>-2</sup></th>
                                            <th>HCO<sup>3-</sup></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while(have_rows('water_profile')) : the_row(); ?>
                                            <tr>
                                                <td><?php the_sub_field('ca_2'); ?></td>
                                                <td><?php the_sub_field('mg_2'); ?></td>
                                                <td><?php the_sub_field('na'); ?></td>
                                                <td><?php the_sub_field('ci'); ?></td>
                                                <td><?php the_sub_field('so4_2'); ?></td>
                                                <td><?php the_sub_field('hco'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                        <?php if(have_rows('mash')) : ?>
                            <div class="table-content">
                                <h3 class="table-title">Mash</h3>
                                <table data-mobile-table="true">
                                    <thead>
                                        <tr>
                                            <th>Volume:</th>
                                            <th>Temperature:</th>
                                            <th>Duration:</th>
                                            <th>Description:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while(have_rows('mash')) : the_row(); ?>
                                            <tr>
                                                <td><?php the_sub_field('volume'); ?></td>
                                                <td><?php the_sub_field('temperature'); ?></td>
                                                <td><?php the_sub_field('duration'); ?></td>
                                                <td><?php the_sub_field('description'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                        <?php if(have_rows('water_additions')) : ?>
                            <div class="table-content">
                                <h3 class="table-title">Water Additions</h3>
                                <table data-mobile-table="true">
                                    <thead>
                                        <tr>
                                            <th>Name:</th>
                                            <th>Quantity:</th>
                                            <th>Timing:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while(have_rows('water_additions')) : the_row(); ?>
                                            <tr>
                                                <td><?php the_sub_field('name'); ?></td>
                                                <td><?php the_sub_field('quantity'); ?></td>
                                                <td><?php the_sub_field('timing'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
					</div>
				</section>
                <?php if(get_field('fermentation_notes')): ?>
                    <section id="fermentation" class="block basic-content align-left">
                        <div class="component intro margin-small">
                            <div class="wrapper">
                                <div class="intro-content">
                                    <h2 class="title">Fermintation Notes</h2>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="row">
                                <div class="content">
                                    <?php the_field('fermentation_notes'); ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if(get_field('Brewing Log')): ?>
                    <section id="brewing" class="block basic-content align-left">
                        <div class="component intro margin-small">
                            <div class="wrapper">
                                <div class="intro-content">
                                    <h2 class="title">Brewing Log</h2>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="row">
                                <div class="content">
                                    <?php the_field('Brewing Log'); ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <section id="packaging" class="block table">
					<div class="component intro margin-small">
						<div class="wrapper">
							<div class="intro-content">
								<h2 class="title">Packaging</h2>
							</div>
						</div>
					</div>
					<div class="wrapper">
						<div class="table-content">
							<h3 class="table-title">Mash</h3>
							<table data-mobile-table="true">
								<thead>
									<tr>
										<th>Volume:</th>
										<th>Temperature:</th>
										<th>Duration:</th>
										<th>Discription:</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Belgium - Pilsner</td>
										<td>7.75 lbs</td>
										<td>123</td>
										<td>30 min</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</section>
                <?php if(have_rows('gravity')) : ?>
                    <section id="gravity" class="block table">
                        <div class="component intro margin-small">
                            <div class="wrapper">
                                <div class="intro-content">
                                    <h2 class="title">Gravity</h2>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="table-content grid">
                                <?php while(have_rows('gravity')) : the_row(); ?>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Name: <?php the_sub_field('name'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Gravity: <?php the_sub_field('gravity_reading'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Date: <?php the_sub_field('date'); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if(get_field('tasting_notes')) : ?>
                    <section id="tasting" class="block basic-content">
                        <div class="component intro margin-small">
                            <div class="wrapper">
                                <div class="intro-content">
                                    <h2 class="title">Tasting Notes</h2>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="row">
                                <div class="content">
                                    <?php the_field('tasting_notes'); ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <?php 
                    $images = get_field('images');
                    if( $images ): ?>
                        <ul>
                            <?php foreach( $images as $image ): ?>
                                <li>
                                    <a href="<?php echo esc_url($image['url']); ?>">
                                        <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </a>
                                    <p><?php echo esc_html($image['caption']); ?></p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php $images = get_field('images'); ?>
                <?php if($images) : ?>
                    <section id="images" class="block slider">
                        <div class="component intro margin-small">
                            <div class="wrapper">
                                <div class="intro-content">
                                    <h2 class="title">Images</h2>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="glide">
                                <div class="glide__track" data-glide-el="track">
                                    <ul class="glide__slides">
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
                                        <?php foreach($images as $image) : ?>
                                            <button class="glide__bullet" data-glide-dir="=<?php echo $i; ?>"></button>
                                        <?php $i++; endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>


<?php get_footer(); ?>