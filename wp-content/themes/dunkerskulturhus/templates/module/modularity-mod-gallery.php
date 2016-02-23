<?php
    $images = get_field('mod_gallery_images', $module->ID);
?>
<ul class="image-gallery grid grid-gallery">
    <?php foreach ($images as $image) : ?>
    <li class="grid-md-3">
        <a class="box box-index lightbox-trigger" href="<?php echo $image['url']; ?>" data-caption="Caption text">
            <img alt="Image alt text" src="<?php echo $image['sizes']['medium']; ?>">
        </a>
    </li>
    <?php endforeach; ?>
</ul>
