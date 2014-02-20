<?php

class UserController extends AppController
{

    protected $layout = 'user';


    public function beforeAction()
    {
        $this->requireCss('user.css');
        $this->requireCss('jquery-colorbox.css'); //used in popup
        $this->requireJsInHead('jquery-colorbox.js'); //used in popup
        $this->requireJsInHead('jquery-limit.js'); //used in popup
        $this->requireJsInHead('jquery-form.js'); //used in form inside popup

        $session = $this->registry->get('session');
        $user_data = $session->get('user');
        $db = new Database(DB_DSN, DB_USER, DB_PASS);
        $profile = $db->query("SELECT u.id AS user_id, u.username, p.full_name, p.email, p.biography, p.image FROM `users` AS u INNER JOIN profiles AS p ON u.id = p.user_id WHERE u.username =?", array($user_data['username']))->execute();
        $this->setLayoutVar('profile', $profile);
        $this->registry->set('profile', $profile);

        $auth = new Authentication($session, $this->registry->get('cookie'));
        if (!$auth->isAuth()) {
            $session->flash('error_msg', 'Please login first');
            $this->redirect(WWW_BASE_PATH . 'login');
        }
    }


    public function actionIndex($type = null)
    {
        $this->requireCss('jquery-ui.css');
        $this->requireJsInHead('jquery-ui.js');

        $session = $this->registry->get('session');
        $form = new Form();
        $request = new Request($session);
        $validator = new Validator();
        $user_data = $session->get('user');

        if (!$request->isAjax()) {
            if ($request->postToGet()) {
                $validator->addValidator('status', new RegexValidator('status', $_POST['what_message'], '#^([^^])+$#', array('field' => 'message')));

                if ($validator->isValid()) {
                    include APP_PATH . 'classes/class.Utility.php';
                    $db = new Database(DB_DSN, DB_USER, DB_PASS);
                    $hash_tags = Utility::getHash($_POST['status']);

                    //user post
                    $db->query("INSERT INTO posts (user_id, message, created) VALUES (?,?,NOW())", array($user_data['id'], $_POST['what_message']))->execute();

                    //hash tag
                    if ($hash_tags) {
                        $values = '';
                        foreach ($hash_tags as $tag) {
                            $values .= '(' . $db->getLastInsertId() . ',"' . $tag . '"),';
                        }

                        $values = rtrim($values, ',');
                        $db->query('INSERT INTO post_tags (post_id, tag) VALUES ' . $values)->execute();
                    }

                    $session->flash('success_msg', 'Successfully create new status');
                    $this->redirect(WWW_BASE_PATH . 'user');
                }
            }

            $this->setVar('profile', $this->registry->get('profile'));
            $this->setVar('form', $form);
            $this->setVar('session', $session);
            $this->setVar('validator', $validator);
        } else {
            include APP_PATH . 'classes/class.Utility.php';
            $db = new Database(DB_DSN, DB_USER, DB_PASS);

            if ($type == 'status') {
                $hash_tags = Utility::getHash($_POST['status']);

                //user post
                $db->query("INSERT INTO posts (user_id, message, created) VALUES (?,?,NOW())", array($user_data['id'], $_POST['status']))->execute();

                //hash tag
                if ($hash_tags) {
                    $values = '';
                    foreach ($hash_tags as $tag) {
                        $values .= '(' . $db->getLastInsertId() . ',"' . $tag . '"),';
                    }

                    $values = rtrim($values, ',');
                    $db->query('INSERT INTO post_tags (post_id, tag) VALUES ' . $values)->execute();
                }

                echo json_encode(array('status' => 'success'));
            } else {
                $user_img_dir = USER_IMAGE_DIR . $user_data['username'] . '/';
                if (!is_dir($user_img_dir))
                    mkdir($user_img_dir, 0777);

                $image = new Image($_FILES['snapshot_image']['tmp_name']);
                $image->resize(500, 500, 'auto');
                $image_name = USER_IMAGE_PREFIX . $user_data['username'] . substr(uniqid(), -5) . '.' . $image->getExtension();
                $image->save($user_img_dir . $image_name);


                //user snapshot
                $db->query("INSERT INTO snapshots (user_id, description, image, created) VALUES (?,?,?, NOW())", array($user_data['id'], $_POST['snapshot_description'], $image_name))->execute();

                $hash_tags = Utility::getHash($_POST['snapshot_description']);

                //hash tag
                if ($hash_tags) {
                    $values = '';
                    foreach ($hash_tags as $tag) {
                        $values .= '(' . $db->getLastInsertId() . ',"' . $tag . '"),';
                    }

                    $values = rtrim($values, ',');
                    $db->query('INSERT INTO snapshot_tags (snapshot_id, tag) VALUES ' . $values)->execute();
                }


                echo json_encode(array('status' => 'success'));
            }

            $this->disableDefaultView();
        }
    }


