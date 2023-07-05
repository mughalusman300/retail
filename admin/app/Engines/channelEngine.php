<?php

use App\Models\Commonmodel;
use CodeIgniter\HTTP\IncomingRequest;


class channelEngine
{
    function __construct() 
    {
        $this->Commonmodel = new Commonmodel(); 
        $_SESSION['module']="Shop";           
    }

    public function test(){
        
        echo("saim");
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
    public function create (
        $p_email,
        $p_phone,
        $p_mobile,
        $p_ntn,
        $p_fax = "NA",
        $p_address,
        $p_city,
        $p_country,
        $p_currency_code,
        $p_name,
        $p_sologo,
        $p_delivery_time,
        $p_tax_formula = "PER",
        $p_tax_value = 0
        ) 
    {
        $v_tablename = "saimtech_channel";
        $v_arr_data  = array();
        $v_arr       = array();
        $v_arr_result= array();
        $v_recid     = 0;
        $result      = false;
        ;
       
        $v_arr = json_decode(
                $this->validateWrite
                    (
                        $p_email,
                        $p_phone,
                        $p_mobile,
                        $p_ntn,
                        $p_address,
                        $p_city,
                        $p_country,
                        $p_currency_code,
                        $p_name,
                        $p_sologo,
                        $p_delivery_time
                    )
                );
        if ($v_arr["error_flag"]>0)
        {
            $_SESSION['module']                     = "Shop";
            
            //----Required  
            $v_arr_data["email"]                    = $p_email;
            $v_arr_data["phone"]                    = $p_phone;
            $v_arr_data["mobile"]                   = $p_mobile;
            $v_arr_data["ntn"]                      = $p_ntn;
            $v_arr_data["address"]                  = $p_address;
            $v_arr_data["city"]                     = $p_city;
            $v_arr_data["country"]                  = $p_country;
            $v_arr_data["sologo"]                   = $p_sologo;
            $v_arr_data["name"]                     = $p_name;
            $v_arr_data["code"]                     = numSeq::num();  
            $v_arr_data["apply_tax"]                = 0; 
            $v_arr_data["tax_group"]                = 0;     
            $v_arr_data["currency_code"]            = "";
            $v_arr_data["is_active"]                = "";
            
            //Optional
            $v_arr_data["fax"]                      = $p_fax;
            $v_arr_data["dimensions"]               = 0; 
            
            //Auto
            $v_arr_data["default_customer"]          = 0;
            $v_arr_data["functionality_profile"]     = 0;    
            $v_arr_data["price_list"]                = 0;
            
            //Data
            $v_array_data = array();
            $v_array_data['delivery_time']           =  $p_delivery_time;
            $v_array_data['tax_formula']             =  $p_tax_formula;
            $v_array_data['tax_amount']              =  $p_tax_amount;
            $v_arr_data['data']                      =  json_encode($v_array_data);

            //Session
            $v_arr_data["created_by"]                =  $_SESSION['user_id'];

            $v_recid=$this->Commonmodel->Insert_record($v_tablename, $v_arr_data);

            $v_arr_result['recid']=$v_recid;
            $v_arr_result['error']=0;
            $v_arr_result['error_message']="";
           
        }
        else 
        {
            $v_arr_result['recid']=0;
            $v_arr_result['error']=1;
            $v_arr_result['error_message']=$v_arr['error_message'];
            
        }    
        
        return json_encode($v_arr_result);
    }
    /**
     * --------------------------------------------------------------------------
     * Active Channel Mehtod 
     * --------------------------------------------------------------------------
     *
     * Active Channel | Shop | Store in database. 
     * Update status.
     *
     * Parms  : $p_active | $p_recid
     * Return : JSON return
     * 
     * Author : Muhammad Saim.
     * Date   : June-19-2023.
     */
    public function active($p_active=0, $p_recid)
    {
        $v_tablename ="saimtech_channel";
        $v_columnname ="recid";
        $v_conditionvalue =$p_recid; 
        $v_arr_data= array();
        $v_arr_result="";
        ;

        if ($p_recid)
        {
            $v_arr_data['is_active']=$p_active;
            $v_arr_data['modify_by']=$_SESSION['user_id'];
            $v_arr_data['modify_at']=time_stamp;
                  
            $this->Commonmodel->Update_record($v_tablename, $v_columnname, $v_conditionvalue, $v_arr_data);

            $v_arr_result['error']=0;
            $v_arr_result['error_message']="";
        }    
        else
        {
            $v_arr_result['error']=1;
            $v_arr_result['error_message']=" Record not found.";
        }

        return json_encode($v_arr_result);

    }
    
    /**
     * --------------------------------------------------------------------------
     * Validate Write Mehtod 
     * --------------------------------------------------------------------------
     *
     * Create Channel | Shop | Store in database. 
     * Check Field Validations.
     * $p_email | $p_phone | $p_mobile | $p_ntn | $p_address | $p_city | $p_country |  $p_currency_code |  $p_name | $p_sologo | $p_delivery_time
     * 
     * Author: Muhammad Saim.
     * Date  : June-19-2023.
     */
    public function validateWrite(
        $p_email,
        $p_phone,
        $p_mobile,
        $p_ntn,
        $p_address,
        $p_city,
        $p_country,
        $p_currency_code,
        $p_name,
        $p_sologo,
        $p_delivery_time
        )
    {
        $v_arr   = array();
        $v_msg   = "";
        $v_error = 0;
        ;
        //---------
        if ($p_email=="")
        {
            $v_msg      += " Email address must not be null.";
            $v_error    = 1;
        }
        //---------
        if ($p_phone=="")
        {
            $v_msg      += " Phone number must not be null.";
            $v_error    = 1;
        }
        //---------
        if ($p_mobile=="")
        {
            $v_msg      += " Mobile number must not be null.";
            $v_error    = 1;
        }
        //---------
        if ($p_ntn=="")
        {
            $v_msg      += " NTN number must not be null.";
            $v_error    = 1;
        }
        //---------
        if ($p_address=="")
        {
            $v_msg      += " Address must not be null.";
            $v_error    = 1;
        }
        //---------
        if ($p_city=="")
        {
            $v_msg      += " City must not be null.";
            $v_error    = 1;
        }
        //---------
        if ($p_country=="")
        {
            $v_msg      += " Country must not be null.";
            $v_error    = 1;
        }
        //---------
        if ($p_sologo=="")
        {
            $v_msg      += " Sologo must not be null.";
            $v_error    = 1;
        }
        //---------
        if ($p_name=="")
        {
            $v_msg      += " Name must not be null.";
            $v_error    = 1;
        }
        //---------
        if ($p_currency_code=="")
        {
            $v_msg      += " Currency Code must not be null.";
            $v_error    = 1;
        }
        //---------
        if ($p_delivery_time=="")
        {
            $v_msg      += " Delivery Time must not be null.";
            $v_error    = 1;
        }
        
        //-----set array
        $v_arr['error_flag'] = $v_error;
        $v_arr['error_message'] = $v_msg;
        
        //------return result
        return json_encode($v_arr);
        
    }
}