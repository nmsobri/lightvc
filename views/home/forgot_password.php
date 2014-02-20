<div class="module" style="margin: 20px">

    <div class="flex-module">

        <h2>Forgot Your Password?</h2>

        <?php if ( $validator->isError() ): ?>
            <div class="error_msg">
                <?php echo $validator->showError(); ?>
            </div>
        <?php endif; ?>

        <?php if ( $session->check( 'success_msg' ) ): ?>
            <div class="success_msg">
                <?php echo $session->get( 'success_msg' ); ?>
            </div>
        <?php endif; ?>


        <?php echo $form->formStart( WWW_BASE_PATH . 'forgot_password', false ) ?>
        <ul class="form">
            <li><label>Email:</label> <?php echo $form->text( 'email' ) ?> <?php echo $form->submit( 'submit' ) ?></li>
        </ul>
        <?php echo $form->formEnd() ?>

    </div>

</div>