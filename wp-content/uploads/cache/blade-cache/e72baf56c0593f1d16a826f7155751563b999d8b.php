<?php $__env->startSection('content'); ?>

<div class="container">
    <?php echo $__env->make('partials.breadcrumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="grid">
        <div class="grid-sm-12">
            <h1>Kommande evenemang</h1>
        </div>
    </div>

    <div class="grid">
        <div class="grid-sm-12">
            <nav id="show-filters" class="navbar navbar-event-categories">
                <a href="#show-filters" class="event-categories-filter">Filtrera</a>
                <a href="#" class="event-categories-filter close">Dölj filter</a>
                <?php echo wp_nav_menu(array(
                        'theme_location' => 'event-categories',
                        'container' => false,
                        'container_class' => 'menu-{menu-slug}-container',
                        'container_id' => '',
                        'menu_class' => 'nav nav-horizontal',
                        'menu_id' => 'event-categories',
                        'echo' => false,
                        'before' => '',
                        'after' => '',
                        'link_before' => '',
                        'link_after' => '',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth' => 1,
                        'fallback_cb' => '__return_false'
                    ));; ?>

            </nav>
        </div>
    </div>

    <div class="grid">
        <div class="grid-md-12">
            <div class="grid">
                <?php global $post; ?>
                <?php $i = 0; ?>
                <?php while(have_posts()): ?>
                    <?php echo the_post(); ?>

                    <?php $i++; ?>

                    <div class="<?php echo e(($i == 1 || $i == 7) ? 'grid-lg-8' : 'grid-lg-4'); ?> grid-md-6 grid-sm-12">
                        <?php echo $__env->make('partials.event', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <div class="grid">
        <div class="grid-sm-12 text-center">
            <?php echo paginate_links(array(
                    'type' => 'list'
                )); ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>