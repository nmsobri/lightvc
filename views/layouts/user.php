<!DOCTYPE html>
<html>
    <head>
        <title>Spomi development Mode(<?php echo $pageTitle; ?>)</title>

        <?php if ( isset( $requiredCss ) ): ?>
            <?php foreach ( $requiredCss as $css ): ?>
                <?php echo '<link rel="stylesheet" href="' . WWW_CSS_PATH . $css . '" type="text/css" media="all" charset="utf-8" />' . "\n"; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ( isset( $requiredJsInHead ) ): ?>
            <?php foreach ( $requiredJsInHead as $js ): ?>
                <?php echo '<script type="text/javascript" charset="utf-8" src="' . WWW_JS_PATH . $js . '"></script>' . "\n"; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <script type="text/javascript">
            $(function(){

                //bind action to post now
                $('#what_now').colorbox({inline:true, width:"30%"});

                //bind action to snapshot
                $('#snapshot').colorbox({inline:true, width:"30%"});

                //bind action to user image
                $('#profile_avatar').colorbox();

                //limit field in what now popup box
                $('#post_status').limit('230',$('#post_status').next());

                //limit field in snaphot popup box
                $('#snapshot_description').limit('90',$('#snapshot_description').next());

                // ui tabs
                if($('#tabs').length > 0){
                    $( "#tabs" ).tabs({collapsible: true});
                }

                //limit word in main post area, the long one
                if($('#what_messageId').length > 0){
                    $('#what_messageId').limit('230',$('#what_message_counter'));
                }


                //bind action to expand
                $(document).on('click','.post-reply-button', function (e){
                    var text = $(this).text() =='Expand' ? 'Collapse' : 'Expand';
                    $(this).text(text)
                    $(this).parents('.post-block').next().toggle(400);
                    e.preventDefault();
                });


                //bind action to submit button for what now popup
                $('#submit_post_status').click(function(){
                    $.ajax({
                        url: '/user/index/status',
                        type:'Post',
                        data:{
                            status:$('#post_status').val()
                        },
                        dataType:'json',
                        beforeSend:function(){
                            $('#post_box').children('input').attr('disabled', true)
                        },
                        success: function(data) {
                            if(data.status=='success'){
                                $('#post_box').children('input[type="text"]').val('')
                                $('#post_box').children('input').attr('disabled', false)
                                $.colorbox.close();
                            }
                        }
                    });
                })


                //bind action to submit button for snapshot
                $('form[name="snapshot"]').on('submit', function(e) {
                    e.preventDefault();
                    $(this).ajaxSubmit({
                        resetForm:true,
                        dataType:'json',
                        success:  function(data){
                            if(data.status=='success'){
                                $.colorbox.close();
                            }
                        }
                    });
                });


            })

        </script>

    </head>

    <body>

        <!--STATIC BACKGROUND-->
        <div id="header"></div>

        <div id="wrapper">

            <div id="right_column_container">

                <!--TOP LINK-->
                <div id="navigation">
                    <a href="<?php echo WWW_BASE_PATH; ?>" id="home"><span>Home</span></a>
                    <a href="#post_box" id="what_now"> What Happening ? Post Now!</a> |
                    <a href="<?php echo WWW_BASE_PATH . 'user/draw' ?>">Draw</a> |
                    <a href="#snapshot_box" id="snapshot">Snapshot</a>
                    <input type="text" name="header_search" placeholder="search" style="padding: 0 4px; margin-left: 6px">

                    <a href="<?php echo WWW_BASE_PATH . 'user/edit_profile' ?>">Edit Profile</a> |
                    <a href="<?php echo WWW_BASE_PATH . 'user/privacy_setting' ?>">Privacy setting</a> |
                    <a href="<?php echo WWW_BASE_PATH . 'user/invite_friend' ?>">Invite Friend</a> |
                    <a href="<?php echo WWW_BASE_PATH . 'user/logout' ?>">Logout</a>
                </div>


                <div id="profile">

                    <!--USER PICTURE-->
                    <div class="module" id="avatar">

                        <?php if ( $profile[ 0 ][ 'image' ] == USER_DEFAULT_IMAGE ): ?>
                        <img src="<?php echo WWW_IMAGE_PATH. USER_DEFAULT_IMAGE ?>" id="profile_image">
                        <?php else: ?>
                            <a href="<?php echo USER_IMAGE_PATH . $profile[ 0 ][ 'username' ] . '/' . $profile[ 0 ][ 'image' ]; ?>" id="profile_avatar"><img src="<?php echo USER_IMAGE_PATH . $profile[ 0 ][ 'username' ] . '/' . USER_THUMB_PREFIX . $profile[ 0 ][ 'image' ]; ?>" id="profile_image"></a>
                        <?php endif; ?>

                    </div>


                    <!--USER INFO-->
                    <div class="module" id="avatar_info">

                        <div class="flex-module">
                            <div id="avatar_full_name"><?php echo $profile[ 0 ][ 'full_name' ]; ?></div>
                            <div id="avatar_username">@<?php echo $profile[ 0 ][ 'username' ]; ?></div>
                            <div id="avatar_biography"><?php echo $profile[ 0 ][ 'biography' ]; ?></div>
                            <div id="avatar_statistic">100 Following | 150 Followers | 50 Post | 36 Draw | 77 Snapshot</div>
                        </div>

                    </div>

                </div>

                <div id="left_column_container">

                    <div id="left_column">


                        <!--MAIN LINK-->
                        <div class="module">

                            <ul>
                                <li class="active"><a href="<?php echo WWW_BASE_PATH . 'user' ?>" class="list-link">Home<i class="chev-right"></i></a></li>
                                <li class=""><a href="<?php echo WWW_BASE_PATH . $profile[ 0 ][ 'username' ] ?>" class="list-link">Your Profile<i class="chev-right"></i></a></li>
                                <li class=""><a href="<?php echo WWW_BASE_PATH . 'user/inbox' ?>" class="list-link">Inbox<i class="chev-right"></i></a></li>
                                <li class=""><a href="<?php echo WWW_BASE_PATH . 'user/outbox' ?>" class="list-link">Outbox<i class="chev-right"></i></a></li>
                                <li class=""><a href="" class="list-link">Trending Users<i class="chev-right"></i></a></li>
                                <li class=""><a href="" class="list-link">Top 100 Followers<i class="chev-right"></i></a></li>
                                <li class=""><a href="" class="list-link">What's Trending<i class="chev-right"></i></a></li>
                                <li class=""><a href="" class="list-link">Top 50 Post<i class="chev-right"></i></a></li>
                                <li class=""><a href="" class="list-link">Top 50 Drawing<i class="chev-right"></i></a></li>
                                <li class=""><a href="" class="list-link">Top 50 Snapshot<i class="chev-right"></i></a></li>
                            </ul>

                        </div>


                        <!--PEOPLE YOU MAY KNOW-->
                        <div class="module">

                            <div class="flex-module">

                                <h3>People you may know</h3>

                            </div>

                        </div>


                        <!--INVITE FRIEND-->
                        <div class="module">

                            <div class="flex-module">

                                <h3>Invite Friend</h3>

                                <input type="text" name="invite" placeholder="Your friend email" style="width:92%; margin-bottom:6px">
                                <input type="submit" name="submit" value="Invite">

                            </div>

                        </div>


                        <div class="module site-footer ">

                            <div class="flex-module">

                                <ul class="clearfix">

                                    <li>&copy; 2012 Spomi</li>
                                    <li><a href="">About</a></li>
                                    <li><a href="">Help</a></li>
                                    <li><a href="">Terms</a></li>
                                    <li><a href="">Privacy</a></li>
                                    <li><a href="">Blog</a></li>
                                    <li><a href="">Status</a></li>
                                    <li><a href="">Apps</a></li>
                                </ul>

                            </div>

                        </div>

                    </div>

                    <div id="right_column"><?php echo $layoutContent ?></div>

                </div>

            </div>

            <div id="footer">Footer</div>


            <!--POST BOX / SNAPSHOT BOX-->
            <div style='display:none'>

                <div id='post_box' style='padding:10px; background:#fff;'>
                    <input type="text" name="status" id="post_status">
                    <span><!--character counter by jvascript--></span> character left
                    <br>
                    <input type="submit" name="submit" value="submit" id="submit_post_status">
                </div>

                <div id='snapshot_box' style='padding:10px; background:#fff;'>
                    <form name="snapshot" action="/user/index/snapshot" method="post" enctype="multipart/form-data">
                        <input type="text" name="snapshot_description" id="snapshot_description">
                        <span><!--character counter by jvascript--></span> character left
                        <br>
                        <input type="file" name="snapshot_image">
                        <input type="submit" name="submit" value="submit" id="submit_snapshot">
                    </form>
                </div>

            </div>



        </div>


        <?php if ( isset( $requiredJs ) ): ?>
            <?php foreach ( $requiredJs as $js ): ?>
                <?php echo '<script type="text/javascript" charset="utf-8" src="' . WWW_JS_PATH . $js . '"></script>' . "\n"; ?>
            <?php endforeach; ?>
        <?php endif; ?>


    </body>


</html>