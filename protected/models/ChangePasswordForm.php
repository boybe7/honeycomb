<?php

class ChangePasswordForm extends CFormModel
{
  public $currentPassword;
  public $newPassword;
  public $newPassword_repeat;
  private $_user;
  
  public function rules()
  {
    return array(
      array(
        'currentPassword', 'compareCurrentPassword'
      ),
      array(
        'currentPassword, newPassword, newPassword_repeat', 'required',
        'message'=>'กรุณากรอก {attribute}.',
      ),
      array(
        'newPassword_repeat', 'compare',
        'compareAttribute'=>'newPassword',
        'message'=>'รหัสผ่านที่ยืนยันไม่ถูกต้อง',
      ),
      
    );
  }
  
  public function compareCurrentPassword($attribute,$params)
  {
    if(sha1($this->currentPassword) !== $this->_user->password )
    {
      $this->addError($attribute,'รหัสผ่านเก่าไม่ถูกต้อง');
    }
  }
  
  public function init()
  {
    $this->_user = User::model()->findByAttributes( array( 'username'=>Yii::app()->User->username ) );
  }
  
  public function attributeLabels()
  {
    return array(
      'currentPassword'=>'กรอกรหัสผ่านเก่า',
      'newPassword'=>'กรอกรหัสผ่านใหม่',
      'newPassword_repeat'=>'ยืนยันรหัสผ่านใหม่',
    );
  }
  
  public function changePassword()
  {
    $this->_user->password = $this->newPassword;
    if( $this->_user->save() )
      return true;
    return false;
  }
}

?>