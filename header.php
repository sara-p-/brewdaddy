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
    </header>

<main id="main">