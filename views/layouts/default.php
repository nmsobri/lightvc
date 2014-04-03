<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Description">
    <meta name="author" content="Author">

    <title><?php echo $pageTitle ?></title>

    <?php if( isset( $requiredCss ) ): ?>
        <?php foreach( $requiredCss as $css ): ?>
            <link rel="stylesheet" href="<?php echo CSS_PATH . $css;?>" type="text/css" media="all"/>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if( isset( $requiredJsInHead ) ): ?>
        <?php foreach( $requiredJsInHead as $js_head ): ?>
            <script type="text/javascript" src="<?php echo JS_PATH . $js_head;?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body>

    <div id="header">
        Congratulations! LightVC is working :)
    </div>

    <div id="content">
        <?php echo $layoutContent ?>
    </div>

    <?php if( isset( $requiredJs ) ): ?>
        <?php foreach( $requiredJs as $js_body ): ?>
            <script type="text/javascript" src="<?php echo JS_PATH . $js_body;?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>
