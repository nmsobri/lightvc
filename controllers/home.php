<?php

class HomeController extends AppController
{

    protected $layout = 'submain';



    protected function beforeAction()
    {

    }



    public function actionIndex()
    {
        $this->layout = 'main';
        $this->requireCss( 'main.css' );
        $this->setLayoutVar( 'pageTitle', 'Spomi' );

        $session = $this->registry->get( 'session' );
        $validator = new Validator();
        $form = new Form();

        $day_of_birth = array_merge( array( 'Day' ), range( 1, 31 ) );
        $month_of_birth = array( 0              => 'Month', 1              => 'January', 2              => 'February', 3              => 'March', 4              => 'April', 5              => 'May', 6              => 'June', 7              => 'July', 8              => 'August', 9              => 'September', 10             => 'October', 11             => 'November', 12             => 'December' );
        $year_of_birth = array_merge( array( 'Year' ), range( 1950, date( 'Y' ) - 13 ) );

        $this->setVar( 'day_of_birth', $day_of_birth );
        $this->setVar( 'month_of_birth', $month_of_birth );
        $this->setVar( 'year_of_birth', $year_of_birth );
        $this->setVar( 'form', $form );
        $this->setVar( 'validator', $validator );
        $this->setVar( 'session', $session );
    }



    public function actionLogin()
    {
        $this->setLayoutVar( 'pageTitle', 'Spomi::Login' );
        $this->requireCss( 'submain.css' );

        $locked = false;
        $db = new Database( DB_DSN, DB_USER, DB_PASS );
        $session = $this->registry->get( 'session' );
        $cookie = $this->registry->get( 'cookie' );
        $request = new Request( $session );
        $validator = new Validator();
        $form = new Form();


        $login_attempt_data = $db->query( "SELECT ip_address, login_count, UNIX_TIMESTAMP(last_attempt_time) AS last_attempt_time FROM login_attempts WHERE ip_address=?", array( $_SERVER[ 'REMOTE_ADDR' ] ) )->execute();
        $attempt_count = ( int ) $login_attempt_data[ 0 ][ 'login_count' ];
        $last_attempt_time = ( int ) $login_attempt_data[ 0 ][ 'last_attempt_time' ];

        if ( $attempt_count <= 5 or ($attempt_count > 5 and ( time() - $last_attempt_time > (15 * 60) ) ) )
        {
            if ( $request->postToGet() )
            {
                $validator->addValidator( 'username', new TextValidator( 'username', $_POST[ 'username' ], array( 'allow_num' => true ) ) );
                $validator->addValidator( 'password', new TextValidator( 'password', $_POST[ 'password' ], array( 'allow_num' => true ) ) );

                if ( $validator->isValid() )
                {
                    include BASE_PATH . 'classes/class.Utility.php';
                    $auth = new Authentication( $session, $cookie );

                    $params = new stdClass();
                    $params->query = "SELECT u.id, u.username, u.password, aa.activation_key FROM users AS u LEFT JOIN account_activations AS aa ON u.id =aa.user_id WHERE u.username=? AND u.password=?";
                    $params->bind = array( $_POST[ 'username' ], Utility::hashedPassword( SALT, $_POST[ 'password' ] ) );
                    $params->remember = $_POST[ 'remember' ] ? true : false;

                    if ( $auth->login( $db, $params ) )
                    {
                        $login_data = $auth->getLoginData();
                        $login_data = $login_data[ 0 ];
                        $db->delete( 'login_attempts' )->where( "ip_address=?", array( $_SERVER[ 'REMOTE_ADDR' ] ) )->execute(); //clear any login attempt

                        if ( !is_null( $login_data[ 'activation_key' ] ) )
                        {
                            $validator->invalidateValidation( 'You need to activate your account before login <a href=' . APP_PATH . 'activation' . '>Activate account</a>' );
                        }
                        else
                        {
                            /* Save user data to session */
                            $session->set( 'user', array( 'id'       => $login_data[ 'id' ], 'username' => $login_data[ 'username' ] ) );
                            $this->redirect( APP_PATH . 'user' ); //redirect to user page
                        }
                    }
                    else
                    {
                        if ( $attempt_count > 5 ) //reset count attempt if user passed 15 minute
                            $db->delete( 'login_attempts' )->where( "ip_address=?", array( $_SERVER[ 'REMOTE_ADDR' ] ) )->execute();

                        $db->query( "INSERT INTO login_attempts VALUES ( ?, ?, NOW() ) ON DUPLICATE KEY UPDATE login_count = login_count + 1, last_attempt_time = NOW()", array( $_SERVER[ 'REMOTE_ADDR' ], 1 ) )->execute();
                        $validator->invalidateValidation( 'No user found with such credential' );
                        $session->clearFlash( 'password' ); //clear flash data , need this or otherwise it keep increasing attempt count on refresh
                    }
                }
            }
        }
        else
        {
            /* Block ip */
            $locked = true;
        }

        $this->setVar( 'locked', $locked );
        $this->setVar( 'form', $form );
        $this->setVar( 'session', $session );
        $this->setVar( 'validator', $validator );
    }



