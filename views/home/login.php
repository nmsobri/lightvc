<div class="module">

    <div class="flex-module">

        <h2>Sign in to Spomi</h2>

        <?php if ( $validator->isError() ): ?>
            <div class="error_msg">
                <?php echo $validator->showError(); ?>
            </div>
        <?php endif; ?>

        <?php if ( $session->check( 'error_msg' ) ): ?>

            <div class="error_msg">
                <?php echo $session->get( 'error_msg' ) ?>
            </div>

        <?php endif; ?>

        <?php if ( !$locked ): ?>

            <?php echo $form->formStart( APP_PATH . 'login', false ) ?>
            <ul class="form">
                <li><label>Username:</label> <?php echo $form->text( 'username' ) ?></li>
                <li><label>Password</label> <?php echo $form->password( 'password' ) ?></li>
                <li><label>&nbsp;</label> <?php echo $form->submit( 'submit' ) ?><?php echo $form->checkbox( 'remember', 'remember' ) ?>keep me logged in</li>
            </ul>
            <?php echo $form->formEnd() ?>

        <?php else: ?>

            Too many login attemps, Please try again in 15 minutes.

        <?php endif; ?>


    </div>

</div>