<?php $__env->startSection('content'); ?>

<div class="container no-margin-top">
    <?php echo $__env->make('partials.breadcrumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <main class="grid no-margin-top">
        <?php echo $__env->make('partials.sidebar-left', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="<?php echo e(is_active_sidebar('right-sidebar') ? 'grid-md-8 grid-lg-6' : 'grid-md-8'); ?>">
            <?php while(have_posts()): ?>
                <?php echo the_post(); ?>


                <?php echo $__env->make('partials.article', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endwhile; ?>

            <?php if(is_active_sidebar('content-area')): ?>
            <div class="grid gutter gutter-lg gutter-top">
                <?php echo dynamic_sidebar('content-area'); ?>

            </div>
            <?php endif; ?>
        </div>

        <?php if(is_active_sidebar('right-sidebar')): ?>
            <?php echo $__env->make('partials.sidebar-right', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    </main>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>