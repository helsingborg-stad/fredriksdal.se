<footer class="main-footer">
    <div class="container">

        <!-- Logotype -->
        <?php if(get_field('footer_logotype_vertical_position', 'option') == 'top' || get_field('footer_logotype_vertical_position', 'option') == '' || get_field('footer_logotype_vertical_position', 'option') == false): ?>
        <div class="grid">
            <div class="grid-lg-12 <?php echo e(($pos = get_field('footer_logotype_horizontal_position', 'option')) ? 'text-' . $pos : ''); ?>">
                <?php echo municipio_get_logotype(get_field('footer_logotype', 'option')); ?>

            </div>
        </div>
        <?php endif; ?>

        <!-- Widgets -->
        <div class="grid">
            <?php if(is_active_sidebar('footer-area')): ?>
                <?php dynamic_sidebar('footer-area'); //Blade not working here? ?>
            <?php endif; ?>
        </div>

        <!-- Footer links -->
        <?php if(function_exists('have_rows')): ?>
            <?php if(have_rows('footer_icons_repeater', 'option')): ?>
                <div class="grid">
                    <div class="grid-xs-12">
                        <ul class="icons-list text-center gutter-margin text-xl">
                            <?php foreach(get_field('footer_icons_repeater', 'option') as $link): ?>
                                <li>
                                    <a href="<?php echo e($link['link_url']); ?>" target="_blank" class="link-item-light">
                                        <?php echo $link['link_icon']; ?>

                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(get_field('footer_logotype_vertical_position', 'option') == 'bottom'): ?>
        <div class="grid">
            <div class="grid-lg-12 <?php echo e(($pos = get_field('footer_logotype_horizontal_position', 'option')) ? 'text-' . $pos : ''); ?>">
                <?php echo municipio_get_logotype(get_field('footer_logotype', 'option')); ?>

            </div>
        </div>
        <?php endif; ?>

    </div>
</footer>
