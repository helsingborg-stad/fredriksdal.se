<div class="hero">
    <?php if(is_active_sidebar('slider-area')): ?>
        <?php echo e(dynamic_sidebar('slider-area')); ?>

    <?php endif; ?>

    <?php echo $__env->make('partials.stripe', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php if(is_front_page() && get_field('front_page_hero_search', 'option') === true): ?>
        <?php echo e(get_search_form()); ?>

    <?php endif; ?>

    <div class="scroll-down-please">
        <div class="scroll-down-please-icon"></div>
        Scrolla ner
    </div>
</div>
