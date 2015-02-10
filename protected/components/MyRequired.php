<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyRequired
 *
 * @author TOSHIBA
 */
class MyRequired extends CValidator
{
 
    
    protected function validateAttribute($object, $attribute) {
        
        $diger_marka = $object->diger_marka;
        $diger_tipi = $object->diger_tipi;
        $cihaz_marka = $object->cihaz_marka;
        if(empty($diger_marka) && empty($diger_tipi) && empty($cihaz_marka))
         {
        $this->addError($object,$attribute,'Lütfen alanlardan birini doldurunuz!');
    
        }
      
    }
    
    
    public function clientValidateAttribute($object,$attribute)
    {
      
    // check the strength parameter used in the validation rule of our model
       
       $a = "(($('#BekleyenCihazlar_diger_marka').val()==null) || ($('#BekleyenCihazlar_diger_marka').val()==''))";
       $b="(($('#BekleyenCihazlar_diger_tipi').val()==null) || ($('#BekleyenCihazlar_diger_tipi').val()==''))";
       $c = "(($('#BekleyenCihazlar_cihaz_marka').val()==null) || ($('#BekleyenCihazlar_cihaz_marka').val()==''))";
       $condition= $a." && ".$b." && ".$c;
           return "
            if(".$condition.") {
                messages.push(".CJSON::encode('Lütfen alanlardan birini doldurunuz!').");
            }
           
            ";
       
        }
}