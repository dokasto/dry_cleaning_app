<?php
/**
 * Handles all user routes
 */
$app->group('/client', function () use ($app) {


    /**
     * Type: Page
     * dashboard
     */
    $app->get('/' , 'requiresLogin', function () use ($app){
        $view = new CustomView();
        $view->setTitle('Dashboard');
        $view->setHeader(CLIENT_HEADER);
        $view->setFooter(CLIENT_FOOTER);
        $view->setBody(CLIENT_VIEWS . '/index.php');
        $client_id = $_SESSION['secure_user']['client_id'] ;
        $bookingModel = new bookingModel();
        $data = $bookingModel->fetchBookings($client_id);
        $view->setVar('data',$data['result']);
        $view->render();
    });

    /**
     * Type: page
     * Login
     */
    $app->get('/login' , function () use ($app){
        $view = new CustomView();
        $view->setTitle('Client Login');
        $view->setHeader(CLIENT_HEADER);
        $view->setFooter(CLIENT_FOOTER);
        $view->setBody(CLIENT_VIEWS . '/login.php');
        $view->render();
    });

    /**
     * Type: page
     * feedback
     */
    $app->get('/feedback', 'requiresLogin' , function () use ($app){
        $view = new CustomView();
        $view->setTitle('Feedback');
        $view->setHeader(CLIENT_HEADER);
        $view->setFooter(CLIENT_FOOTER);
        $view->setBody(CLIENT_VIEWS . '/feedback.php');
        $clientID = $_SESSION['secure_user']['client_id'];
        $view->setVar('client_id',$clientID);
        $view->render();
    });

    /**
     * Type: page
     * settings
     */
    $app->get('/settings', 'requiresLogin' , function () use ($app){
        $view = new CustomView();
        $view->setTitle('Settings');
        $view->setHeader(CLIENT_HEADER);
        $view->setFooter(CLIENT_FOOTER);
        $clientID = $_SESSION['secure_user']['client_id'];
        $view->setVar('client_id',$clientID);
        $view->setBody(CLIENT_VIEWS . '/settings.php');
        $view->render();
    });

    /**
     * Type: page
     * Profile Page
     */
    $app->get('/profile', 'requiresLogin' , function () use ($app){
        $view = new CustomView();
        $view->setTitle('User Profile');
        $view->setHeader(CLIENT_HEADER);
        $view->setFooter(CLIENT_FOOTER);
        $view->setBody(CLIENT_VIEWS . '/profile.php');
        $client = new clientModel();
        $clientID = $_SESSION['secure_user']['client_id'];
        $data = $client->getClient($clientID);
        $view->setVar("client",$data['result']);
        $view->render();
    });


    /**
     * Type: page
     * Password recovery
     */
    $app->get('/recovery' , function () use ($app){
        $view = new CustomView();
        $view->setTitle('Password Recovery');
        $view->setHeader(CLIENT_HEADER);
        $view->setFooter(CLIENT_FOOTER);
        $view->setBody(CLIENT_VIEWS . '/recover.php');
        $view->render();
    });


    /**
     * Type: page
     * Signup
     */
    $app->get('/register' , function () use ($app){
        $view = new CustomView();
        $view->setTitle('Create Account');
        $view->setHeader(CLIENT_HEADER);
        $view->setFooter(CLIENT_FOOTER);
        $view->setBody(CLIENT_VIEWS . '/signup.php');
        $view->render();
    });


    /**
     * Type: page
     * bookings
     */
    $app->get('/booking/:order_id', 'requiresLogin' , function ($order_id) use ($app){
        $view = new CustomView();
        $view->setTitle('Booking Receipt');
        $view->setHeader(CLIENT_HEADER);
        $view->setFooter(CLIENT_FOOTER);
        $bookingModel = new bookingModel();
        $data = $bookingModel->getBookingInfo($order_id) ;
        if($data['status'] == true ){
            $view->setVar('data',$data['result']);
            $view->setBody(CLIENT_VIEWS . '/user_receipt.php');
        }else{
            $view->setBody(ADMIN_VIEWS . '/ordernotfound.html');
        }
        $view->render();
    });


    /**
     * Login required
     */
    $app->get('/forbidden' , function () use ($app){
        $view = new CustomView();
        $view->setBody(CLIENT_VIEWS . '/login_required.php');
        $ref = URL . '/client/login' ;
        if(isset($_SERVER['HTTP_REFERER'])){
            $ref = $_SERVER['HTTP_REFERER'] ;
        }
        $view->setVar('referal', $ref);
        $view->render();
    });


    /**
     * Type: page
     * bookings
     */
    $app->get('/logout' , function () use ($app){
        $client = new clientModel();
        $client->logout();
        $app->redirect( URL . '/client/login');
    });




});