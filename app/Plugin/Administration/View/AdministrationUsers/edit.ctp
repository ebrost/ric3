<?php $this->extend('Common/dashboard'); ?>
<?php echo $this->Html->script('Administration.addresspicker'); ?>
<?php echo $this->Html->script('Administration.tabs'); ?>
<?php echo $this->Html->script('Administration.plupload/plupload.full.min'); ?>
<?php echo $this->Html->script('Administration.ric.medias'); ?>
<?php echo $this->Html->script('Administration.ric.fetchExternalMedia'); ?>

<?php
if (!empty($this->validationErrors['AdministrationUser']) && isset($formName)) {
    $this->validationErrors[$formName] = $this->validationErrors['AdministrationUser'];
}
;
?>
<?php
if (isset($formName) && isset($this->validationErrors[$formName])) {
    debug($this->validationErrors[$formName]);
};
?>
<ul class="nav nav-tabs" id="tabs">
    <li class="active"><a href="#coordonnees" >Coordonnées</a></li>
    <li><a href="#change_password" >Changer mon mot de passe</a></li>
    <li><a href="#images" >Ajouter/supprimer des images</a></li>
     <li><a href="#documents" >Ajouter/supprimer des documents</a></li>
      <li><a href="#ext_medias" >Ajouter/supprimer des medias externes</a></li>

</ul>

<div class="tab-content">

    <div class="tab-pane active" id="coordonnees">

        <div class="form-group">

            <div class="row">
<?php echo $this->Form->create('AdministrationUserEdit', array('url' => array('controller' => 'administration_users', 'action' => 'edit'), 'class' => 'form-horizontal', 'role' => 'form')); ?>
                <div class="col-md-6 ">
                    <div id= "addresspicker_container" class="form-group  well ">
<?php echo $this->Form->label('addresspicker', 'Adresse à géolocaliser', 'col-md-4  control-label'); ?>

                        <div class="col-md-8 ">
<?php echo $this->Form->input('addresspicker', array('label' => false, 'placeholder' => 'Adresse à géolocaliser', 'data-element' => 'addresspicker', 'class' => 'form-control')); ?>
                            <div class="help-block">Saisissez votre adresse sous la forme :<br/>"11, rue du coq, 13001 Marseille".<br/>Complétez ou modifiez la dans les champs suivants</div> 
                        </div>

                    </div>
                    <div class="form-group">
<?php echo $this->Form->label('adresse', 'Adresse complete', 'col-md-4  control-label'); ?>
                        <div class="col-md-8 ">
                        <?php echo $this->Form->input('adresse', array('type' => 'textarea', 'label' => false, 'data-element' => 'street_address', 'placeholder' => 'Adresse', 'class' => 'form-control')); ?>
                        </div> 
                    </div>

                    <div class="form-group">
<?php echo $this->Form->label('code_postal', 'Code postal', 'col-md-4 control-label'); ?>
                        <div class="col-md-8 ">

                        <?php echo $this->Form->input('code_postal', array('label' => false, 'data-element' => 'code_postal', 'placeholder' => 'Code postal', 'class' => 'form-control')); ?>
                        </div> 
                    </div>
                    <div class="form-group">
<?php echo $this->Form->label('ville', 'Ville', 'col-md-4 control-label'); ?>
                        <div class="col-md-8 ">

<?php echo $this->Form->input('ville', array('label' => false, 'data-element' => 'ville', 'placeholder' => 'Ville', 'class' => 'form-control')); ?>
                        </div> 
                    </div>



                </div>

                <div class=" col-md-6">
                    <div id ="map_container" class="well"><div id="map" ></div>
                        <div class="row"> 
<?php echo $this->Form->label('latitude', 'Latitude', 'col-md-2 control-label'); ?>
                            <div class="col-xs-2 ">

<?php echo $this->Form->input('latitude', array('label' => false, 'type' => 'text', 'data-element' => 'latitude', 'readonly' => 'readonly', 'class' => 'form-control')); ?>
                            </div> 

<?php echo $this->Form->label('longitude', 'Longitude', 'col-md-2 control-label'); ?>
                            <div class="col-xs-2 ">

<?php echo $this->Form->input('longitude', array('label' => false, 'type' => 'text', 'data-element' => 'longitude', 'readonly' => 'readonly', 'class' => 'form-control')); ?>
                            </div> 
                        </div>
                        <span id="legend" class="alert alert-info">Vous pouvez modifier votre position en déplaçant le marqueur</span>
                    </div>

                </div>
                <div class="row">
                    <div class=" col-md-6">
                <?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?> 
                    </div>
                </div>


<?php echo $this->Form->end(); ?> 
            </div>
        </div>
    </div>
    <div class="tab-pane" id="change_password">
        <div class="row">
            <div class="col-md-4">
                        <?php echo $this->Form->create('AdministrationUserChangePassword', array('url' => array('controller' => 'administration_users', 'action' => 'change_password'), 'class' => 'form-horizontal', 'role' => 'form')); ?>

                <div class="form-group">
