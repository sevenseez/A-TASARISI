<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GeneralFocusRow
 *
 * @author TOSHIBA
 */
class GeneralFocusRow extends CAction {
    public function run(){
            $controller = $this->getController();
            if(isset($_POST['table'])){
            $table = $_POST['table'];
            $id  = $_POST['id'];
            $result = substr($table, 0, 5);
            
            if ($result=='Bekle') $link='bekleyen/'.$table;
            else if($result=='Biten') $link='bitenler/'.$table;
            else $link=$table.'/'.$table;
            
            $model = $table::model()->findByPk($id);
            if (!$model || $result=='Dilek')
                if($result=='Dilek')
                    $controller->redirect(array('admin/dilek'));
                    else
                     $controller->redirect($table);
            else{
            $controller->render($link,array('model'=>$model->search()));
            }
         }
         else $controller->redirect('logs');
    }
}
