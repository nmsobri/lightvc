<div class="module">

    <div class="flex-module">

        <div id="box_login">

            <?php echo $form->formStart( WWW_BASE_PATH . 'login', false ) ?>
            <?php echo $form->text( 'username' ) ?>
            <?php echo $form->password( 'password' ) ?>
            <?php echo $form->submit( 'submit', 'Sign in' ) ?>
            <!--<input type="checkbox" name="remember"> <span style="display:block; margin-top:-15px; margin-left: 20px">Remember me . <a href="<?php echo WWW_BASE_PATH . 'forgot_password' ?>">Forgot Password</a></span>-->
            <?php echo $form->formEnd() ?>

        </div>

    </div>

</div>



<div class="module">

    <div class="flex-module">

        <div id="box_register">

            <div id="box_register_header">New to Spomi? Sign up</div>

            <?php echo $form->formStart( WWW_BASE_PATH . 'register', false ) ?>
            <?php echo $form->text( 'username' ) ?>
            <?php echo $form->password( 'password' ) ?>
            <?php echo $form->password( 'repeat_password' ) ?>
            <?php echo $form->text( 'email' ) ?>
            <?php echo $form->text( 'repeat_email' ) ?>
            <?php echo $form->text( 'full_name' ) ?>
            <?php echo $form->select( 'day_of_birth', $day_of_birth ) ?> <?php echo $form->select( 'month_of_birth', $month_of_birth ) ?> <?php echo $form->select( 'year_of_birth', $year_of_birth ) ?>
            <?php echo $form->submit( 'submit' ) ?>
            <?php echo $form->formEnd() ?>

        </div>

    </div>

</div>