<?php
/**
 * Culmen
 * Class: public.php
 * Author: @thisisudo
 * Date: 12/20/14
 * Time: 4:07 PM
 */


/**
 * Home Page
 */
$app->get('/', function () use ($app){
    $view = new CustomView();
    $view->setTitle('Welcome To '.SITENAME);
    $view->setHeader(PUBLIC_HEADER);
    $view->setFooter(PUBLIC_FOOTER);
    $view->setBody(PUBLIC_VIEWS . '/home.php');
    $specialsModel = new specialOffersModel();
    $data = $specialsModel->fetch();
    $view->setVar('specials',$data);
    $view->render();
});

/**
 * About Page
 */
$app->get('/about', function () use ($app){
    $view = new CustomView();
    $view->setTitle('About Us');
    $view->setHeader(PUBLIC_HEADER);
    $view->setFooter(PUBLIC_FOOTER);
    $view->setBody(PUBLIC_VIEWS . '/about.php');
    $view->render();
});


/**
 * Service Page
 */
$app->get('/services', function () use ($app){
    $view = new CustomView();
    $view->setTitle('Services');
    $view->setHeader(PUBLIC_HEADER);
    $view->setFooter(PUBLIC_FOOTER);
    $view->setBody(PUBLIC_VIEWS . '/services.php');
    $specialsModel = new specialOffersModel();
    $data = $specialsModel->fetch();
    $view->setVar('specials',$data);
    $view->render();
});


/**
 * Contact Page
 */
$app->get('/contact', function () use ($app){
    $view = new CustomView();
    $view->setTitle('Contact Us');
    $view->setHeader(PUBLIC_HEADER);
    $view->setFooter(PUBLIC_FOOTER);
    $view->setBody(PUBLIC_VIEWS . '/contact.php');
    $view->render();
});

/**
 * send contact email
 */
$app->post('/contact/enquiry', function () use ($app){
    verifyRequiredParams('name,email,message');
    $name = $app->request->post('name');
    $email = $app->request->post('email');
    $message = $app->request->post('message');
    $clientModel = new clientModel();
    push(200,$clientModel->contactEmail($name,$email,$message));
});




/**
 * Type: page
 * bookings
 */
$app->get('/bookings/:order_id' , function ($order_id) use ($app){
    $view = new CustomView();
    $view->setTitle('Booking Receipt');
    $view->setHeader(CLIENT_HEADER);
    $view->setFooter(CLIENT_FOOTER);
    $bookingModel = new bookingModel();
    $data = $bookingModel->getBookingInfo($order_id) ;
    if($data['status'] == true ){
        $view->setVar('data',$data['result']);
        $view->setBody(PUBLIC_VIEWS . '/user_receipt.php');
    }else{
        $view->setBody(ADMIN_VIEWS . '/ordernotfound.html');
    }
    $view->render();
});