    public function actionRegister()
    {
        $this->setLayoutVar( 'pageTitle', 'Spomi::Register' );
        $this->requireCss( 'submain.css' );

        $form = new Form();
        $session = $this->registry->get( 'session' );
        $request = new Request( $session );
        $validator = new Validator();
        $day_of_birth = array_merge( array( 'Please Select' ), range( 1, 31 ) );
        $month_of_birth = array( 0              => 'Please Select', 1              => 'January', 2              => 'February', 3              => 'March', 4              => 'April', 5              => 'May', 6              => 'June', 7              => 'July', 8              => 'August', 9              => 'September', 10             => 'October', 11             => 'November', 12             => 'December' );
        $year_of_birth = array_merge( array( 'Please Select' ), range( 1950, date( 'Y' ) - 13 ) );

        if ( $request->postToGet() )
        {
            $validator->addValidator( 'username', new RegexValidator( 'username', $_POST[ 'username' ], '#[a-zA-Z0-9_]+#', array( ) ) );
            $validator->addValidator( 'password', new TextValidator( 'password', $_POST[ 'password' ], array( 'allow_num'  => true, 'min_length' => 6, 'max_length' => 24 ) ) );
            $validator->addValidator( 'repeat_password', new CompareValidator( 'repeat_password', $_POST[ 'repeat_password' ], $_POST[ 'password' ], 'password', array( 'field' => 'repeat password' ) ) );
            $validator->addValidator( 'email', new EmailValidator( 'email', $_POST[ 'email' ], array( ) ) );
            $validator->addValidator( 'repeat_email', new CompareValidator( 'repeat_email', $_POST[ 'repeat_email' ], $_POST[ 'email' ], 'email', array( 'field' => 'repeat email' ) ) );
            $validator->addValidator( 'full_name', new TextValidator( 'full_name', $_POST[ 'full_name' ], array( 'field'       => 'full name', 'allow_space' => true ) ) );
            $validator->addValidator( 'day_of_birth', new SelectValidator( 'day_of_birth', $_POST[ 'day_of_birth' ], array( 'field' => 'day of birth' ) ) );
            $validator->addValidator( 'month_of_birth', new SelectValidator( 'month_of_birth', $_POST[ 'month_of_birth' ], array( 'field' => 'month of birth' ) ) );
            $validator->addValidator( 'year_of_birth', new SelectValidator( 'year_of_birth', $_POST[ 'year_of_birth' ], array( 'field' => 'year of birth' ) ) );


            if ( $validator->isValid() )
            {
                $dob = new DateTime( $year_of_birth[ $_POST[ 'year_of_birth' ] ] . '-' . $_POST[ 'month_of_birth' ] . '-' . $_POST[ 'day_of_birth' ] );

                $db = new Database( DB_DSN, DB_USER, DB_PASS );
                $result = $db->query( "SELECT u.username, p.email FROM users AS u LEFT JOIN profiles AS p ON u.id = p.user_id WHERE u.username=? OR p.email=?", array( $_POST[ 'username' ], $_POST[ 'email' ] ) )->totalrow()->execute();

                if ( $result > 0 ) /* user existed */
                {
                    $validator->invalidateValidation( 'User with such username and email already exist' );
                }
                else
                {
                    include BASE_PATH . 'classes/class.Utility.php';
                    $activation_key = Utility::getActivationKey( $_POST[ 'email' ] );

                    $password = Utility::hashedPassword( SALT, $_POST[ 'password' ] );
                    $db->insert( 'users', array( 'username' => '?', 'password' => '?', 'created'  => 'NOW()' ), array( $_POST[ 'username' ], $password ) )->execute();
                    $insert_id = $db->getLastInsertId();
                    $db->insert( 'profiles', array( 'user_id'       => '?', 'full_name'     => '?', 'email'         => '?', 'date_of_birth' => '?', 'image'         => '?' ), array( $insert_id, $_POST[ 'full_name' ], $_POST[ 'email' ], $dob->format( 'Y-m-d H:i:s' ), USER_DEFAULT_IMAGE ) )->execute();
                    $db->insert( 'account_activations', array( 'user_id'        => '?', 'activation_key' => '?' ), array( $insert_id, $activation_key ) )->execute();
                    $db->insert( 'user_privacy', array( 'user_id' => '?' ), array( $insert_id ) )->execute();

                    $mail = new Mail();
                    $mail->isMail();
                    $mail->from( 'admin@spomi.com', 'admin' );
                    $mail->to( $_POST[ 'email' ] );
                    $mail->subject( 'Account Activation' );
                    $message = "Hi there, \n\n You recenlty registered a new account with us. \n\n Please activate your account.\n\n Here is your activation key: {$activation_key}";
                    $mail->body( $message );
                    $mail->priority( 1 );
                    $mail->send();

                    $session->flash( 'success_msg', 'Successfully registered new account.Please check your email on how to activate your account' );
                    $session->redirect( APP_PATH . 'register' );
                }
            }
        }

        $this->setVar( 'day_of_birth', $day_of_birth );
        $this->setVar( 'month_of_birth', $month_of_birth );
        $this->setVar( 'year_of_birth', $year_of_birth );
        $this->setVar( 'form', $form );
        $this->setVar( 'validator', $validator );
        $this->setVar( 'session', $session );
    }



