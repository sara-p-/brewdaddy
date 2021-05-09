<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<?php if (is_search()) { ?>
    <meta name="robots" content="noindex, nofollow">
<?php } ?>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
<?php wp_head(); ?>

</head>

<body <?php body_class('body'); ?>>

    <a href="#main" class="skip-nav">Skip navigation</a>

    <header class="header">
        <div class="wrapper">
            <div class="row">
                <div class="logo">
                    <a href="/">Brewdaddy</a>
                </div>
                <nav class="main-menu">
                    <?php
                            $args = array(
                                'theme_location' 	=> 'main-menu',
                                'container' 		=> 'ul',
                                'items_wrap' 		=> '%3$s'
                            );
                        ?>
                        <?php wp_nav_menu($args); ?>
                </nav>
                <button class="hamburger">
                    <span class="visually-hidden">Mobile Menu</span>
                    <span class="lines">
                        <span class="line"></span>
                        <span class="line"></span>
                    </span>
                </button>
                <div class="mobile-panel">
                    <div class="wrapper">
                        <nav class="mobile-menu">
                            <?php
                                $args = array(
                                    'theme_location' 	=> 'main-menu',
                                    'container' 		=> 'ul',
                                    'items_wrap' 		=> '%3$s'
                                );
                            ?>
                            <?php wp_nav_menu($args); ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <?php if(is_single()) : ?>
            <div class="single-subnav">
                <div class="wrapper">
                    <nav class="subnav">
                        <ul>
                        </ul>
                    </nav>
                    <a href="#" class="btn share"
                        >Share<i class="fas fa-share" aria-hidden="true"></i
                    ></a>
                </div>
            </div>
        <?php endif; ?>
        <?php if(is_page_template( 'templates/recipes.php' )) : ?>
            <button class="btn full-width filter-button">
                Filters <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
            </button>

            <div id="original-panel" class="filter-panel">
                <div class="panel-container">
                    <button class="btn full-width back">
                        <span class="visually-hidden">Back</span
                        ><i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i>
                    </button>

                    <div class="filters">
                        <!-- <div class="slider-range" data-parent-filter="5" data-option="false" data-panel-option-value="">
                            <label for="amount-0">IBU</label>
                            <div class="slider"></div>
                            <div class="range-box">
                                <input type="text" id="amount-0" class="slider-values" readonly>
                                <button class="btn white btn-small slider-reset">Reset</button>
                            </div>
                        </div> -->
                    </div>

                    <div class="buttons full-width">
                        <button class="btn white filter-apply">Apply</button>
                        <button class="btn filter-reset">Reset</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </header>

<main id="main">