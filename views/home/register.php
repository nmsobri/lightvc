<script type="text/javascript">

    $(function(){
        //event for month
        $('#month_of_birthId').change(function(){

            //get the day selection elem
            var day_selection= $('#day_of_birthId');

            //if month is february
            if(this.value ==2){
                //if day way over 29
                if( day_selection.val()> 29){
                    day_selection.val(0);
                }
            }

            //month that have 30 day
            if( jQuery.inArray(this.value,['4','6','9','11'] ) > -1 ){
                if( day_selection.val()> 30){
                    day_selection.val(0);
                }
            }
        })

        //event for day
        $('#day_of_birthId').change(function(){
            //get month selection elem
            var month_selection = $('#month_of_birthId');

            //if day way over 29
            if(this.value > 29){
                //if month is february
                if( month_selection.val() == 2){
                    month_selection.val(0);
                }
            }

            if(this.value > 30){

                if( jQuery.inArray(month_selection.val(),['4','6','9','11'] ) > -1 ){
                    month_selection.val(0);
                }


            }

        })
    })
</script>




<div class="module" style="margin: 20px">

    <div class="flex-module">



        <h2>Register</h2>


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


        <?php echo $form->formStart( APP_PATH . 'register', false ) ?>
        <ul class="form">
            <li><label>Username:</label> <?php echo $form->text( 'username' ) ?></li>
            <li><label>Password:</label> <?php echo $form->password( 'password' ) ?></li>
            <li><label>Password again:</label> <?php echo $form->password( 'repeat_password' ) ?></li>
            <li><label>Email:</label> <?php echo $form->text( 'email' ) ?></li>
            <li><label>Email again:</label> <?php echo $form->text( 'repeat_email' ) ?></li>
            <li><label>Full name:</label> <?php echo $form->text( 'full_name' ) ?></li>
            <li><label>Date of birth:</label><?php echo $form->select( 'day_of_birth', $day_of_birth ) ?> <?php echo $form->select( 'month_of_birth', $month_of_birth ) ?> <?php echo $form->select( 'year_of_birth', $year_of_birth ) ?></li>
            <li><label>&nbsp;</label> <?php echo $form->submit( 'submit' ) ?></li>
        </ul>
        <?php echo $form->formEnd() ?>

    </div>

</div>