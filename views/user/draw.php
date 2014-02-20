<script>
    $(function(){

        //init skybrush
        var skybrush = new SkyBrush(  $( '.skybrush' ), {width:558, height:455} );

        width = skybrush.getWidth() //get initial width
        height = skybrush.getHeight(); //get initial height

        //hide tooblbar body
        $('#Palettecolors,#Toolscommands').next().css('display', 'none')

        //bind dbclick function to hide it body
        $('#Palettecolors,#Toolscommands').dblclick(function(){
            $(this).next().css('display', $(this).next().css('display') == 'block' ? 'none' : 'block' )
        })

        //load button
        loadHandler = $('#load_imageId');
        window.File && window.FileReader && window.FileList && window.Blob ? loadHandler.change(function (b) {
            b.preventDefault();
            b = b.target.files;
            if (b.length > 0 && (b = b[0], b.type.match(/image.*/))) {
                var reader = new FileReader;
                reader.onload = function (b) {
                    var c = document.createElement("img");
                    c.src = b.target.result;
                    c.onload = function () {
                        skybrush.setZoom(0.5); //im here to to fix weird bug not loading the picture during loading image
                        skybrush.setImage(c, skybrush.getWidth(),skybrush.getHeight())
                    }
                };
                reader.readAsDataURL(b)
            }
        }) : (b.addClass("disabled"), loadHandler.remove());


        //expand/contract button
        $('#expand').toggle(
        //expand
        function(){
            txt = $(this).text();
            $(this).text('Contract Drawing Board')
            $('#left_column').hide();
            $('#right_column').css({width:'96%', left:'72%'})
            skybrush.setSize(800,455)
        },
        //contract
        function(){
            $(this).text(txt)
            $('#left_column').show();
            $('#right_column').css({width:'68%', left:'74%'})
            skybrush.setSize(width,height);
        })

        //limit text
        $('#descriptionId').limit('180',$('#descriptionId').next());

        //event for submit
        $('#submitId').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '/user/draw',
                type:'Post',
                data:{
                    answer:$('#answerId').val(),
                    description:$('#descriptionId').val(),
                    image:skybrush.getImageData()
                },
                beforeSend:function(){
                    $('#save_status').html('Saving..')
                },
                success:function(data) {
                    $('#save_status').html('')
                    $('#answerId').val('');
                    $('#descriptionId').val('');
                    $('#load_imageId').val(''); //clear form
                    skybrush.newImage(width-1, height-1); //weird bug again, need -1 of full width and height if not it wont reset
                }
            });
        })
    })
</script>

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


        <a id="expand" href="" style="display: block; float: right">Expand Drawing Board</a>
        <span id="save_status" style="display: block; clear: right;float: right"></span>

        <?php echo $form->formStart( APP_PATH . 'user/draw', false ) ?>
        <ul class="form">
            <li><?php echo $form->text( 'answer' ) ?></li>
            <li><?php echo $form->textarea( 'description' ) ?><span><!--character counter by jvascript--></span> character left</li>
            <li><?php echo $form->file( 'load_image' ) ?></li>
            <li><?php echo $form->submit( 'submit' ) ?></li>
        </ul>
        <?php echo $form->formEnd() ?>


        <div class="skybrush"></div>

    </div>

</div>
