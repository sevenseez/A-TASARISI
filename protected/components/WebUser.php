<?php
 
// this file must be stored in:
// protected/components/WebUser.php
 
class WebUser extends CWebUser {
 
  // Store model to not repeat query.
  private $_model;
 
  // Return first name.
  // access it by Yii::app()->user->first_name
  function getFirst_Name(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->y_adsoyad;
  }
 
  function real_name($id){
      
     if($id=='0' || $id==null) { return 'Müşteri';}
      else {
      $user = Yonetici::model()->findByPk($id);
    
      return $user->y_adsoyad; }
  }
  
  // This is a function that checks the field 'role'
  // in the User model to be equal to 1, that means it's admin
  // access it by Yii::app()->user->isAdmin()
  function isAdmin(){
    $user = $this->loadUser(Yii::app()->user->id);
    if($user['yetki'] == 1)
    return true;
  }
  

  // Load user model.
  protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=Yonetici::model()->findByPk($id);
        }
        return $this->_model;
    }
 
  
}
?>