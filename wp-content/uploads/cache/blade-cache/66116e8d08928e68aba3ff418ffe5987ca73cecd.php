<?php global $post; ?>
<article>
    <h1><?php echo e(the_title()); ?></h1>

    <?php if(isset(get_extended($post->post_content)['main']) && strlen(get_extended($post->post_content)['main']) > 0 && isset(get_extended($post->post_content)['extended']) && strlen(get_extended($post->post_content)['extended']) > 0): ?>

        <?php echo apply_filters('the_lead', get_extended($post->post_content)['main']); ?>

        <?php echo apply_filters('the_content', get_extended($post->post_content)['extended']); ?>


    <?php else: ?>

        <?php echo the_content(); ?>


    <?php endif; ?>

</article>
