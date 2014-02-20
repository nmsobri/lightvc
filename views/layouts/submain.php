<!DOCTYPE html>
<html>

    <head>

        <title><?php echo $pageTitle ?></title>

        <?php if ( isset( $requiredCss ) ): ?>
            <?php foreach ( $requiredCss as $css ): ?>
                <?php echo '<link rel="stylesheet" href="' . WWW_CSS_PATH . $css . '" type="text/css" media="all" charset="utf-8" />' . "\n"; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ( isset( $requiredJsInHead ) ): ?>
            <?php foreach ( $requiredJsInHead as $js ): ?>
                <?php echo '<script type="text/javascript" charset="utf-8" src="' . WWW_JS_PATH . $js . '"></script>' . "\n"; ?>
            <?php endforeach; ?>
        <?php endif; ?>

    </head>


    <body>

        <div id="wrapper">

            <div id="floater"></div>

            <div id="content"><?php echo $layoutContent; ?></div>

        </div>

        <?php if ( isset( $requiredJs ) ): ?>
            <?php foreach ( $requiredJs as $js ): ?>
                <?php echo '<script type="text/javascript" charset="utf-8" src="' . WWW_JS_PATH . $js . '"></script>' . "\n"; ?>
            <?php endforeach; ?>
        <?php endif; ?>

    </body>

</html>