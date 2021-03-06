<?php
/**
 * AppController.php
 * File that contains the AppController class
 * @author Gabriel John P. Gagno
 * @version 1.0
 * @copyright 2016 Stratpoint Technologies, Inc.
 */

namespace App\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Unirest\Request;
use App\Libraries\P2MEWrapper;

/**
 * Class AppController
 * Main controller for this application. Allows access to several P2ME APIs.
 * @package App\Controllers
 */
class AppController
{
    /**
     * Handles card link API calls
     * @param Application $app
     * @return Response
     */
    public function cardLink(Application $app)
    {
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], $app['cardlink'], __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }

    /**
     * Handles Request Fee API calls
     * @param Application $app
     * @return Response
     */
    public function requestFee(Application $app)
    {
        $validateResponse = $this->_validateMobileNumber($app);
        if((string) json_decode($validateResponse->getContent())->p2me_result->status!="000") {
            return $validateResponse;
        }
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], $app['requestfees'], __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }

    /**
     * Handles Reset OTP API calls
     * @param Application $app
     * @return Response
     */
    public function resetOtp(Application $app)
    {
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], $app['resetotp'], __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }

    /**
     * Handles Reverse API Calls
     * @param Application $app
     * @return Response
     */
    public function reverse(Application $app)
    {
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], $app['reverse'], __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }

    /**
     * Handles Top UP API Calls
     * @param Application $app
     * @return Response
     */
    public function topUp(Application $app)
    {
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], $app['topup'], __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }

    /**
     * Handles transaction inquiry API calls
     * @param Application $app
     * @return Response
     */
    public function transactionInquiry(Application $app)
    {
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], $app['transactioninquiry'], __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }

    /**
     * Handles validate mobile number API calls
     * @param Application $app
     * @return Response
     */
    private function _validateMobileNumber(Application $app)
    {
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], $app['validatemobilenumber'], __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }
}