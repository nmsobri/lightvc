<?php

class ProfileController extends AppController
{

    protected $layout = 'profile';



    public function beforeAction()
    {
        $this->requireCss( 'profile.css' );
        $this->requireCss( 'jquery-colorbox.css' ); //used in popup
        $this->requireCss( 'jquery-ui.css' ); //used in popup

        $this->requireJsInHead( 'jquery-ui.js' ); //used in popup
        $this->requireJsInHead( 'jquery-limit.js' ); //used in popup
        $this->requireJsInHead( 'jquery-form.js' );
        $this->requireJsInHead( 'jquery-colorbox.js' );

        $controller_params = $this->getControllerParams();
        $profile_id = $controller_params[ 'uri' ];
        $db = new Database( DB_DSN, DB_USER, DB_PASS );
        $profile = $db->query( " SELECT u.id AS user_id, u.username, p.full_name, p.email, p.biography, p.image, s.publisher_id, s.subscriber_id, s.approved FROM `users` AS u INNER JOIN `profiles` AS p on u.id = p.user_id LEFT JOIN subscriptions AS s ON s.publisher_id = u.id AND s.subscriber_id =? WHERE u.username =? ", array( $_SESSION[ 'user' ][ 'id' ], $profile_id ) )->execute();
        $this->setLayoutVar( 'profile', $profile );
        $this->setLayoutVar( 'pageTitle', $profile[ 0 ][ 'username' ] );
    }



    public function actionIndex( $profiles = null )
    {

        $validator = new Validator();
        $form = new Form();
        $session = $this->registry->get( 'session' );


        $this->setVar( 'session', $session );
        $this->setVar( 'form', $form );
        $this->setVar( 'validator', $validator );
    }



    public function actionSendMessage()
    {
        $session = $this->registry->get( 'session' );
        $user_data = $session->get( 'user' );
        $db = new Database( DB_DSN, DB_USER, DB_PASS );
        $db->query( "INSERT INTO messages (message, created) VALUES(?, NOW())", array( $_POST[ 'pm_user' ] ) )->execute();
        $message_id = $db->getLastInsertId();
        $db->query( "INSERT INTO message_senders (user_id, message_id) VALUES(?, ?)", array( $user_data[ 'id' ], $message_id ) )->execute();
        $db->query( "INSERT INTO message_receivers (user_id, message_id) VALUES(?, ?)", array( $_POST[ 'user_id' ], $message_id ) )->execute();
        echo json_encode( array( 'status' => 'success' ) );
        $this->disableDefaultView();
    }



    public function actionFollow()
    {
        $db = new Database( DB_DSN, DB_USER, DB_PASS );
        $res = $db->query( "SELECT private_account FROM user_privacy WHERE user_id=?", array( $_POST[ 'pid' ] ) )->execute();
        $status = $res[ 0 ][ 'private_account' ] == 'on' ? 'no' : 'yes';
        $db->query( "INSERT INTO subscriptions (publisher_id, subscriber_id, approved, created) VALUES( ?, ?, ?, NOW() )", array( $_POST[ 'pid' ], $_POST[ 'sid' ], $status ) )->execute();
        echo json_encode( array( 'status' => $status == 'no' ? 'pending_follow' : 'success_follow' ) );
        $this->disableDefaultView();
    }



    public function actionUnfollow()
    {
        $db = new Database( DB_DSN, DB_USER, DB_PASS );
        $db->query( "DELETE FROM subscriptions WHERE publisher_id = ? AND subscriber_id=? ", array( $_POST[ 'pid' ], $_POST[ 'sid' ] ) )->execute();
        echo json_encode( array( 'status' => 'success_unfollow' ) );
        $this->disableDefaultView();
    }



}




?>