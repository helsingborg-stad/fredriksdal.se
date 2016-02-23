<?php

    $attachmentId = get_post_thumbnail_id();
    $image = wp_get_attachment_image_src($attachmentId, array(1024, 575));
    if (isset($image[0])) {
        $image = $image[0];
    }

?>
<a href="<?php echo e(the_permalink()); ?>" class="box box-event">
    <?php if($image): ?>
    <span class="box-image" style="background-image:url('<?php echo e($image); ?>');">
        <img src="<?php echo e($image); ?>" alt="<?php echo e(get_the_title()); ?>">
    </span>
    <?php endif; ?>

    <div class="event-information">
        <time class="event-date-start">
            <?php echo e(date('Y-m-d \k\l\. H:i', strtotime(get_field('event-date-start')))); ?>


            <?php if($post->occations_count > 1): ?>
            <em style="font-style:italic;">(och <?php echo e($post->occations_count); ?> andra tillfällen)</em>
            <?php endif; ?>
        </time>
        <h3 class="event-title"><?php echo e(the_title()); ?></h3>
    </div>
    <div class="event-lead">
        <?php echo the_content(); ?>

    </div>
    <span class="event-action btn btn-circle btn-green"><span>Läs mer</span></span>
</a>
