<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FocusRow
 *
 * @author TOSHIBA
 */
class FocusRow extends CAction{
        public function run(){
            
            $controller = $this->getController();
            $table = $_POST['table'];
            $id  = $_POST['id'];
            $att = $_POST['att'];
            $result = substr($table, 0, 5);
            
            if ($result=='bekle') $link='bekleyen/'.$table;
            else if($result=='biten') $link='bitenler/'.$table;
            else $link=$table.'/'.$table;
            
            $model = $table::model()->findByAttributes(array($att=>$id));
             if (!$model)
                $controller->redirect($table);
             else
            $controller->render($link,array('model'=>$model->search()));
         }
         
}
