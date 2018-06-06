<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('sendsms'))
{
    function sendsms($primary_number,$text)
    {
        try{
            
                
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "http://2factor.in/API/V1/85c9818b-31f6-11e5-af96-5600000c6b13/SMS/".$primary_number."/".$text,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
              ));

              $response = curl_exec($curl);
              $err = curl_error($curl);

              curl_close($curl);

              if ($err) {
                  echo "cURL Error #:" . $err;
              } else {
                  //echo $response;
              }
            
            }catch (phpmailerException $e)
            { //echo "<pre>"; 
            } catch(Execptions $ex)
            {
   

            }  
        
    }
}
if ( ! function_exists('send_transactional_sms'))
{    function send_transactional_sms($primary_number,$TemplateName,$referrername,$universityname,$link)
    {
        try{        //"http://2factor.in/API/V1/85c9818b-31f6-11e5-af96-5600000c6b13/SMS/".$primary_number."/".$text,
            
                
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "http://2factor.in/API/V1/85c9818b-31f6-11e5-af96-5600000c6b13/ADDON_SERVICES/SEND/TSMS",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "From=SHGURU&To=".$primary_number."&TemplateName=".$TemplateName."&VAR1=".$referrername."&VAR2=".$universityname."&VAR3=".$link."",
                CURLOPT_HTTPHEADER => array(
                                             "content-type: application/x-www-form-urlencoded"
                                           ),
                          ));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
}
            
            }catch (phpmailerException $e)
            { //echo "<pre>"; 
            } catch(Execptions $ex)
            {
   

            }  
        
    }
}
