<div class="module">

    <div class="flex-module">

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


        <?php if ( count( $messages ) > 0 ): ?>

            <?php foreach ( $messages as $message ): ?>

                Message: <?php echo $message[ 'message' ]; ?> <br>
                Time: <?php echo $message[ 'created' ]; ?><br>
                New?: <?php echo is_null( $message[ 'last_read' ] ) ? 'Yes' : 'No' ?><br>
                Sender: <?php echo $message[ 'sender_username' ]; ?>
                <br><br>

            <?php endforeach; ?>

                    <?php echo $paginator->showPaginator(); ?>

        <?php else: ?>
            No Message

        <?php endif; ?>



    </div>

</div>