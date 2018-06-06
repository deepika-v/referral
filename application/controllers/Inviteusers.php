<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inviteusers extends CI_Controller {

  public function index()
	{
		$this->load->helper('url');
		$client_id = $this->config->item('google_clientid');
      $client_secret = $this->config->item('google_clientsecret');
      $redirect_uri = base_url().'Inviteusers/';
      $max_results = 10000;
      $auth_code = $_GET["code"];
      $fields=array(
          'code'=>  urlencode($auth_code),
          'client_id'=>  urlencode($client_id),
          'client_secret'=>  urlencode($client_secret),
          'redirect_uri'=>  urlencode($redirect_uri),
          'grant_type'=>  urlencode('authorization_code')
      );
      $post = '';
      foreach($fields as $key=>$value) { $post .= $key.'='.$value.'&'; }
      $post = rtrim($post,'&');

      $curl = curl_init();
      curl_setopt($curl,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
      curl_setopt($curl,CURLOPT_POST,5);
      curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
      $result = curl_exec($curl);
      curl_close($curl);

      $response =  json_decode($result);
      $accesstoken = $response->access_token;

      $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&alt=json&v=3.0&oauth_token='.$accesstoken;
      $xmlresponse =  $this->curl_file_get_contents($url);
      $contacts = json_decode($xmlresponse,true);
      if((strlen(stristr($xmlresponse,'Authorization required'))>0) && (strlen(stristr($xmlresponse,'Error '))>0))
      {
        echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
        exit();
      }

      $return = array();
          if (!empty($contacts['feed']['entry'])) 
          {
            
          foreach($contacts['feed']['entry'] as $contact)
           {
                 
                  //retrieve user photo
            if (isset($contact['link'][0]['href'])) {
              
              $url =   $contact['link'][0]['href'];
              
              $url = $url . '&access_token=' . urlencode($accesstoken);
              
              $curl = curl_init($url);

                  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                  curl_setopt($curl, CURLOPT_TIMEOUT, 15);
              curl_setopt($curl, CURLOPT_VERBOSE, true);
          
                  $image = curl_exec($curl);
                  curl_close($curl);
              
              
            }
              
              if($image==='Photo not found')
              {
                   $imgurl=base_url('assets/images/user.png');
                   //retrieve Name and email address  
                  $return[] = array (
                    'name'=> $contact['title']['$t'],
                    'email' => $contact['gd$email'][0]['address'],
                    'img_url' => '$imgurl',
                  );
              }
              else
              {
                 //retrieve Name and email address  
                  $return[] = array (
                    'name'=> $contact['title']['$t'],
                    'email' => $contact['gd$email'][0]['address'],
                    'img_url' => $url
                  );
              }
          } 
          //$google_contacts = $return;     //returning all data to avariable
          $data['google_contacts']=$return;
          $data['viewform']='1';
          $this->load->view('refer_view',$data);

		
	}
}
	  
    
function curl_file_get_contents($url)
      {
       $curl = curl_init();
       $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
       
       curl_setopt($curl,CURLOPT_URL,$url); //The URL to fetch. This can also be set when initializing a session with curl_init().
       curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);  //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
       curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5); //The number of seconds to wait while trying to connect.  
       
       curl_setopt($curl, CURLOPT_USERAGENT, $userAgent); //The contents of the "User-Agent: " header to be used in a HTTP request.
       curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);  //To follow any "Location: " header that the server sends as part of the HTTP header.
       curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE); //To automatically set the Referer: field in requests where it follows a Location: redirect.
       curl_setopt($curl, CURLOPT_TIMEOUT, 10); //The maximum number of seconds to allow cURL functions to execute.
       curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); //To stop cURL from verifying the peer's certificate.
       curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
       
       $contents = curl_exec($curl);
       curl_close($curl);
       return $contents;
      }


}
