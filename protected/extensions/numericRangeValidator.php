<?php

class numericRangeValidator extends CValidator
{
 
    public $min;
    public $max;

    /**
     * Validates the attribute of the object.
     * If there is any error, the error message is added to the object.
     * @param CModel $object the object being validated
     * @param string $attribute the attribute being validated
     */
    protected function validateAttribute($object,$attribute)
    {
     
        // extract the attribute value from it's model object
        $value=$object->$attribute;
        
        if (($value < $this->min) || ($value > $this->max)) 
        {
            $this->addError($object,$attribute,'ค่าควรอยู่ในช่วง ('.$this->min."-".$this->max.")");
        }
    }
    
    /**
     * Returns the JavaScript needed for performing client-side validation.
     * @param CModel $object the data object being validated
     * @param string $attribute the name of the attribute to be validated.
     * @return string the client-side validation script.
     * @see CActiveForm::enableClientValidation
     */
    public function clientValidateAttribute($object,$attribute)
    {
        
         
        $condition="(value < ".$this->min.") || (value > ".$this->max.")";
     
        return "
            if(".$condition.") {
                messages.push(".CJSON::encode('ควรมีค่าอยู่ในช่วง').");
            }
            ";
    }

}
?>