    public function actionEditProfile($type = null)
    {
        $this->requireCss('jquery-jcrop.css');
        $this->requireJsInHead('jquery-jcrop.js');

        $session = $this->registry->get('session');
        $validator = new Validator();
        $form = new Form();
        $request = new Request($session);
        $db = new Database(DB_DSN, DB_USER, DB_PASS);
        $user_data = $session->get('user');

        $user_img_dir = USER_IMAGE_DIR . $user_data['username'] . '/';
        $user_img_path = USER_IMAGE_PATH . $user_data['username'] . '/';


        $day_of_birth = array_merge(array('Please Select'), range(1, 31));
        $month_of_birth = array(0 => 'Please Select', 1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
        $year_of_birth = array_merge(array('Please Select'), range(1950, date('Y') - 13));


        if ($type == 'user_data' or $type == null) {
            if ($request->postToGet()) {
                $validator->addValidator('full_name', new TextValidator('full_name', $_POST['full_name'], array('field' => 'full name', 'allow_space' => true)));
                $validator->addValidator('email', new EmailValidator('email', $_POST['email'], array()));
                $validator->addValidator('day_of_birth', new SelectValidator('day_of_birth', $_POST['day_of_birth'], array('field' => 'day of birth')));
                $validator->addValidator('month_of_birth', new SelectValidator('month_of_birth', $_POST['month_of_birth'], array('field' => 'month of birth')));
                $validator->addValidator('year_of_birth', new SelectValidator('year_of_birth', $_POST['year_of_birth'], array('field' => 'year of birth')));
                $validator->addValidator('biography', new RegexValidator('biography', $_POST['biography'], '#[a-zA-Z0-9\s:/.]+#', array()));

                if (!empty($_POST['password'])) {
                    $validator->addValidator('password', new TextValidator('password', $_POST['password'], array('allow_num' => true, 'min_length' => 6, 'max_length' => 24)));
                    $validator->addValidator('repeat_password', new CompareValidator('repeat_password', $_POST['repeat_password'], $_POST['password'], 'password', array('field' => 'repeat password')));
                }

                if ($validator->isValid()) {
                    /* check is email belong to someone else */
                    $is_email_exist = $db->query("SELECT * FROM profiles WHERE email =? AND user_id !=?", array($_POST['email'], $user_data['id']))->totalrow()->execute();

                    if (!$is_email_exist > 0) {
                        include APP_PATH . 'classes/class.Utility.php';
                        $dob = new DateTime($year_of_birth[$_POST['year_of_birth']] . '-' . $_POST['month_of_birth'] . '-' . $_POST['day_of_birth']);
                        $password = Utility::hashedPassword(SALT, $_POST['password']);

                        /* update profiles */
                        $db->update('profiles', array('full_name' => '?', 'email' => '?', 'date_of_birth' => '?', 'biography' => '?'), array($_POST['full_name'], $_POST['email'], $dob->format('Y-m-d H:i:s'), $_POST['biography']))->where("user_id=?", array($user_data['id']))->execute();

                        /* update password */
                        if (!empty($_POST['password'])) {
                            $db->update('users', array('password' => '?'), array($password))->where("id=?", array($user_data['id']))->execute();
                        }

                        $session->flash('success_msg', 'Successfully update profile');
                        $this->redirect(WWW_BASE_PATH . 'user/edit_profile');
                    } else {
                        $validator->invalidateValidation('That email belong to someone else');
                    }
                }
            }
        } elseif ($type == 'user_image') {
            $validator->addValidator('user_image', new FileValidator('user_image', $_FILES['user_image']['name'], array('field' => 'image')));

            if ($validator->isValid()) {
                if (!is_dir($user_img_dir))
                    mkdir($user_img_dir, 0777);

                $image = new Image($_FILES['user_image']['tmp_name']);
                $image->resize(500, 500, 'auto');

                $image_name = USER_IMAGE_PREFIX . $user_data['username'] . substr(uniqid(), -5) . '.' . $image->getExtension();

                $image->save($user_img_dir . $image_name);

                $user_image = $db->select('profiles', 'image')->where("user_id=?", array($user_data['id']))->execute();

                //delete old file if exist
                @unlink($user_img_dir . $user_image[0]['image']);

                //save to db
                $db->update('profiles', array('image' => '?'), array($image_name))->where("user_id=?", array($user_data['id']))->execute();

                $session->flash('image_name', $image_name); //save new image name for thumb
                $session->flash('image_old', $user_image[0]['image']); //save old image

                echo json_encode(array('image' => $user_img_path . $image_name)); //send to browser

                $this->disableDefaultView();
            } else {
                echo json_encode($validator->getAllError());
            }

            $this->disableDefaultView();
        } else {
            include APP_PATH . 'classes/class.Utility.php';
            $thumb_name = USER_THUMB_PREFIX . $session->get('image_name');
            $source = $user_img_dir . $session->get('image_name');
            $destination = $user_img_dir . $thumb_name;
            Utility::createThumb($source, $destination, array('x' => $_POST['x'], 'y' => $_POST['y'], 'w' => $_POST['w'], 'h' => $_POST['h']));

            //delete old file if exist
            @unlink($user_img_dir . USER_THUMB_PREFIX . $session->get('image_old'));
            echo json_encode(array('image' => $user_img_path . $session->get('image_name'), 'thumb' => $user_img_path . $thumb_name));

            $this->disableDefaultView();
        }


        $session_data = $session->get('user');
        $user_data = $db->query("SELECT u.id AS user_id, u.username, p.full_name, p.email, DATE(p.date_of_birth) AS date_of_birth,
                                    p.biography  FROM `users` AS u INNER JOIN profiles AS p ON u.id = p.user_id WHERE u.id =?", array($session_data['id'])
        )->execute();


        $date_of_birth = $user_data[0]['date_of_birth'];
        $date_of_birth = explode('-', $date_of_birth);

        $user_year_of_birth = $date_of_birth[0];
        $user_month_of_birth = $date_of_birth[1];
        $user_day_of_birth = $date_of_birth[2];

        /* translate year to its key */
        foreach ($year_of_birth as $key => $val) {
            if ($val == $user_year_of_birth) {
                $user_year_of_birth = $key;
                break;
            }
        }


        $this->setVar('user_year_of_birth', $user_year_of_birth);
        $this->setVar('user_month_of_birth', $user_month_of_birth);
        $this->setVar('user_day_of_birth', $user_day_of_birth);
        $this->setVar('day_of_birth', $day_of_birth);
        $this->setVar('month_of_birth', $month_of_birth);
        $this->setVar('year_of_birth', $year_of_birth);
        $this->setVar('user_data', $user_data);
        $this->setVar('validator', $validator);
        $this->setVar('form', $form);
        $this->setVar('session', $session);
    }


    public function actionPrivacySetting()
    {
        $validator = new Validator();
        $form = new Form();
        $session = $this->registry->get('session');
        $request = new Request($session);
        $db = new Database(DB_DSN, DB_USER, DB_PASS);
        $session_data = $session->get('user');


        if ($request->postToGet()) {
            $validator->addValidator('view_biography', new SelectValidator('view_biography', $_POST['view_biography'], array('field' => 'view biography')));
            $validator->addValidator('view_image', new SelectValidator('view_image', $_POST['view_image'], array('field' => 'view image')));
            $validator->addValidator('view_follower', new SelectValidator('view_follower', $_POST['view_follower'], array('field' => 'view follower')));
            $validator->addValidator('view_post', new SelectValidator('view_post', $_POST['view_post'], array('field' => 'view post')));
            $validator->addValidator('view_draw', new SelectValidator('view_draw', $_POST['view_draw'], array('field' => 'view draw')));
            $validator->addValidator('view_snapshot', new SelectValidator('view_snapshot', $_POST['view_snapshot'], array('field' => 'view snapshot')));
            $validator->addValidator('accept_message', new SelectValidator('accept_message', $_POST['accept_message'], array('field' => 'accept message')));
            $validator->addValidator('private_account', new SelectValidator('private_account', $_POST['private_account'], array('field' => 'private account')));

            if ($validator->isValid()) {
                $db->update(
                    'user_privacy', array('view_biography' => '?', 'view_image' => '?', 'view_follower' => '?', 'view_post' => '?', 'view_draw' => '?',
                        'view_snapshot' => '?', 'accept_private_msg' => '?', 'private_account' => '?'), array($_POST['view_biography'],
                        $_POST['view_image'], $_POST['view_follower'], $_POST['view_post'], $_POST['view_draw'], $_POST['view_snapshot'],
                        $_POST['accept_message'], $_POST['private_account'])
                    )->where("user_id=?", array($session_data['id']))->execute();

                $session->flash('success_msg', 'Successfully update privacy setting');
                $this->redirect(WWW_BASE_PATH . 'user/privacy_setting');
            }
        }

        $user_setting = $db->select('user_privacy')->where("user_id=?", array($session_data['id']))->execute();
        $this->setVar('user_setting', $user_setting[0]);
        $this->setVar('validator', $validator);
        $this->setVar('form', $form);
        $this->setVar('session', $session);
    }


    public function actionInviteFriend()
    {

    }


    public function actionDraw()
    {
        $this->requireCss('skybrush.css');
        $this->requireJsInHead('skybrush.js');
        $this->requireJsInHead('jquery-more.js');

        $validator = new Validator();
        $form = new Form();
        $session = $this->registry->get('session');
        $request = new Request($session);
        $user_data = $session->get('user');

        if (!$request->isAjax()) {
            $this->setVar('validator', $validator);
            $this->setVar('form', $form);
            $this->setVar('session', $session);
        } else {
            $data = substr($_POST['image'], strpos($_POST['image'], ',') + 1);
            $decodedData = base64_decode($data);
            $image_name = USER_IMAGE_PREFIX . $user_data['username'] . substr(uniqid(), -5) . '.png';
            $fp = fopen(USER_IMAGE_DIR . $user_data['username'] . '/' . $image_name, 'wb');
            fwrite($fp, $decodedData);


            $db = new Database(DB_DSN, DB_USER, DB_PASS);
            $hash_tags = Utility::getHash($_POST['description']);

            //user draw
            $db->query("INSERT INTO draws (user_id, answer, description, image, created) VALUES (?,?,?,?,NOW())", array($user_data['id'], $_POST['answer'], $_POST['description'], $image_name))->execute();

            //draw hash tag
            if ($hash_tags) {
                $values = '';
                foreach ($hash_tags as $tag) {
                    $values .= '(' . $db->getLastInsertId() . ',"' . $tag . '"),';
                }

                $values = rtrim($values, ',');
                $db->query('INSERT INTO draw_tags (draw_id, tag) VALUES ' . $values)->execute();
            }

            $this->disableDefaultView();
        }
    }


    public function actionInbox($page = null)
    {
        $validator = new Validator();
        $db = new Database(DB_DSN, DB_USER, DB_PASS);
        $session = $this->registry->get('session');
        $user_data = $session->get('user');

        $total_msg = $messages = $db->query("SELECT m.id AS msg_id, m.message, m.created,  mr.last_read, ms.user_id AS sender_id, u.username AS sender_username
                            FROM messages AS m INNER JOIN message_receivers AS mr ON m.id = mr.message_id INNER JOIN message_senders AS ms ON m.id = ms.message_id
                            INNER JOIN users AS u ON ms.user_id = u.id WHERE mr.user_id=?", array($user_data['id']))->totalrow()->execute();

        $paginator = new Paginator($this, $total_msg, 6);

        $messages = $db->query("SELECT m.id AS msg_id, m.message, m.created,  mr.last_read, ms.user_id AS sender_id, u.username AS sender_username
                            FROM messages AS m INNER JOIN message_receivers AS mr ON m.id = mr.message_id INNER JOIN message_senders AS ms ON m.id = ms.message_id
                            INNER JOIN users AS u ON ms.user_id = u.id WHERE mr.user_id=?", array($user_data['id']))->limit($paginator->getPageStart(), $paginator->getPageLimit())->execute();

        $this->setVar('messages', $messages);
        $this->setVar('session', $session);
        $this->setVar('validator', $validator);
        $this->setVar('paginator', $paginator);
    }


    public function actionOutbox($page)
    {
        $validator = new Validator();
        $db = new Database(DB_DSN, DB_USER, DB_PASS);
        $session = $this->registry->get('session');
        $user_data = $session->get('user');
        $total_msg = $messages = $db->query("SELECT m.id AS msg_id, m.message, m.created, mr.user_id AS receiver_id, u.username AS receiver_username FROM messages AS m INNER JOIN message_senders AS ms ON m.id = ms.message_id INNER JOIN message_receivers AS mr ON m.id = mr.message_id INNER JOIN users AS u ON mr.user_id = u.id WHERE ms.user_id=?", array($user_data['id']))->totalrow()->execute();

        $paginator = new Paginator($this, $total_msg, 6);

        $messages = $db->query("SELECT m.id AS msg_id, m.message, m.created, mr.user_id AS receiver_id, u.username AS receiver_username FROM messages AS m INNER JOIN message_senders AS ms ON m.id = ms.message_id INNER JOIN message_receivers AS mr ON m.id = mr.message_id INNER JOIN users AS u ON mr.user_id = u.id WHERE ms.user_id=?", array($user_data['id']))->limit($paginator->getPageStart(), $paginator->getPageLimit())->execute();

        $this->setVar('messages', $messages);
        $this->setVar('session', $session);
        $this->setVar('validator', $validator);
        $this->setVar('paginator', $paginator);
    }


    public function actionListDraw()
    {
        $this->disableDefaultLayout();
    }


    public function actionListSnapshot()
    {
        $this->disableDefaultLayout();
    }


    public function actionLogout()
    {
        $session = $this->registry->get('session');
        $cookie = $this->registry->get('cookie');
        $auth = new Authentication($session, $cookie);

        if ($auth->logout()) {
            $this->redirect(WWW_BASE_PATH);
        }
        $this->disableDefaultView();
    }


}

?>


