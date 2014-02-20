<!DOCTYPE html>
<html>
    <head>
        <title>Spomi::<?php echo $pageTitle; ?></title>

        <?php if ( isset( $requiredCss ) ): ?>
            <?php foreach ( $requiredCss as $css ): ?>
                <?php echo '<link rel="stylesheet" href="' . CSS_PATH . $css . '" type="text/css" media="all" charset="utf-8" />' . "\n"; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ( isset( $requiredJsInHead ) ): ?>
            <?php foreach ( $requiredJsInHead as $js ): ?>
                <?php echo '<script type="text/javascript" charset="utf-8" src="' . JS_PATH . $js . '"></script>' . "\n"; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <script type="text/javascript">
            $(function(){

                //bind action to post now
                $('#what_now').colorbox({inline:true, width:"30%"});

                //bind action to snapshot
                $('#snapshot').colorbox({inline:true, width:"30%"});

                //bind action to private message
                $('#pm_user').colorbox({inline:true, width:"30%"});

                //bind action to user image
                $('#profile_avatar').colorbox();

                //limit field in what now popup box
                $('#post_status').limit('230',$('#post_status').next());

                //limit field in snaphot popup box
                $('#snapshot_description').limit('90',$('#snapshot_description').next());

                //limit field in private_message
                $('#user_message').limit('800',$('#user_message').next());

                //bind onhover text on follow link
                $('#follow_user').mouseover(function(){
                    if($(this).text()!='Follow'){
                        var text = ($(this).text()=='Followed')? 'Unfollow' : 'Cancel request';
                        $(this).text(text)
                    }
                }).mouseout(function(){
                    if($(this).text()!='Follow'){
                        var text = ($(this).text()=='Unfollow')? 'Followed' : 'Awaiting user response';
                        $(this).text(text)
                    }
                })

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


                //bind action to submit button for what now popup
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

                //bind action to submit button for what now popup
                $('form[name="pm_user"]').on('submit', function(e) {
                    e.preventDefault();
                    $(this).ajaxSubmit({
                        resetForm:true,
                        dataType:'text',
                        success:  function(data){
                            $.colorbox.close();
                        }
                    });
                });

                //bind action to follow user
                $('#follow_user').click(function(e){
                    var that = this;
                    e.preventDefault();
                    $.ajax({
                        type:'Post',
                        dataType:'json',
                        url:$(this).attr('href'),
                        data:{
                            pid:$('#user_id').val(),
                            sid:<?php echo $_SESSION[ 'user' ][ 'id' ] ?>
                        },
                        success:function(data){
                            if(data.status=='success_follow'){
                                $(that).attr('href', 'profile/unfollow');
                                $(that).text('Followed');
                                $(that).hover(function(){
                                    $(this).text('Unfollow')
                                }, function(){
                                    $(that).text('Followed')
                                })
                            }
                            else if(data.status=='success_unfollow'){
                                $(that).attr('href', 'profile/follow');
                                $(that).text('Follow');
                                $(that).unbind()
                            }
                            else{
                                $(that).attr('href', 'profile/unfollow');
                                $(that).text('Awaiting user response')
                                $(that).hover(function(){
                                    $(this).text('Cancel request')
                                }, function(){
                                    $(that).text('Awaiting user response')
                                })
                            }
                        }
                    })

                })


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
                    <a href="<?php echo APP_PATH; ?>" id="home"><span>Home</span></a>
                    <a href="#post_box" id="what_now"> What Happening ? Post Now!</a> |
                    <a href="<?php echo APP_PATH . 'user/draw' ?>">Draw</a> |
                    <a href="#snapshot_box" id="snapshot">Snapshot</a>
                    <input type="text" name="header_search" placeholder="search" style="padding: 0 4px; margin-left: 6px">

                    <a href="<?php echo APP_PATH . 'user/edit_profile' ?>">Edit Profile</a> |
                    <a href="<?php echo APP_PATH . 'user/privacy_setting' ?>">Privacy setting</a> |
                    <a href="<?php echo APP_PATH . 'user/invite_friend' ?>">Invite Friend</a> |
                    <a href="<?php echo APP_PATH . 'user/logout' ?>">Logout</a>
                </div>


                <div id="profile">

                    <!--USER PICTURE-->
                    <div class="module" id="avatar">
                        <a href="<?php echo USER_IMAGE_PATH . $profile[ 0 ][ 'username' ] . '/' . $profile[ 0 ][ 'image' ]; ?>" id="profile_avatar">
                            <img src="<?php echo USER_IMAGE_PATH . $profile[ 0 ][ 'username' ] . '/' . USER_THUMB_PREFIX . $profile[ 0 ][ 'image' ]; ?>" id="profile_image">
                        </a>
                    </div>


                    <!--USER INFO-->
                    <div class="module" id="avatar_info">

                        <div class="flex-module">
                            <div id="avatar_full_name"><?php echo $profile[ 0 ][ 'full_name' ]; ?></div>
                            <div id="avatar_username">@<?php echo $profile[ 0 ][ 'username' ]; ?></div>
                            <div id="avatar_biography"><?php echo $profile[ 0 ][ 'biography' ]; ?></div>
                            <div id="avatar_statistic">100 Following | 150 Followers | 50 Post | 36 Draw | 77 Snapshot</div>

                            <?php if ( $_SESSION['user']['id'] != $profile[0]['user_id'] ): ?>
                                <div id="avatar_privacy">
                                    <?php if ( !is_null( $profile[ 0 ][ 'subscriber_id' ] ) and $profile[ 0 ][ 'approved' ] == 'yes' ): ?>
                                        <a href="profile/unfollow" id="follow_user">Followed</a>
                                    <?php elseif ( !is_null( $profile[ 0 ][ 'subscriber_id' ] ) and $profile[ 0 ][ 'approved' ] == 'no' ): ?>
                                        <a href="profile/unfollow" id="follow_user">Awaiting user response</a>
                                    <?php else: ?>
                                        <a href="profile/follow" id="follow_user">Follow</a>
                                    <?php endif; ?>

                                    | <a href="#pm_box" id="pm_user">Message</a>
                                </div>
                            <?php endif; ?>



                        </div>

                    </div>


                </div>


                <div id="left_column_container">

                    <div id="left_column">


                        <!--MAIN LINK-->
                        <div class="module">

                            <ul>
                                <li class="active"><a href="<?php echo APP_PATH . 'user' ?>" class="list-link">Home<i class="chev-right"></i></a></li>
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

                <div id='pm_box' style='padding:10px; background:#fff;'>
                    <form name="pm_user" action="/profile/send_message/" method="post">
                        <textarea name="pm_user" id="user_message"></textarea>
                        <span><!--character counter by jvascript--></span> character left
                        <input type="hidden" name="user_id" value="<?php echo $profile[ 0 ][ 'user_id' ]; ?>" id="user_id">
                        <br>
                        <input type="submit" name="submit" value="submit" id="submit_snapshot">
                    </form>
                </div>

            </div>



        </div>


        <?php if ( isset( $requiredJs ) ): ?>
            <?php foreach ( $requiredJs as $js ): ?>
                <?php echo '<script type="text/javascript" charset="utf-8" src="' . JS_PATH . $js . '"></script>' . "\n"; ?>
            <?php endforeach; ?>
        <?php endif; ?>


    </body>


</html>