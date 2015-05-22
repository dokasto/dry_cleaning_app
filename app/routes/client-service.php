<?php
/**
 * Culmen
 * Route: client-service.php
 * Author: @thisisudo
 * Date: 11/20/14
 * Time: 3:59 PM
 */

$app->group('/service/client', function () use ($app) {

    /**
     * Login
     */
    $app->post('/login', 'originAuth' , function () use ($app){
        verifyRequiredParams('email,password');
        $email = $app->request->post('email');
        $password = $app->request->post('password');
        $client = new clientModel();
        push(202,$client->authenticate($email,$password));
    });

    /**
     * Signpup
     */
    $app->post('/register', 'originAuth' , function () use ($app){
        verifyRequiredParams('name,email,phone,address,password');
        $name = $app->request->post('name');
        $email = $app->request->post('email');
        $password = $app->request->post('password');
        $phone = $app->request->post('phone');
        $address = $app->request->post('address');
        $client = new clientModel();
        push( 200,$client->newClient($name,$email,$phone,$address,$password) );
    });


    /**
     * Change password
     */
    $app->post('/update/password', 'originAuth' , function () use ($app){
        verifyRequiredParams('client_id,oldPassword,newPassword');
        $client_id = $app->request->post('client_id');
        $oldPassword = $app->request->post('oldPassword');
        $newPassword = $app->request->post('newPassword');
        $model = new clientModel();
        push(202, $model->updatePassword($oldPassword,$newPassword,$client_id) );
    });

    /**
     * Update profile
     */
    $app->post('/update/profile', 'originAuth' , function () use ($app){
        verifyRequiredParams('client_id,name,email,phone,address');
        $client_id = $app->request->post('client_id');
        $name = $app->request->post('name');
        $email = $app->request->post('email');
        $phone = $app->request->post('phone');
        $address = $app->request->post('address');
        $model = new clientModel();
        push( 202,$model->updateProfile($client_id,$name,$email,$phone,$address) );
    });


    /**
     * Upload image
     */
    $app->post('/update/image/', 'originAuth' , function () use ($app){
        $result = array("status"=>false,"result"=>"No profiles were sent");
        if(isset($_FILES['picture'])){
            $model = new clientModel();
            $client_id = $app->request->post('client_id');
            $result = $model->updatePicture($client_id,$_FILES['picture']);
        }
        push(200,$result);
    });


    /**
     * Send client feedback to admin
     */
    $app->post('/feedback', 'originAuth' , function () use ($app){
        verifyRequiredParams('client_id,subject,message');
        $client_id = $app->request->post('client_id');
        $subject = $app->request->post('subject');
        $message = $app->request->post('message');
        $model = new clientModel();
        push( 202,$model->sendFeedback($client_id,$subject,$message) );
    });

});