<?php echo $this->Form->label('old_password', 'Mot de passe actuel', 'col-md-6  control-label'); ?>
                    <div class="col-md-6 ">
                    <?php echo $this->Form->input('old_password', array('type' => 'password', 'label' => false, 'class' => 'form-control')); ?>
                    </div> 
                </div>
                <div class="form-group">
<?php echo $this->Form->label('new_password', 'Nouveau mot de passe', 'col-md-6  control-label'); ?>
                    <div class="col-md-6 ">
                    <?php echo $this->Form->input('new_password', array('type' => 'password', 'label' => false, 'class' => 'form-control')); ?>
                    </div> 
                </div>
                <div class="form-group">
                <?php echo $this->Form->label('confirm_password', 'Confirmez', 'col-md-6  control-label'); ?>
                    <div class="col-md-6 ">
                <?php echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => false, 'class' => 'form-control')); ?>
                    </div> 
                </div>
<?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?>
<?php echo $this->Form->end(); ?>
            </div>
            <div class="col-md-8"></div>
        </div>
    </div>
    <div class="tab-pane" id="images">
        <script>$(function(){
            Ric.uploader('Image','plupload_images','browse_images','droparea_images','filelist_images','<?php echo implode(',', $valid_images_extensions); ?>')
            });
            </script>
        <div id="plupload_images">
            
           
            <div id="droparea_images" class="droparea" href="#">
                <p><?php echo __d('media', "Déplacer les fichiers ici"); ?></p>
<?php echo __d('media', "ou"); ?><br/>

                <a id="browse_images" href="#" class="btn btn-primary"><?php echo __d('media', "Parcourir"); ?></a>
                <p class="small">(<?php echo $text_valid_images_extensions; ?>)</p>
            </div>
            <div id="filelist_images" class="filelist panel-group">
<?php foreach ($images as $image):; ?>
               
    <?php echo $this->element('media', array('media' => $image['Image'],'model'=>'Image')); ?>
<?php endforeach; ?>
            </div>
        </div>




    </div>
    <div class="tab-pane" id="documents">
        <script>$(function(){
            Ric.uploader('Document','plupload_documents','browse_documents','droparea_documents','filelist_documents','<?php echo implode(',', $valid_documents_extensions); ?>')
            });
            </script>
        <div id="plupload_documents">
            
           
            <div id="droparea_documents" class="droparea" href="#">
                <p><?php echo __d('media', "Déplacer les fichiers ici"); ?></p>
<?php echo __d('media', "ou"); ?><br/>

                <a id="browse_documents" href="#" class="btn btn-primary"><?php echo __d('media', "Parcourir"); ?></a>
                <p class="small">(<?php echo $text_valid_documents_extensions; ?>)</p>
            </div>
            <div id="filelist_documents" class="filelist panel-group">
<?php foreach ($documents as $document):; ?>          
    <?php echo $this->element('media', array('media' => $document['Document'],'model'=>'Document')); ?>
<?php endforeach; ?>
            </div>
        </div>




    </div>
    <div class="tab-pane" id="ext_medias">
        <script>$(function(){
            Ric.fetchExtMedia('filelist_extmedias');
            });
            </script>
        <div class="bs-callout bs-callout-info">
            <h4>Utilisation</h4>
            <p>Ajoutez vos vidéos, extraits sonores...<br>
                renseignez simplement l'url du média (http://www.youtube.com/watch?v=Aa123456).</p>
            <p>Fournisseurs actuellement supportés: Youtube, Dailymotion, Vimeo, Canal Plus, Flickr, Instagram, Scribd, Slideshare, SoundCloud.
            </p>
        </div>
        
        <div class="panel" >
            <div class="panel-body">
                <?php echo $this->Form->create('AdministrationUserAjaxGetExtMedia', array('url' => array('controller' => 'administration_users', 'action' => 'AjaxGetExtMedia'), 'class' => 'form-inline', 'role' => 'form')); ?>
                 <div class="form-group col-md-8">
                    <?php //echo $this->Form->label('url', 'Url', 'col-md-1  control-label'); ?>
                    <div class="col-md-11 ">
                      <?php echo $this->Form->input('url', array('placeholder'=>'url','type'=>'url','label' => false, 'class' => 'form-control')); ?>
                    </div>
                 </div>
                 <div class="col-md-4" style="padding:0">   
                      <?php echo $this->Form->button('Ajouter', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?> 
                 </div>  
                <?php echo $this->Form->end();?>
                
            </div>
        </div>  
            <div id="filelist_extmedias" class="filelist panel-group">
            <?php foreach ($ext_medias as $ext_media): ?> 
                <?php echo $this->element('ext_media', array('ext_media' => $ext_media['ExternalMedia'],'model'=>'ExternalMedia')); ?>
           <?php endforeach; ?>
            </div>
        
    </div>
</div>