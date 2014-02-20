<script type="text/javascript">

    var cropWidth = 150;
    var cropHeight = 150;

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


        //image upload
        $('form[name="Form2"]').on('submit', function(e) {
            e.preventDefault();
            $('#user_image_submitId').attr('disabled', ''); // disable upload button
            $("#output").html('Uploading.');
            var that = this;
            $(this).ajaxSubmit({
                dataType:'json',
                success:  function(data){
                    if('user_image' in data){
                        $('#output').html(data.user_image )
                        $('#user_image_submitId').removeAttr('disabled'); //enable submit button
                    }
                    else{
                        $('#output').html('<img src="' + data.image + '" id="crop">' )
                        $(that).hide(); //hide upload form
                        $(that).resetForm();  // reset form
                        $('#user_image_submitId').removeAttr('disabled'); //enable submit button
                        $('#crop').Jcrop({
                            setSelect: [0, 0, cropWidth, cropHeight],
                            allowResize:false,
                            allowSelect:false,
                            onSelect: updateCoords
                        });
                        $('#user_thumb_submitId').show();
                    }

                }
            });
        });

        //image crop
        $('form[name="Form3"]').on('submit', function(e) {
            e.preventDefault();
            $(this).ajaxSubmit({
                dataType:'json',
                success:  function(data){
                    $('#user_thumb_submitId').hide(); //hide crop form
                    $('#output').empty() //hide the image
                    $('form[name="Form2"]').show(); //show upload form
                    $('#profile_avatar').attr('href', data.image);
                    $('#profile_image').attr('src', data.thumb);
                }
            });
        });

        //limit text
        $('#biographyId').limit('230',$('#biographyId').next());

    })


    function updateCoords(c){
        $('#xId').val(c.x);
        $('#yId').val(c.y);
        $('#wId').val(c.w);
        $('#hId').val(c.h);
    };
</script>







<div class="module">

    <div class="flex-module">

        <h2>Edit Profile</h2>

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


        <?php echo $form->formStart( APP_PATH . 'user/edit_profile/user_data', false ) ?>
        <ul class="form">
            <li><label>Username:</label> <?php echo $form->text( 'username', $user_data[ 0 ][ 'username' ], array( 'disabled' => true ) ) ?></li>
            <li><label>Full Name:</label> <?php echo $form->text( 'full_name', $user_data[ 0 ][ 'full_name' ] ) ?></li>
            <li><label>Email Address:</label> <?php echo $form->text( 'email', $user_data[ 0 ][ 'email' ] ) ?></li>
            <li><label>Date of birth:</label><?php echo $form->select( 'day_of_birth', $day_of_birth, $user_day_of_birth ) ?> <?php echo $form->select( 'month_of_birth', $month_of_birth, $user_month_of_birth ) ?> <?php echo $form->select( 'year_of_birth', $year_of_birth, $user_year_of_birth ) ?></li>
            <li><label>Biography:</label> <?php echo $form->textarea( 'biography', $user_data[ 0 ][ 'biography' ] ) ?><span><!--character counter by jvascript--></span> character left</li>
            <li><label>Password:</label> <?php echo $form->password( 'password' ) ?></li>
            <li><label>Repeat Password:</label> <?php echo $form->password( 'repeat_password' ) ?></li>
            <li><label>&nbsp;</label> <?php echo $form->submit( 'user_data_submit' ) ?></li>
        </ul>

        <hr>

        <?php echo $form->formEnd() ?>
        <?php echo $form->formStart( APP_PATH . 'user/edit_profile/user_image', true ) ?>
        <ul class="form">
            <li><label>Image:</label> <?php echo $form->file( 'user_image' ) ?></li>
            <li><label>&nbsp;</label> <?php echo $form->submit( 'user_image_submit', 'Upload' ) ?></li>
        </ul>
        <?php echo $form->formEnd() ?>



        <div id="output"></div>


        <?php echo $form->formEnd() ?>
        <?php echo $form->formStart( APP_PATH . 'user/edit_profile/user_thumb', true ) ?>
        <?php echo $form->hidden( 'x', 0 ) ?>
        <?php echo $form->hidden( 'y', 0 ) ?>
        <?php echo $form->hidden( 'w', 0 ) ?>
        <?php echo $form->hidden( 'h', 0 ) ?>
        <?php echo $form->submit( 'user_thumb_submit', 'Crop it' ) ?>
        <?php echo $form->formEnd() ?>


    </div>

</div>