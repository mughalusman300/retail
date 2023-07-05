<?php


use App\Models\Commonmodel;
use CodeIgniter\HTTP\IncomingRequest;


class numSeq 
{
    
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
        $Commonmodel = new Commonmodel();   

        $v_tablename            = "saimtech_numseq";
        $v_columnname           = "recid";
        $v_conditionvalue       = 1;
        $v_arr_data             = array();
        $v_query_result         = "";
        $v_prefix               = "";
        $v_code                 = "";
        ;

        $v_query_result         = $Commonmodel->Get_first_record($v_tablename);

        
        if ($_SESSION['module']=="Shop")
        {

            $v_prefix                   = shop_prefix;
            $v_code                     = $v_query_result[0]['shop_code'] + 1;
            $v_arr_data['shop_code']         = $v_code;

        }
        else if ($p_module=="Order")
        {
            $v_prefix                   = order_prefix;
            $v_code                     = $v_query_result['order_code'] + 1;
            $v_arr_data['order_code']   = $v_code;
            
        }
        else if ($p_module=="Item")
        {
            $v_prefix                   = item_prefix;
            $v_code                     = $v_query_result['item_code'] + 1;
            $v_arr_data['item_code']    = $v_code;
        } 
        
        
        $Commonmodel->Update_single_record($v_tablename, $v_columnname, $v_conditionvalue, $v_arr_data);
        

        return self::getCode($v_prefix,$v_code);         
    }
    
    public function getCode($p_prefix,$p_code){
        
        $precode="";


        if(strlen($p_code)==1)
        { 
            $precode=$p_prefix."00000".$p_code;
        } 
        else if(strlen($p_code)==2)
        { 
            $precode=$p_prefix."0000".$p_code;
        } 
        else if(strlen($p_code)==3)
        { 
            $precode=$p_prefix."000".$p_code;
        } 
        else if(strlen($p_code)==4)
        { 
            $precode=$p_prefix."00".$p_code;
        } 
        else if(strlen($p_code)==5)
        { 
            $precode=$p_prefix."0".$p_code;
        }
        else if(strlen($p_code)==6)
        { 
            $precode=$p_prefix.$p_code;
        } 
        
        return $precode;
    }
}