<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
// use Kreait\Firebase\Contract\Auth;
use Kreait\Firebase\Factory;
//use Kreait\laravel\Firebase\Facades\Firebase;

// use Firebase\Auth\Token\Exception\InvalidToken;
// use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
class GoogleController extends Controller
{
    
    //test for mobile application
    public function verfiyToken(Request $request)
    {   
        $httpClient = new Client([
           RequestOptions::VERIFY => false
        ]); 
        $factory = (new Factory)->withServiceAccount('U:\SE-Laravel-Backend\Maxfie\storage\firebase-credentials.json')->withProjectId('maxfie-mobile-app-77c9e');
        $auth = $factory->createAuth();
        //$string = implode(" ",$array);
        $idTokenString = (string) $request->social_login_tokenId;
        try {
            $signInResult = $auth->signInWithIdpAccessToken('google.com', $idTokenString, null, null, null, null);
            $response = [
                'result' => $signInResult
            ];
        } catch (FailedToVerifyToken $e) {
            // echo 'The token is invalid: '.$e->getMessage();
            $response = [
                'result' => 'fail'
            ];
        }
        return response($response, 201);

    }
    //test for web
    public function userLogin(Request $request) {
        $httpClient = new Client([
            RequestOptions::VERIFY => false
         ]); 
         $factory = (new Factory)->withServiceAccount('U:\SE-Laravel-Backend\Maxfie\storage\firebase-credentials.json')->withProjectId('maxfie-mobile-app-77c9e');
         $auth = $factory->createAuth();
         $idTokenString = $request->social_login_tokenId;
        try {
            // $verifiedIdToken = $auth->verifyIdToken($idTokenString);
            // $uid = $verifiedIdToken->claims()->get('sub');
            // $user = $auth->getUser($uid);
            //$signInResult = $auth->signInWithIdpAccessToken('google.com', $request->social_login_access_token, null, null, null, null);
           // dd($signInResult);
           dd($idTokenString);
        } catch (FailedToVerifyToken $e) {
            echo 'The token is invalid: '.$e->getMessage();
        }
       
        // $signInResult1 = $auth->signInWithIdpAccessToken('google', $request->social_login_access_token);
        // dd($signInResult1);
    }
}