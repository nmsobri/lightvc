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


<div id="post_what">
    <?php echo $form->formStart( APP_PATH . 'user', false ); ?>
    <?php echo $form->text( 'what_message' ); ?>
    <?php echo $form->submit( 'submit_what_message', 'submit' ); ?>
    <div id="what_message_wrapper"><span id="what_message_counter" style="z-index: 99"></span> character left</div>
    <?php echo $form->formEnd(); ?>
</div>



<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Post</a></li>
        <li><a href="user/list_draw">Draw</a></li>
        <li><a href="user/list_snapshot">Snapshot</a></li>
    </ul>



    <div id="tabs-1">



        <div class="post-wrapper">

            <div class="post-block">

                <div class="post-avatar"><img src="<?php echo USER_IMAGE_PATH . $profile[ 0 ][ 'username' ] . '/' . USER_THUMB_PREFIX . $profile[ 0 ][ 'image' ]; ?>" id="profile_image"></div>

                <div class="post-content">
                    <div class="post-header"><div class="post-avatar-fullname">Sobri Kamal</div><div class="post-avatar-username"> @sobri</div></div>
                    <div class="post-body">This is content</div>
                    <div class="post-footer"><a href="" class="post-reply-button">Expand</a></div>
                </div>

            </div>

            <div class="post-reply">

                <input type="text"><input type="submit" value="submit">

            </div>

        </div>



        <div class="post-wrapper">

            <div class="post-block">

                <div class="post-avatar"><img src="<?php echo USER_IMAGE_PATH . $profile[ 0 ][ 'username' ] . '/' . USER_THUMB_PREFIX . $profile[ 0 ][ 'image' ]; ?>" id="profile_image"></div>

                <div class="post-content">
                    <div class="post-header"><div class="post-avatar-fullname">Sobri Kamal</div><div class="post-avatar-username"> @sobri</div></div>
                    <div class="post-body">This is content</div>
                    <div class="post-footer"><a href="" class="post-reply-button">Expand</a></div>
                </div>

            </div>

            <div class="post-reply">

                <input type="text"><input type="submit" value="submit">

            </div>

        </div>



        <div class="post-wrapper">

            <div class="post-block">

                <div class="post-avatar"><img src="<?php echo USER_IMAGE_PATH . $profile[ 0 ][ 'username' ] . '/' . USER_THUMB_PREFIX . $profile[ 0 ][ 'image' ]; ?>" id="profile_image"></div>

                <div class="post-content">
                    <div class="post-header"><div class="post-avatar-fullname">Sobri Kamal</div><div class="post-avatar-username"> @sobri</div></div>
                    <div class="post-body">This is content</div>
                    <div class="post-footer"><a href="" class="post-reply-button">Expand</a></div>
                </div>

            </div>

            <div class="post-reply">

                <input type="text"><input type="submit" value="submit">

            </div>

        </div>



    </div>



</div>