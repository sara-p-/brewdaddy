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
			<label for="search">Search</label>
			<input id="search" type="search" placeholder="Search Here" />
			<a href="#" class="btn white">Submit</a>
			<a href="#" class="btn">Reset</a>
		</div>
		<div class="filter-box">
			<div class="fieldset">
				<label for="beer-style">Beer Style</label>
				<select id="beer-style">
					<option>All</option>
					<option>Saison</option>
					<option>Porter</option>
					<option>Stout</option>
					<option>Pilsner</option>
				</select>
			</div>
			<div class="fieldset">
				<label for="beer-sub-style">Beer Sub Style</label>
				<select id="beer-sub-style">
					<option>All</option>
					<option>Saison</option>
					<option>Porter</option>
					<option>Stout</option>
					<option>Pilsner</option>
				</select>
			</div>
			<div class="fieldset">
				<label for="fermentables">Fermentables</label>
				<select id="fermentables">
					<option>All</option>
					<option>Saison</option>
					<option>Porter</option>
					<option>Stout</option>
					<option>Pilsner</option>
				</select>
			</div>
			<div class="fieldset">
				<label for="hops">Hops</label>
				<select id="hops">
					<option>All</option>
					<option>Saison</option>
					<option>Porter</option>
					<option>Stout</option>
					<option>Pilsner</option>
				</select>
			</div>
			<div class="fieldset">
				<label for="yeast">Yeast</label>
				<select id="yeast">
					<option>All</option>
					<option>Saison</option>
					<option>Porter</option>
					<option>Stout</option>
					<option>Pilsner</option>
				</select>
			</div>
			<div class="fieldset">
				<label for="other">Other</label>
				<select id="other">
					<option>All</option>
					<option>Saison</option>
					<option>Porter</option>
					<option>Stout</option>
					<option>Pilsner</option>
				</select>
			</div>
			<div class="fieldset">
				<label for="abv">ABV</label>
				<div class="false-select">
					<div class="top">
						<button class="false-button">
							<span class="value">All</span
							><i
								class="fas fa-chevron-down"
								aria-hidden="true"
							></i>
						</button>
					</div>
					<div class="bottom">
						<div class="range-label">
							<p class="range-value">0-20%</p>
							<button class="clear btn btn-small">Clear</button>
						</div>
						<div class="range">
							<input
								type="range"
								id="abv"
								min="0"
								max="20"
								value="2"
							/>
						</div>
					</div>
				</div>
			</div>
			<div class="fieldset">
				<label for="ibu">IBU</label>
				<div class="false-select">
					<div class="top">
						<button class="false-button">
							<span class="value">All</span
							><i
								class="fas fa-chevron-down"
								aria-hidden="true"
							></i>
						</button>
					</div>
					<div class="bottom">
						<div class="range-label">
							<p class="range-value">0-100+</p>
							<button class="clear btn btn-small">Clear</button>
						</div>
						<div class="range">
							<input
								type="range"
								id="ibu"
								min="0"
								max="100"
								value="50"
							/>
						</div>
					</div>
				</div>
			</div>
			<div class="fieldset">
				<label for="color">Color</label>
				<div class="false-select">
					<div class="top">
						<button class="false-button">
							<span class="value">All</span
							><i
								class="fas fa-chevron-down"
								aria-hidden="true"
							></i>
						</button>
					</div>
					<div class="bottom">
						<div class="range-label">
							<p class="range-value">0-40+</p>
							<button class="clear btn btn-small">Clear</button>
						</div>
						<div class="range">
							<input
								type="range"
								id="color"
								min="0"
								max="40"
								value="10"
							/>
						</div>
					</div>
				</div>
			</div>
			<div class="fieldset">
				<label for="date">Date</label>
				<div class="false-select">
					<div class="top">
						<button class="false-button">
							<span class="value">All</span
							><i
								class="fas fa-chevron-down"
								aria-hidden="true"
							></i>
						</button>
					</div>
					<div class="bottom">
						<div class="range-label">
							<p class="range-value">0-40+</p>
							<button class="clear btn btn-small">Clear</button>
						</div>
						<div class="range">
							<input
								type="date"
								id="date"
								min="0"
								max="40"
								value="10"
							/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="block listing">
	<div class="wrapper">
		<div class="items">
			<div class="item">
				<div class="content">
					<div class="color"></div>
					<h1 class="label h6">Beer Style - Beer Sub Style</h1>
					<h2 class="title h1">Claudia Pepperfield</h2>
					<div class="description">
						<p>
							Lorem ipsum dolor sit amet consectetur adipisicing
							elit. Dignissimos, blanditiis!
						</p>
					</div>
					<div class="stats">
						<div class="stat"><p>5.6% ABV | 24 IBU</p></div>
						<div class="stat"><p>Batch No. 15</p></div>
					</div>
					<div class="buttons full-width">
						<a href="#" class="btn white">Quick View</a>
						<a href="#" class="btn">Full Recipe</a>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="content">
					<div class="color"></div>
					<h1 class="label h6">Beer Style - Beer Sub Style</h1>
					<h2 class="title h1">Claudia Pepperfield</h2>
					<div class="description">
						<p>
							Lorem ipsum dolor sit amet consectetur adipisicing
							elit. Dignissimos, blanditiis!
						</p>
					</div>
					<div class="stats">
						<div class="stat"><p>5.6% ABV | 24 IBU</p></div>
						<div class="stat"><p>Batch No. 15</p></div>
					</div>
					<div class="buttons full-width">
						<a href="#" class="btn white">Quick View</a>
						<a href="#" class="btn">Full Recipe</a>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="content">
					<div class="color"></div>
					<h1 class="label h6">Beer Style - Beer Sub Style</h1>
					<h2 class="title h1">Claudia Pepperfield</h2>
					<div class="description">
						<p>
							Lorem ipsum dolor sit amet consectetur adipisicing
							elit. Dignissimos, blanditiis!
						</p>
					</div>
					<div class="stats">
						<div class="stat"><p>5.6% ABV | 24 IBU</p></div>
						<div class="stat"><p>Batch No. 15</p></div>
					</div>
					<div class="buttons full-width">
						<a href="#" class="btn white">Quick View</a>
						<a href="#" class="btn">Full Recipe</a>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="content">
					<div class="color"></div>
					<h1 class="label h6">Beer Style - Beer Sub Style</h1>
					<h2 class="title h1">Claudia Pepperfield</h2>
					<div class="description">
						<p>
							Lorem ipsum dolor sit amet consectetur adipisicing
							elit. Dignissimos, blanditiis!
						</p>
					</div>
					<div class="stats">
						<div class="stat"><p>5.6% ABV | 24 IBU</p></div>
						<div class="stat"><p>Batch No. 15</p></div>
					</div>
					<div class="buttons full-width">
						<a href="#" class="btn white">Quick View</a>
						<a href="#" class="btn">Full Recipe</a>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="content">
					<div class="color"></div>
					<h1 class="label h6">Beer Style - Beer Sub Style</h1>
					<h2 class="title h1">Claudia Pepperfield</h2>
					<div class="description">
						<p>
							Lorem ipsum dolor sit amet consectetur adipisicing
							elit. Dignissimos, blanditiis!
						</p>
					</div>
					<div class="stats">
						<div class="stat"><p>5.6% ABV | 24 IBU</p></div>
						<div class="stat"><p>Batch No. 15</p></div>
					</div>
					<div class="buttons full-width">
						<a href="#" class="btn white">Quick View</a>
						<a href="#" class="btn">Full Recipe</a>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="content">
					<div class="color"></div>
					<h1 class="label h6">Beer Style - Beer Sub Style</h1>
					<h2 class="title h1">Claudia Pepperfield</h2>
					<div class="description">
						<p>
							Lorem ipsum dolor sit amet consectetur adipisicing
							elit. Dignissimos, blanditiis!
						</p>
					</div>
					<div class="stats">
						<div class="stat"><p>5.6% ABV | 24 IBU</p></div>
						<div class="stat"><p>Batch No. 15</p></div>
					</div>
					<div class="buttons full-width">
						<a href="#" class="btn white"
							>Quick View
							<i class="far fa-eye" aria-hidden="true"></i
						></a>
						<a href="#" class="btn"
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
	</div>
</section>



<?php get_footer(); ?>