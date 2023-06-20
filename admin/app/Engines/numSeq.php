<?php

use App\Models\Commonmodel;
use CodeIgniter\HTTP\IncomingRequest;


class numSeq
{
    function __construct() 
    {
        $this->Commonmodel = new Commonmodel();            
    }
    
    /**
     * --------------------------------------------------------------------------
     * Create Channel Mehtod 
     * --------------------------------------------------------------------------
     *
     * Create Channel | Shop | Store in database. 
     * Check Field Validations.
     * Insert auto data on some fields.
     * 
     * Parms  : $p_email | $p_phone | $p_mobile | $p_ntn | $p_fax | $p_address | $p_city | $p_country | $p_currency_code | $p_name | $p_sologo | $p_delivery_time | $p_tax_formula | $p_tax_value
     * Return : JSON Array
     * 
     * 
     * Author: Muhammad Saim.
     * Date  : June-19-2023.
     */
    public static function num() 
    {
        $v_tablename            = "saimtech_numSeq";
        $v_columnname           = "recid";
        $v_conditionvalue       = 1;
        $v_arr_data             = array();
        $v_query_result         = "";
        $v_prefix               = "";
        $v_code                 = "";
        ;

        $v_query_result         = $this->Commonmodel->Get_first_record($v_tablename);

        if ($_SESSION['module']=="Shop")
        {

            $v_prefix                   = shop_prefix;
            $v_code                     = $v_query_result['shop_code'] + 1;
            $v_arr_data['shop_code']    = $v_code;

        }
        else if ($_SESSION['module']=="Order")
        {
            $v_prefix                   = order_prefix;
            $v_code                     = $v_query_result['order_code'] + 1;
            $v_arr_data['shop_code']    = $v_code;
            
        }
        else if ($_SESSION['module']=="Item")
        {
            $v_prefix                   = item_prefix;
            $v_code                     = $v_query_result['item_code'] + 1;
            $v_arr_data['shop_code']    = $v_code;
        } 

        $this->Commonmodel->Update_record($v_tablename, $v_columnname, $v_conditionvalue, $v_arr_data);
        
        return $this->getCode($v_prefix,$v_code);         
    }
    
    private function getCode($p_prefix,$p_code){
        
        $precode="";


        if(strlen($code)==1)
        { 
            $precode=$prefix."00000".$code;
        } 
        else if(strlen($code)==2)
        { 
            $precode=$prefix."0000".$code;
        } 
        else if(strlen($code)==3)
        { 
            $precode=$prefix."000".$code;
        } 
        else if(strlen($code)==4)
        { 
            $precode=$prefix."00".$code;
        } 
        else if(strlen($code)==5)
        { 
            $precode=$prefix."0".$code;
        }
        else if(strlen($code)==6)
        { 
            $precode=$prefix.$code;
        } 
        
        return $precode;
    }
}