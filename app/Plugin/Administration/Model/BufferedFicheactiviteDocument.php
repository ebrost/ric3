<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BuffredFicheactivite_Image
 *
 * @author manu
 */
App::uses('BufferedFicheactiviteMedia', 'Administration.Model');
class BufferedFicheactiviteDocument extends BufferedFicheactiviteMedia{
    //put your code here
public $name='BufferedFicheactiviteDocument';
    public $belongsTo=array(
        'BufferedFicheactivite',
        'Document'=>array('foreignKey'=>'media_id',
         'exclusive'=>true
                )
            );

 
   
}