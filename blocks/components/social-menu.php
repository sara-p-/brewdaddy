<?php if(have_rows('social', 'option')) : ?>

<nav class="social">
    <ul class="social-menu">
        <?php while(have_rows('social', 'option')) : the_row(); ?>
        <li>
            <?php $link = get_sub_field('link'); ?>
            <?php $network = get_sub_field('network'); ?>
            <?php if(get_sub_field('network') == 'facebook') : ?>
            <a href="<?php echo $link['url']; ?>" target="_blank">
                <span class="visually-hidden">Facebook</span><i class="social-icon fab fa-facebook-f"
                    aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if(get_sub_field('network') == 'instagram') : ?>
            <a href="<?php echo $link['url']; ?>" target="_blank">
                <span class="visually-hidden">Instagram</span><i class="social-icon fab fa-instagram"
                    aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if(get_sub_field('network') == 'linkedin') : ?>
            <a href="<?php echo $link['url']; ?>" target="_blank">
                <span class="visually-hidden">LinkedIn</span><i class="social-icon fab fa-linkedin-in"
                    aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if(get_sub_field('network') == 'vimeo') : ?>
            <a href="<?php echo $link['url']; ?>" target="_blank">
                <span class="visually-hidden">Vimeo</span><i class="social-icon fab fa-vimeo-v"
                    aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if(get_sub_field('network') == 'youtube') : ?>
            <a href="<?php echo $link['url']; ?>" target="_blank">
                <span class="visually-hidden">YouTube</span><i class="social-icon fab fa-youtube"
                    aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if(get_sub_field('network') == 'twitter') : ?>
            <a href="<?php echo $link['url']; ?>" target="_blank">
                <span class="visually-hidden">Twitter</span><i class="social-icon fab fa-twitter"
                    aria-hidden="true"></i></a>
            <?php endif; ?>
            <?php if(get_sub_field('network') == 'email') : ?>
            <a href="<?php echo $link['url']; ?>" target="_blank">
                <span class="visually-hidden">Email</span><i class="social-icon far fa-paper-plane"
                    aria-hidden="true"></i></a>
            <?php endif; ?>
        </li>
        <?php endwhile; ?>
    </ul>
</nav>
<?php endif; ?>