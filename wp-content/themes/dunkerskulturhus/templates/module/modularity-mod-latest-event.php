<div class="grid">
    <?php
    foreach ($posts as $post) :

        $image = get_field('event-image_url', $post->ID);
    ?>
    <div class="grid-md-3">
        <a href="<?php echo get_permalink($post->ID); ?>" class="box box-news">
            <span class="box-image" <?php if ($image) : ?>style="background-image:url('<?php echo $image; ?>');"<?php endif; ?>>
                <?php if ($image) : ?>
                    <img src="<?php echo $image; ?>">
                <?php endif; ?>
            </span>

            <span class="box-content">
                <?php if ($fields->show_title) : ?>
                <h5 class="link-item link-item-light"><?php echo apply_filters('the_title', $post->post_title); ?></h5>
                <?php endif; ?>

                <?php if ($fields->show_date) : ?>
                    <p><?php echo \Dunkers\Helper\Dt::toStringFormat(strtotime(get_field('event-date-start', $post->ID))); ?></p>
                <?php endif; ?>

                <?php if ($fields->show_excerpt) : ?>
                    <p><?php echo isset(get_extended($post->ID)['main']) ? get_extended($post->ID)['main'] : ''; ?></p>
                <?php endif; ?>
            </span>
        </a>
    </div>
    <?php endforeach; ?>
</div>