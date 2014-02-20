<h2>Privacy Setting</h2>


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


<?php echo $form->formStart( WWW_BASE_PATH . 'user/privacy_setting', false ) ?>
<ul class="form">
    <li><label>View Biography:</label> <?php echo $form->select( 'view_biography', array( ''=> 'Please Select', 'public'    => 'Public', 'protected' => 'Follower Only', 'private'   => 'Just me' ), $user_setting[ 'view_biography' ] ) ?></li>
    <li><label>View Image:</label> <?php echo $form->select( 'view_image', array( ''=> 'Please Select', 'public'    => 'Public', 'protected' => 'Follower Only', 'private'   => 'Just me' ), $user_setting[ 'view_image' ] ) ?></li>
    <li><label>View Follower:</label> <?php echo $form->select( 'view_follower', array( ''=> 'Please Select', 'public'    => 'Public', 'protected' => 'Follower Only', 'private'   => 'Just me' ), $user_setting[ 'view_follower' ] ) ?></li>
    <li><label>View Post:</label> <?php echo $form->select( 'view_post', array( ''=> 'Please Select', 'public'    => 'Public', 'protected' => 'Follower Only', 'private'   => 'Just me' ), $user_setting[ 'view_post' ] ) ?></li>
    <li><label>View Draw:</label> <?php echo $form->select( 'view_draw', array( ''=> 'Please Select', 'public'    => 'Public', 'protected' => 'Follower Only', 'private'   => 'Just me' ), $user_setting[ 'view_draw' ] ) ?></li>
    <li><label>View Snapshot:</label> <?php echo $form->select( 'view_snapshot', array( ''=> 'Please Select', 'public'    => 'Public', 'protected' => 'Follower Only', 'private'   => 'Just me' ), $user_setting[ 'view_snapshot' ] ) ?></li>
    <li><label>Private Message:</label> <?php echo $form->select( 'accept_message', array( ''=> 'Please Select', 'public'    => 'Public', 'protected' => 'Follower Only', 'private'   => 'Off' ), $user_setting[ 'accept_private_msg' ] ) ?></li>
    <li><label>Private Account:</label> <?php echo $form->select( 'private_account', array( ''=> 'Please Select', 'off' => 'Off', 'on'  => 'On' ), $user_setting[ 'private_account' ] ) ?></li>
    <li><label>&nbsp;</label> <?php echo $form->submit( 'submit' ) ?></li>
</ul>
<?php echo $form->formEnd() ?>