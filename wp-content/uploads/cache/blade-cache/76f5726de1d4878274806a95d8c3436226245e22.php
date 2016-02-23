<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo e(get_bloginfo('name')); ?></title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="pubdate" content="<?php echo e(the_time('d M Y')); ?>">
    <meta name="moddate" content="<?php echo e(the_modified_time('d M Y')); ?>">



    <meta name="google-translate-customization" content="10edc883cb199c91-cbfc59690263b16d-gf15574b8983c6459-12">

    <link rel="icon" href="<?php echo e(get_template_directory_uri()); ?>/assets/images/icons/favicon.ico" type="image/x-icon">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo e(get_template_directory_uri()); ?>/assets/images/icons/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo e(get_template_directory_uri()); ?>/assets/images/icons/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo e(get_template_directory_uri()); ?>/assets/images/icons/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo e(get_template_directory_uri()); ?>/assets/images/icons/apple-touch-icon-precomposed.png">

    <script>
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>

    <!--[if lt IE 9]>
    <script type="text/javascript">
        document.createElement('header');
        document.createElement('nav');
        document.createElement('section');
        document.createElement('article');
        document.createElement('aside');
        document.createElement('footer');
        document.createElement('hgroup');
    </script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->

    <?php echo wp_head(); ?>

</head>
<body <?php echo body_class(); ?>>
    <!--[if lt IE 9]>
        <div class="notice info browserupgrade">
            <div class="container"><div class="grid-table grid-va-middle">
                <div class="grid-col-icon">
                    <i class="fa fa-plug"></i>
                </div>
                <div class="grid-sm-12">
                Du använder en gammal webbläsare. För att hemsidan ska fungera så bra som möjligt bör du byta till en modernare webbläsare. På <a href="http://browsehappy.com">browsehappy.com</a> kan du få hjälp att hitta en ny modern webbläsare.
                </div>
            </div></div>
        </div>
    <![endif]-->

    <div id="wrapper">
        <?php echo $__env->make('partials.stripe', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="container">
            <div class="grid">
                <div class="grid-sm-12">
                    <?php echo municipio_get_logotype('negative'); ?>

                </div>
            </div>
        </div>

        <?php echo $__env->yieldContent('content'); ?>
     </div>

    <?php echo wp_footer(); ?>


</body>
</html>
