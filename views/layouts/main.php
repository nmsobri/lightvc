<!DOCTYPE html>
<html>

    <head>
        <title><?php echo $pageTitle ?></title>
        <?php if ( isset( $requiredCss ) ): ?>
            <?php foreach ( $requiredCss as $css ): ?>
                <?php echo '<link rel="stylesheet" href="' . CSS_PATH . $css . '" type="text/css" media="all" charset="utf-8" />' . "\n"; ?>
            <?php endforeach; ?>
        <?php endif; ?>


        <?php if ( isset( $requiredJsInHead ) ): ?>
            <?php foreach ( $requiredJsInHead as $js ): ?>
                <?php echo '<script type="text/javascript" charset="utf-8" src="' . JS_PATH . $js . '"></script>' . "\n"; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </head>

    <body>
        <div id="wrapper">

            <div id="floater"></div>

            <div id="container_left">

                <div id="container_right">

                    <div id="left">
                        Welcome to Spomi.
                        Find out what's happening, right now, with the people and organizations you care about.
                    </div>

                    <div id="right"><?php echo $layoutContent; ?></div>

                </div>


            </div>

        </div>

        <?php if ( isset( $requiredJs ) ): ?>
            <?php foreach ( $requiredJs as $js ): ?>
                <?php echo '<script type="text/javascript" charset="utf-8" src="' . JS_PATH . $js . '"></script>' . "\n"; ?>
            <?php endforeach; ?>
        <?php endif; ?>

    </body>


</html>