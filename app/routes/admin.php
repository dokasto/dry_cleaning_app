<?php
/**
 * Handles all Admin routes
 */
$app->group('/admin', function () use ($app) {

    /**
     * Type: Page
     * dashboard
     */
    $app->get('/' , 'requiresAdminLogin', function () use ($app){
        $app = \Slim\Slim::getInstance();
        $app->redirect( URL . '/admin/bookings');
    });


    $app->get('/login' , function () use ($app){
        $view = new CustomView();
        $view->setTitle('Login');
        $view->setHeader(ADMIN_HEADER);
        $view->setFooter(ADMIN_FOOTER);
        $view->setBody(ADMIN_VIEWS . '/admin_signin.php');
        $view->render();
    });


    $app->get('/bookings' ,'requiresAdminLogin', function () use ($app){
        $view = new CustomView();
        $view->setTitle('Bookings');
        $view->setHeader(ADMIN_HEADER);
        $view->setFooter(ADMIN_FOOTER);
        $view->setBody(ADMIN_VIEWS . '/bookings.php');
        $bookingModel = new bookingModel();
        $data = $bookingModel->fetchBookings();
        $view->setVar('data',$data['result']);
        $view->render();
    });


    $app->get('/clients' ,'requiresAdminLogin', function () use ($app){
        $view = new CustomView();
        $view->setTitle('Clients');
        $view->setHeader(ADMIN_HEADER);
        $view->setFooter(ADMIN_FOOTER);
        $view->setBody(ADMIN_VIEWS . '/clients.php');
        $clientModel = new clientModel();
        $clientsData = $clientModel->getClients();
        $view->setVar('clients',$clientsData->result);
        $view->render();
    });


    $app->get('/clients/:client_id' ,'requiresAdminLogin', function ($client_id) use ($app){
        $view = new CustomView();
        $view->setHeader(ADMIN_HEADER);
        $view->setFooter(ADMIN_FOOTER);
        $view->setBody(ADMIN_VIEWS . '/clientprofile.php');
        $clientModel = new clientModel();
        $client = $clientModel->getClient($client_id);
        $view->setVar('client',new ArrToObj($client['result']));
        $view->setTitle($client['result']->name);
        $bookingModel = new bookingModel();
        $bookings = $bookingModel->fetchBookings($client_id);
        if(isset($bookings['result'])){
            $view->setVar('bookings',$bookings['result']);
        }
        $view->render();
    });

    $app->get('/sms' , 'requiresAdminLogin',function () use ($app){
        $view = new CustomView();
        $view->setTitle('SMS');
        $view->setHeader(ADMIN_HEADER);
        $view->setFooter(ADMIN_FOOTER);
        $view->setBody(ADMIN_VIEWS . '/sms.php');
        $view->render();
    });


    $app->get('/special' ,'requiresAdminLogin', function () use ($app){
        $view = new CustomView();
        $view->setTitle('Special Offers');
        $view->setHeader(ADMIN_HEADER);
        $view->setFooter(ADMIN_FOOTER);
        $view->setBody(ADMIN_VIEWS . '/specialOffers.php');
        $specialOffersModel = new specialOffersModel();
        $view->setVar('offers',$specialOffersModel->fetch());
        $view->render();
    });


    $app->get('/settings' ,'requiresAdminLogin', function () use ($app){
        $view = new CustomView();
        $view->setTitle('Settings');
        $view->setHeader(ADMIN_HEADER);
        $view->setFooter(ADMIN_FOOTER);
        $view->setBody(ADMIN_VIEWS . '/settings.php');
        $uid = $_SESSION['secure_admin_user']['uid'];
        $view->setVar('uid',$uid);
        $view->render();
    });


    $app->get('/bookings/:order_id' ,'requiresAdminLogin', function ($order_id) use ($app){
        $view = new CustomView();
        $view->setHeader(ADMIN_HEADER);
        $view->setFooter(ADMIN_FOOTER);
        $view->setTitle('Process Booking');
        $bookingModel = new bookingModel();
        $data = $bookingModel->getBookingInfo($order_id) ;
        if($data['status'] == true ){
            $view->setVar('data',$data['result']);
            $view->setBody(ADMIN_VIEWS . '/reciept.php');
        }else{
            $view->setBody(ADMIN_VIEWS . '/ordernotfound.html');
        }
        $view->render();
    });


    /**
     * Place a new booking
     * for a client
     */
    $app->get('/bookings/:client_id/new' ,'requiresAdminLogin', function ($client_id) use ($app){
        $view = new CustomView();
        $view->setHeader(ADMIN_HEADER);
        $view->setFooter(ADMIN_FOOTER);
        $view->setBody(ADMIN_VIEWS . '/book_new.php');
        $clientModel = new clientModel();
        $client = $clientModel->getClient($client_id);
        $bookingModel = new bookingModel();
        $view->setVar('priceList',$bookingModel->getPriceList());
        $view->setVar('client',new ArrToObj($client['result']));
        $view->setTitle('New Booking: '.$client['result']->name);
        $view->render();
    });

    $app->get('/bookings/:order_id' ,'requiresAdminLogin', function ($order_id) use ($app){
        $view = new CustomView();
        $view->setTitle('Settings');
        $view->setHeader(ADMIN_HEADER);
        $view->setFooter(ADMIN_FOOTER);
        $view->setBody(ADMIN_VIEWS . '/editreceipt.php');
        $view->render();
    });


    /**
     * Logout
     */
    $app->get('/logout' , function () use ($app){
        $admin = new adminModel();
        $admin->logout();
        $app->redirect( URL . '/admin/login');
    });



});