    public function actionActivation()
    {
        $this->setLayoutVar( 'pageTitle', 'Spomi::Activate Account' );
        $this->requireCss( 'submain.css' );

        $form = new Form();
        $validator = new Validator();
        $session = $this->registry->get( 'session' );
        $request = new Request( $session );

        if ( $request->postToGet() )
        {
            $validator->addValidator( 'email', new EmailValidator( 'email', $_POST[ 'email' ], array( ) ) );
            $validator->addValidator( 'activation_code', new TextValidator( 'activation_code', $_POST[ 'activation_code' ], array( 'field'     => 'activation code', 'allow_num' => true ) ) );

            if ( $validator->isValid() )
            {
                $db = new Database( DB_DSN, DB_USER, DB_PASS );
                $user_info = $db->query( "SELECT u.username,u.id AS user_id, p.email, aa.activation_key FROM users AS u INNER JOIN profiles AS p On u.id = p.user_id INNER JOIN account_activations AS aa ON p.user_id = aa.user_id where p.email =?", array( $_POST[ 'email' ] ) )->execute();

                if ( count( $user_info ) > 0 )
                {
                    if ( !is_null( $user_info[ 0 ][ 'activation_key' ] ) )
                    {
                        if ( $user_info[ 0 ][ 'activation_key' ] != $_POST[ 'activation_code' ] )
                        {
                            $validator->invalidateValidation( 'Invalid activation code' );
                        }
                        else
                        {
                            $db->query( "UPDATE account_activations SET activation_key = NULL where user_id =?", array( $user_info[ 0 ][ 'user_id' ] ) )->execute();
                            $session->flash( 'success_msg', 'Successfully activate your account' );
                            $this->redirect( APP_PATH . 'activation' );
                        }
                    }
                    else
                    {
                        $validator->invalidateValidation( 'Your account already activated' );
                    }
                }
                else
                {
                    $validator->invalidateValidation( 'No such email' );
                }
            }
        }

        $this->setVar( 'form', $form );
        $this->setVar( 'validator', $validator );
        $this->setVar( 'session', $session );
    }



