<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title><?php echo $title_for_layout; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <?php
    echo $this->Html->css(array(
            '//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css',
            'style',
            '/vendor/Jcrop/css/jquery.Jcrop.css')
    );
    echo $this->Html->script(array(
            '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
            'jquery.mask.min',
            '//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js',
            'scripts',
            '/vendor/Jcrop/js/jquery.Jcrop.js')
    );

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>

</head>
    <body>
        <div id="app">
            <?php
            echo $this->Session->flash();
            echo $this->fetch('content');
            echo $this->element('sql_dump');
            ?>
        </div>
    </body>
</html>