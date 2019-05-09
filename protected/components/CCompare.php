<?php

class CCompare extends CActiveRecordBehavior
{
  public function compare($other) {
            $newattributes = $this->Owner->getAttributes();
            $oldattributes = $other->getAttributes();
 
            // compare old and new
            $difference = false;
            foreach ($newattributes as $name => $value) {
                $old = $oldattributes[$name]; 
                if ($value != $old) 
                {  
                    $difference = true;
                    
                }  

            }

            return $difference;
  }
}

?>