    public function actionSendActivation()
    {
        $this->setLayoutVar( 'pageTitle', 'Spomi::Send Activation' );
        $this->requireCss( 'submain.css' );

        $form = new Form();
        $validator = new Validator();
        $session = $this->registry->get( 'session' );
        $request = new Request( $session );

        if ( $request->postToGet() )
        {
            $validator->addValidator( 'email', new EmailValidator( 'email', $_POST[ 'email' ], array( ) ) );

            if ( $validator->isValid() )
            {
                $db = new Database( DB_DSN, DB_USER, DB_PASS );
                $user_info = $db->query( "SELECT u.username,u.id AS user_id, p.email, aa.activation_key FROM users AS u INNER JOIN profiles AS p On u.id = p.user_id INNER JOIN account_activations AS aa ON p.user_id = aa.user_id where p.email =?", array( $_POST[ 'email' ] ) )->execute();

                if ( count( $user_info ) > 0 )
                {
                    if ( !is_null( $user_info[ 0 ][ 'activation_key' ] ) )
                    {
                        $act_key = $user_info[ 0 ][ 'activation_key' ];

                        $mail = new Mail();
                        $mail->isMail();
                        $mail->from( 'admin@spomi.com', 'admin' );
                        $mail->to( $_POST[ 'email' ] );
                        $mail->subject( 'Account Activation' );
                        $message = "Hi there, \n\n You have requested your activation key. \n\n Here is your activation key: {$act_key}";
                        $mail->body( $message );
                        $mail->priority( 1 );
                        $mail->send();

                        $session->flash( 'success_msg', 'Successfully send activation key' );
                        $this->redirect( APP_PATH . 'send_activation' );
                    }
                    else
                    {
                        $validator->invalidateValidation( 'Your account already activated' );
                    }
                }
                else
                {
                    $validator->invalidateValidation( 'No such email' );
                }
            }
        }

        $this->setVar( 'form', $form );
        $this->setVar( 'validator', $validator );
        $this->setVar( 'session', $session );
    }



    public function actionForgotPassword()
    {
        $this->setLayoutVar( 'pageTitle', 'Spomi::Forgot Password' );
        $this->requireCss( 'submain.css' );

        $form = new Form();
        $validator = new Validator();
        $session = $this->registry->get( 'session' );
        $request = new Request( $session );

        if ( $request->postToGet() )
        {
            $validator->addValidator( 'email', new EmailValidator( 'email', $_POST[ 'email' ], array( ) ) );

            if ( $validator->isValid() )
            {
                $db = new Database( DB_DSN, DB_USER, DB_PASS );
                $user_info = $db->query( "SELECT u.id AS user_id, u.username, p.email FROM users AS u INNER JOIN profiles AS p ON u.id = p.user_id WHERE p.email =? ", array( $_POST[ 'email' ] ) )->execute();

                if ( count( $user_info ) > 0 )
                {
                    $password = Utility::generatePassword();

                    $mail = new Mail();
                    $mail->isMail();
                    $mail->from( 'admin@spomi.com', 'admin' );
                    $mail->to( $user_info[ 0 ][ 'email' ] );
                    $mail->subject( 'Reset Password' );
                    $message = "Hi There, \n\n We have reset your password as requested \n\n Here is your new password: {$password}";
                    $mail->body( $message );
                    $mail->priority( 1 );
                    $mail->send();

                    $db->query( "UPDATE users SET password =? where id =?", array( Utility::hashedPassword( SALT, $password ), $user_info[ 0 ][ 'user_id' ] ) )->execute(); //update password in db
                    $session->flash( 'success_msg', 'Successfully resetting your password, kindly check your email for your new password' );
                    $this->redirect( APP_PATH . 'forgot_password' );
                }
                else
                {
                    $validator->invalidateValidation( 'No such email' );
                }
            }
        }

        $this->setVar( 'form', $form );
        $this->setVar( 'validator', $validator );
        $this->setVar( 'session', $session );
    }



}
?>


