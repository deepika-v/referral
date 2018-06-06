<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('referralcode'))
{
    function referralcode()
    {
        try{
                           
               $referralcode= substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0,5);
                return $referralcode;
            }
            catch(Execptions $ex)
            {
   

            }  
        
    }
}
if ( ! function_exists('generate_otp'))
{
    function generate_otp()
    {
        try{
                           
               $string = '0123456789';
               $string_shuffled = str_shuffle($string);
               $otp = substr($string_shuffled, 1, 6);
               return $otp;
            }
            catch(Execptions $ex)
            {
   

            }  
        
    }
}
