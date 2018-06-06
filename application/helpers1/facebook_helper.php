<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once APPPATH."libraries/facebook-api-php-codexworld/src/Facebook/autoload.php";

if ( ! function_exists('authurl'))
{
    function authurl($uid)
    {
        try{
            
        //Call Facebook API
    $fb = new Facebook\Facebook([
                   'app_id' => '1647586375554072',
                   'app_secret' => '6d9f1e505ca74b433a6d5d2bac0a0e92',
                  'default_graph_version' => 'v2.7',
                  // . . .
                ]);
    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email', 'user_likes']; // optional 
     $authUrl = $helper->getLoginUrl(base_url() . 'Facebookcallback/'.$uid, $permissions);
     return $authUrl;
            }
            catch(Execptions $ex)
            {
   

            }  
        
    }
}
if ( ! function_exists('getdata'))
{
    function getdata()
    {
        try{
            
          //Call Facebook API
          $fb = new Facebook\Facebook([
                   'app_id' => '1647586375554072',
                   'app_secret' => '6d9f1e505ca74b433a6d5d2bac0a0e92',
                  'default_graph_version' => 'v2.7',
                  // . . .
                ]);    
        $helper = $fb->getRedirectLoginHelper();
        try {
             $accessToken = $helper->getAccessToken();
             //echo "Accesstoken". $accessToken;
             //$this->session->set_userdata('token',$accessToken); 
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
           // When Graph returns an error
             echo 'Graph returned an error: ' . $e->getMessage();
            //exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
           echo 'Facebook SDK returned an error: ' . $e->getMessage();
           //exit;
}
if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;

  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}    
  try {
        // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,first_name,last_name,email,gender,locale,picture', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  
  //exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  //exit;
}
     return $response->getGraphUser();
            }
            catch(Execptions $ex)
            {
   

            }  
        
    }
}
