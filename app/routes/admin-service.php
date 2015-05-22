<?php
/**
 * Culmen
 * Class: admin-service.php
 * Author: @thisisudo
 * Date: 12/8/14
 * Time: 12:25 PM
 */


$app->group('/service/admin', function () use ($app) {

    /**
     * Send bulk sms
     */
    $app->post('/sms', 'originAuth' , 'requiresAdminLogin', function () use ($app){
        verifyRequiredParams('message');
        $message = $app->request->post('message');
        $smsModel = new smsModel();
        push(202,$smsModel->sendBulkSMS($message));
    });

    $app->group('/special_offer', function () use ($app) {

        /**
         * Add a new special offer
         */
        $app->post('/new', 'originAuth' , 'requiresAdminLogin', function () use ($app){
            verifyRequiredParams('offer');
            $offer = $app->request->post('offer');
            $specialOffersModel = new specialOffersModel();
            push(202,$specialOffersModel->create($offer));
        });

        /**
         * Remove A special offer
         */
        $app->delete('/delete/:offer_id', 'originAuth' , 'requiresAdminLogin', function ($offer_id) use ($app){
            $specialOffersModel = new specialOffersModel();
            push(202,$specialOffersModel->remove($offer_id));
        });

    });

    /**
     * Place a new booking
     */
    $app->post('/booking/new', 'originAuth' , 'requiresAdminLogin', function () use ($app){
        verifyRequiredParams('client_id,items,pickup_date');
        $client_id = $app->request->post('client_id');
        $items = $app->request->post('items');
        $pickup_date = $app->request->post('pickup_date');
        $bookingModel = new bookingModel();
        push(202,$bookingModel->create($client_id,$pickup_date,$items));
    });


    /**
     * Update booking
     */
    $app->post('/booking/update', 'originAuth' , 'requiresAdminLogin', function () use ($app){
        verifyRequiredParams('new_status,old_status,new_payment_status,old_payment_status,client_id,bid,transactionCode');
        $new_status = $app->request->post('new_status');
        $old_status = $app->request->post('old_status');
        $new_payment_status = $app->request->post('new_payment_status');
        $old_payment_status = $app->request->post('old_payment_status');
        $client_id = $app->request->post('client_id');
        $bid = $app->request->post('bid');
        $transactionCode = $app->request->post('transactionCode');
        $bookingModel = new bookingModel();
        push(202,$bookingModel->update($client_id,$bid,$new_status,$old_status,$new_payment_status,$old_payment_status,$transactionCode));
    });


    /**
     * Delete a  booking
     */
    $app->post('/booking/delete', 'originAuth' , 'requiresAdminLogin', function () use ($app){
        verifyRequiredParams('bid');
        $bid = $app->request->post('bid');
        $bookingModel = new bookingModel();
        push(202,$bookingModel->remove($bid));
    });

    /**
     * Register
     */
    $app->post('/register', 'originAuth' , function () use ($app){
        verifyRequiredParams('username,password');
        $username = $app->request->post('username');
        $password = $app->request->post('password');
        $admin = new adminModel();
        push(202,$admin->create($username,$password));
    });

    /**
     * Login
     */
    $app->post('/login', 'originAuth' , function () use ($app){
        verifyRequiredParams('username,password');
        $username = $app->request->post('username');
        $password = $app->request->post('password');
        $admin = new adminModel();
        push(202,$admin->authenticate($username,$password));
    });


    /**
     * Change password
     */
    $app->post('/update/password', 'originAuth' , function () use ($app){
        verifyRequiredParams('uid,oldPassword,newPassword');
        $uid = $app->request->post('uid');
        $oldPassword = $app->request->post('oldPassword');
        $newPassword = $app->request->post('newPassword');
        $model = new adminModel();
        push(202, $model->updatePassword($oldPassword,$newPassword,$uid) );
    });


});