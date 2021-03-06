<?php get_header(); ?>

<?php if(have_rows('stats')) : while(have_rows('stats')) : the_row(); ?>
<section id="stats" class="block top-card">
    <div class="wrapper">
        <div class="row">
            <?php the_beer_image(get_field('glassware'), get_sub_field('color')); ?>
            <div class="col">
                <div class="content">
                    <?php the_beer_color(get_sub_field('color')); ?>
                    <?php the_beer_style(get_the_ID()); ?>
                    <h2 class="title h1"><?php the_title(); ?></h2>
                    <?php the_batch_number(get_the_ID()); ?>
                    <div class="description">
                        <?php the_sub_field('description'); ?>
                    </div>
                    <?php the_stats(get_sub_field('abv'), get_sub_field('ibu'), get_sub_field('batch_number')); ?>
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
                        <th>Batch Size:</th>
                        <th>Boil Time:</th>
                        <th>Pre Boil:</th>
                        <th>Post Boil:</th>
                        <th>Efficiency:</th>
                        <th>Target OG:</th>
                        <th>Target FG:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php the_sub_field('batch_size'); ?> G</td>
                        <td><?php the_sub_field('boil_time'); ?> Min</td>
                        <td><?php the_sub_field('pre_boil'); ?> G</td>
                        <td><?php the_sub_field('post_boil'); ?> G</td>
                        <td><?php the_sub_field('efficiency'); ?>%</td>
                        <td><?php the_sub_field('target_og'); ?></td>
                        <td><?php the_sub_field('target_fg'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-content">
            <table class="table-fixed lines" data-mobile-table="true">
                <thead>
                    <tr>
                        <th>Brew Date:</th>
                        <th>Package Date:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php the_sub_field('brew_date'); ?></td>
                        <td><?php the_sub_field('package_date'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php endwhile; endif; ?>

<?php if(have_rows('ingredients')) : while (have_rows('ingredients')) : the_row(); ?>
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
                        <td><?php the_sub_field('quantity'); ?> lbs</td>
                        <td><?php the_sub_field('lovibond'); ?></td>
                        <td><?php the_percentage(get_fields()['ingredients']['grains'], get_sub_field('quantity')); ?>%
                        </td>
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
                        <td><?php the_sub_field('quantity'); ?> oz</td>
                        <td><?php the_sub_field('aa'); ?>%</td>
                        <td><?php the_sub_field('timing'); ?> min</td>
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
                        <td><?php the_sub_field('timing'); ?> min</td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
        <?php if(have_rows('yeast')) : ?>
        <div class="table-content">
            <h3 class="table-title">Yeast</h3>
            <table class="yeast-names">
                <thead>
                    <tr>
                        <th>Name:</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while (have_rows('yeast')) : the_row(); ?>
                    <tr>
                        <td><?php the_sub_field('name'); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endwhile; endif; ?>

<?php if(have_rows('water')) : while(have_rows('water')) : the_row(); ?>
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
                        <td><?php the_sub_field('volume'); ?> qt/lb</td>
                        <td><?php the_sub_field('temperature'); ?>&deg;F</td>
                        <td><?php the_sub_field('duration'); ?> min</td>
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
                        <th>Use:</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while(have_rows('water_additions')) : the_row(); ?>
                    <tr>
                        <td><?php the_sub_field('name'); ?></td>
                        <td><?php the_sub_field('quantity'); ?></td>
                        <td><?php the_sub_field('use'); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endwhile; endif; ?>

<?php if(get_field('brewing_log')): ?>
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
                <?php the_field('brewing_log'); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if(have_rows('fermentation')) : while(have_rows('fermentation')) : the_row(); ?>
<?php if(get_sub_field('fermintation_log')) : ?>
<section id="fermentation" class="block basic-content align-left">
    <div class="component intro margin-small">
        <div class="wrapper">
            <div class="intro-content">
                <h2 class="title">Fermintation Log</h2>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="row">
            <div class="content">
                <?php the_sub_field('fermentation_log'); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if(have_rows('fermentation_schedule')) : ?>
<section class="block table">
    <div class="wrapper">
        <div class="table-content">
            <h3 class="table-title">Schedule</h3>
            <table class="yeast-schedule">
                <thead>
                    <tr>
                        <th>Temperature:</th>
                        <th>Duration:</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while(have_rows('fermentation_schedule')) : the_row(); ?>
                    <tr>
                        <td><?php the_sub_field('temperature'); ?>&deg;F</td>
                        <td><?php the_sub_field('duration'); ?> min</td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php endif; ?>
<?php endwhile; endif; ?>

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

<?php if(have_rows('packaging_type')) : while(have_rows('packaging_type')) : the_row(); ?>
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
            <h3 class="table-title">Packaging Type</h3>
            <table class="table-fixed lines" data-mobile-table="true">
                <?php 
                    $sugar = get_sub_field('priming_sugar'); 
                    $sugar_true = true;
                    if(stripos($sugar, "null") !== false || $sugar == "") {
                        $sugar_true = false;
                    }
                    $quantity = get_sub_field('sugar_quantity');
                    $quantity_true = true;
                    if(stripos($quantity, "null") !== false || $quantity == "") {
                        $quantity_true = false;
                    }
                ?>
                <thead>
                    <tr>
                        <th>Type:</th>
                        <th>Target Carbonation:</th>
                        <?php if($sugar_true) : ?>
                        <th>Priming Sugar:</th>
                        <?php endif; ?>
                        <?php if($quantity_true) : ?>
                        <th>Sugar Quantity:</th>
                        <?php endif; ?>
                        <th>Final Volume:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php the_sub_field('package_type'); ?></td>
                        <td><?php the_sub_field('target_carbonation'); ?> Volumes</td>
                        <?php if($sugar_true) : ?>
                        <td><?php echo $sugar; ?></td>
                        <?php endif; ?>
                        <?php if($quantity_true) : ?>
                        <td><?php echo $quantity; ?> g</td>
                        <?php endif; ?>
                        <td><?php the_sub_field('final_volume'); ?> G</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php endwhile; endif; ?>


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
                            <img src="<?php echo esc_url($image['sizes']['large']); ?>"
                                alt="<?php echo esc_attr($image['alt']); ?>" />
                        </figure>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="glide__nav">
                <div class="glide__arrows" data-glide-el="controls">
                    <button class="btn white glide__arrow glide__arrow--left" data-glide-dir="<">
                        <i class="left fas fa-long-arrow-alt-left" aria-hidden="true"></i>
                        prev
                    </button>
                    <button class="btn white glide__arrow glide__arrow--right" data-glide-dir=">">
                        next
                        <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
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

<?php

	$args = [
        'post_type'         => 'recipe',
        'posts_per_page'    => 3,
        'order'             => "DESC",
        'orderby'           => "date",
        'tax_query'         => array(
            array(
                'taxonomy' => 'beer_style',
                'field'    => 'term_id',
                'terms'    => the_beer_terms(get_the_ID()),
            ),
        ),
        "post__not_in"      => array(get_the_ID()),
    ];

    $query = new WP_Query( $args );
?>

<?php if($query->post_count > 0) : ?>
<section class="block listing">
    <div class="component intro margin-small">
        <div class="wrapper">
            <div class="intro-content">
                <h2 class="title">Related Recipes</h2>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="items">
            <?php if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); ?>
            <?php include( locate_template('./items/recipe-item.php' )); ?>
            <?php endwhile; endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
    $linked_recipes = get_field('linked_recipes');
?>

<?php if($linked_recipes) : ?>
<section class="block listing">
    <div class="component intro margin-small">
        <div class="wrapper">
            <div class="intro-content">
                <h2 class="title">Linked Recipes</h2>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="items">
            <?php foreach($linked_recipes as $post) : setup_postdata($post);?>
            <?php include( locate_template('./items/recipe-item.php' )); ?>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
$next_post_url = get_permalink( get_adjacent_post(false,'',false)->ID );
$previous_post_url = get_permalink( get_adjacent_post(false,'',true)->ID );
?>

<section class="block pagination">
    <div class="wrapper">
        <div class="row">
            <div class="buttons pagination">
                <a href="<?php echo $previous_post_url; ?>" class="btn white left">
                    <i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i> Prev Recipe
                </a>
                <a href="/recipes" class="btn view-all">View All Recipes</a>
                <a href="<?php echo $next_post_url; ?>" class="btn white right">
                    Next Recipe <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>