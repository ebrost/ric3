<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BuffredFicheactiviteImage
 *
 * @author manu
 */
App::uses('AdministrationAppModel', 'Administration.Model');

class BufferedModelMedia extends AdministrationAppModel{
    //put your code here
    public $name;
    
    public $tablePrefix='';
    public $useTable='ric_medias_lies';
    
    public function saveMedia($data){
       // $dataSource = $this->getDataSource();
       // $dataSource->begin();
    //  debug($data);
      
      $mediaData=$data['media'];
      unset($data['media']);
      
      $model=array_shift(array_keys($data));
      debug($model);
         $this->deleteAll(array($this->name.'.model'=>$model,$this->name.'.foreign_key'=>$data[$model]['foreign_key'],$this->name.'.category'=>$data[$model]['category']),false);
         foreach ($mediaData as $key=>$mediaDatum) {
             $mediaData[$key]['model']=$model;
             $mediaData[$key]['category']=$data[$model]['category'];
             $mediaData[$key]['foreign_key']=$data[$model]['foreign_key'];
         }
        if ($this->saveMany($mediaData)) {
        //$dataSource->commit();
        } else {
          //  debug("rollback");
      //  $dataSource->rollback();
    }
        
         
    }
   
}
