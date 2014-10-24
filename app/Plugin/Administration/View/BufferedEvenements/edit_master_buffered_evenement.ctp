<?php $this->extend('Common/dashboard'); ?>
<?php echo $this->Html->script('Administration.ric.tabwizard'); ?>
<?php echo $this->Html->script('Administration.ric.medias'); ?>


<?php if (count($user['AvailablesFicheactivite']) == 0): ?>
    <div class="bs-callout bs-callout-info">
        <h4>Vous n'avez pas de fiche activité définie</h4>
        <p>Cette étape est nécessaire pour créer des événements
        </p>
        <?php
        echo $this->Html->link(' <i class="fa fa-plus-circle fa-fw"></i> Ajouter une activité', array(
            'plugin' => 'administration',
            'controller' => 'BufferedFicheactivites',
            'action' => 'add'), array('class' => 'btn btn-primary btn-sm', 'escape' => false))
        ?>
    </div> 
<?php else: ?>


    <script>
        $(function() {
            Ric.tabWizard('#rootwizard', "<?php echo $this->Html->url(array('controller' => 'BufferedEvenements', 'action' => 'checkValidation'), true); ?>", false);
     
        });
    </script>  
<?php $bufferedEvenement=$this->request->data; ?>

    <div id="rootwizard">
        <ul class="nav nav-tabs" id ="tabs">
            <li class="active"><a href="#coordonnees" data-toggle="tab">Informations générales</a></li>
            <li><a href="#description" data-toggle="tab">Description</a></li>
            <li><a href="#images" data-toggle="tab">Images</a></li>
            <li><a href="#documents" data-toggle="tab">Documents</a></li>
            <li><a href="#ext_medias" data-toggle="tab">Médias externes</a></li>
        </ul>
        <?php echo $this->Form->create('BufferedEvenement', array('class' => 'form-horizontal', 'role' => 'form')); ?>   
        <div class="tab-content">
            <?php debug($this->data['BufferedEvenement']); ?>
            <div class="tab-pane active" id="coordonnees">
                <div class="input"><?php echo $this->Form->hidden('BufferedEvenement.id'); ?></div>
                <div class="input"><?php echo $this->Form->hidden('BufferedEvenement.evenement_id'); ?></div>
                 <?php debug($this->request->data); ?>
                <?php echo $this->element('Agenda/link_to_ficheactivite',array('bufferedFicheactivite'=>$this->request->data['BufferedFicheactivite'])); ?>   

                <div class="form-group">
                    <?php echo $this->Form->label('BufferedEvenement.nom_complet', 'Nom', 'col-md-2 control-label'); ?>

                    <div class="col-md-4 ">

                        <?php echo $this->Form->input('BufferedEvenement.nom_complet', array('label' => false, 'placeholder' => 'Nom', 'class' => 'form-control')); ?>
                    </div> 
                </div>
                
                    
                <div class="row">
                    <div class="col-md-6 ">
                        <div id="EventAddressFields">
                            <div class="form-group">
                                <?php echo $this->Form->label('BufferedEvenement.adresse', 'Adresse complete', 'col-md-4  control-label'); ?>
                                <div class="col-md-8 ">
                                    <?php echo $this->Form->input('BufferedEvenement.adresse', array('type' => 'textarea', 'label' => false, 'data-element' => 'street_address', 'placeholder' => 'Adresse', 'class' => 'form-control')); ?>
                                </div> 
                            </div>

                            <div class="form-group">
                                <?php echo $this->Form->label('BufferedEvenement.code_postal', 'Code postal', 'col-md-4 control-label'); ?>
                                <div class="col-md-8 ">

                                    <?php echo $this->Form->input('BufferedEvenement.code_postal', array('label' => false, 'data-element' => 'code_postal', 'placeholder' => 'Code postal', 'class' => 'form-control')); ?>
                                </div> 
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->label('BufferedEvenement.ville', 'Ville', 'col-md-4 control-label'); ?>
                                <div class="col-md-8 ">

                                    <?php echo $this->Form->input('BufferedEvenement.ville', array('label' => false, 'data-element' => 'ville', 'placeholder' => 'Ville', 'class' => 'form-control')); ?>
                                </div> 
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->label('BufferedEvenement.pays', 'Pays', 'col-md-4 control-label'); ?>
                                <div class="col-md-8 ">

                                    <?php echo $this->Form->input('BufferedEvenement.pays', array('label' => false, 'data-element' => 'pays', 'placeholder' => 'Pays', 'class' => 'form-control')); ?>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->label('BufferedEvenement.telephone', 'Télephone', 'col-md-4 control-label'); ?>
                            <div class="col-md-8 ">

                                <?php echo $this->Form->input('BufferedEvenement.telephone', array('label' => false, 'data-element' => 'telephone', 'placeholder' => 'Télephone', 'class' => 'form-control')); ?>
                            </div> 
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->label('BufferedEvenement.telephone_billeterie', 'Télephone Billeterie', 'col-md-4 control-label'); ?>
                            <div class="col-md-8 ">

                                <?php echo $this->Form->input('BufferedEvenement.telephone_billeterie', array('label' => false, 'data-element' => 'telephone_billeterie', 'placeholder' => 'Billeterie', 'class' => 'form-control')); ?>
                            </div> 
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->label('BufferedEvenement.site_web', 'Internet', 'col-md-4 control-label'); ?>
                            <div class="col-md-8 ">

                                <?php echo $this->Form->input('BufferedEvenement.site_web', array('label' => false, 'data-element' => 'site_web', 'placeholder' => 'Internet', 'class' => 'form-control')); ?>
                            </div> 
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->label('BufferedEvenement.courriel', 'E-mail', 'col-md-4 control-label'); ?>
                            <div class="col-md-8 ">

                                <?php echo $this->Form->input('BufferedEvenement.courriel', array('label' => false, 'data-element' => 'courriel', 'placeholder' => 'E-mail', 'class' => 'form-control')); ?>
                            </div> 
                        </div>
                        

                    </div>
                      
                   

                </div>
<div class="row">
                    <div class="col-md-6">
                         <div class="input"><?php echo $this->Form->hidden('BufferedEvenement.master'); ?></div>
                        <?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?> 
                    </div>

                </div>
            </div>
            <div class="tab-pane" id="description">
                <div class="form-group clearfix">
                    <?php echo $this->Form->label('BufferedEvenement.commentaires', 'Description', 'col-md-1 col-md-offset-1 control-label'); ?>


                    <div class="col-md-10 ">
                        <?php echo $this->Form->input('BufferedEvenement.commentaires', array('label' => false, 'data-element' => 'commentaires', 'placeholder' => 'Description de l\'événémént', 'class' => 'form-control')); ?>
                    </div> 

                </div>

                <div class="row">
                    <div class="col-md-6">
                         <div class="input"><?php echo $this->Form->hidden('BufferedEvenement.master'); ?></div>
                        <?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?> 
                    </div>

                </div>  
              



            </div>
            <?php echo $this->Form->end(); ?>
             <div class="tab-pane" id="images">


            <script>
                $(function() {
                  Ric.selectMedias('ImageAdd');
                });
            </script>


            <div class="bs-callout bs-callout-info">
                <?php if ($allImages['total'] === 0): ?>
                    <h4>Vous n'avez pas d'images associées à votre profil !</h4>
                    <p>rendez vous dans la section "profil" pour en ajouter #TODO: inserer le lien ou ouvrir fenetre modale
                    </p>
                <?php else: ?>
                    <h4>Sélectionnez les images</h4>
                    <p>La première image sera affichée comme vignette</p>
                    <small>les éléments sont sauvegardés automatiquement</small>
                <?php endif; ?>

            </div>


            <div class="row">
                <div id="ImageAdd" class="selectMedias">
                    <div class=" col-md-6  ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Images selectionnées</h3>
                            </div>
                            <?php echo $this->Form->create('BufferedEvenementImage', array('url' => array('controller' => 'BufferedEvenements', 'action' => 'updateMedia'))); ?>
                            <div class="panel-body selected connectedSortable">
                                  
                                <?php foreach ($bufferedEvenement['BufferedEvenementImage'] as $bufferedEvenementImage): ?>

                                    <?php echo $this->element('Administration/media_light', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'media' => $bufferedEvenementImage, 'model' => 'BufferedEvenement', 'category' => 'Image')); ?>
                                <?php endforeach; ?>
                                <?php echo $this->Form->input('BufferedEvenement.foreign_key', array('type'=>'hidden','value'=>$bufferedEvenement['BufferedEvenement']['id']));?>
                                 <?php echo $this->Form->input('BufferedEvenement.category', array('type'=>'hidden','value'=>'Image'));?>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>  
                    </div>
                    <div class="col-md-6 ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Images disponibles</h3>
                            </div>
                            <div class="panel-body unselected connectedSortable">
                                
                                <?php foreach ($allImages['available'] as $image): ?>

                                    <?php echo $this->element('Administration/media_light', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'media' => $image, 'model' => 'BufferedEvenement', 'category' => 'Image')); ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="documents">
            

            <script>
                $(function() {
                  Ric.selectMedias('DocAdd');
                });
            </script>


            <div class="bs-callout bs-callout-info">
                <?php if ($allDocuments['total'] === 0): ?>
                    <h4>Vous n'avez pas de documents associées à votre profil !</h4>
                    <p>rendez vous dans la section "profil" pour en ajouter #TODO: inserer le lien ou ouvrir fenetre modale
                    </p>
                <?php else: ?>
                    <h4>Sélectionnez les documents</h4>
                  <small>les éléments sont sauvegardés automatiquement</small>
                <?php endif; ?>

            </div>


            <div class="row">
                <div id="DocAdd" class="selectMedias">
                    <div class=" col-md-6  ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Documents selectionnés</h3>
                            </div>
                            <?php echo $this->Form->create('BufferedEvenement', array('url' => array('controller' => 'BufferedEvenements', 'action' => 'updateMedia'))); ?>
                            <div class="panel-body selected connectedSortable">
                                   
                              
                                <?php echo $this->Form->input('BufferedEvenement.foreign_key', array('type'=>'hidden','value'=>$bufferedEvenement['BufferedEvenement']['id']));?>
                            
                                <?php echo $this->Form->input('BufferedEvenement.category', array('type'=>'hidden','value'=>'Document'));?>
                                <?php foreach ($bufferedEvenement['BufferedEvenementDocument'] as $bufferedEvenementDocument): ?>

                                    <?php echo $this->element('Administration/media_light', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'media' => $bufferedEvenementDocument, 'model' => 'BufferedEvenementMedia', 'category' => 'Document')); ?>
                                <?php endforeach; ?>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>  
                    </div>
                    <div class="col-md-6 ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Documents disponibles</h3>
                            </div>
                            <div class="panel-body unselected connectedSortable">
                               <?php //debug($allDocuments); ?>
                                <?php foreach ($allDocuments['available'] as $document): ?>

                                    <?php echo $this->element('Administration/media_light', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'media' => $document, 'model' => 'BufferedEvenement', 'category' => 'Document')); ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="ext_medias">
            
             <script>
                $(function() {
                  Ric.selectMedias('ExternalMediaAdd');
                });
            </script>
             <div class="bs-callout bs-callout-info">
                <?php if ($allExternalMedias['total'] === 0): ?>
                    <h4>Vous n'avez pas de medias externes associées à votre profil !</h4>
                    <p>rendez vous dans la section "profil" pour en ajouter #TODO: inserer le lien ou ouvrir fenetre modale
                    </p>
                <?php else: ?>
                    <h4>Sélectionnez les médias externes</h4>
                  <small>les éléments sont sauvegardés automatiquement</small>
                <?php endif; ?>

            </div>


            <div class="row">
                <div id="ExternalMediaAdd" class="selectMedias">
                    <div class=" col-md-6  ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Medias externes selectionnés</h3>
                            </div>
                            <?php echo $this->Form->create('BufferedEvenement', array('url' => array('controller' => 'BufferedEvenements', 'action' => 'updateMedia'))); ?>
                            <div class="panel-body selected connectedSortable">
                                   
                              
                               
                                <?php foreach ($bufferedEvenement['BufferedEvenementExternalMedia'] as $bufferedEvenementExternalMedia): ?>

                                    <?php echo $this->element('Administration/ext_media_light', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'ext_media' => $bufferedEvenementExternalMedia, 'model' => 'BufferedEvenementMedia', 'category' => 'ExternalMedia')); ?>
                                <?php endforeach; ?>
                                    <?php echo $this->Form->input('BufferedEvenement.foreign_key', array('type'=>'hidden','value'=>$bufferedEvenement['BufferedEvenement']['id']));?>
                                    <?php echo $this->Form->input('BufferedEvenement.category', array('type'=>'hidden','value'=>'ExternalMedia'));?>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>  
                    </div>
                    <div class="col-md-6 ">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Médias externes disponibles</h3>
                            </div>
                            <div class="panel-body unselected connectedSortable">
                               <?php //debug($allDocuments); ?>
                                <?php foreach ($allExternalMedias['available'] as $externalMedia): ?>

                                    <?php echo $this->element('Administration/ext_media_light', array('foreign_key' => $bufferedEvenement['BufferedEvenement']['id'], 'ext_media' => $externalMedia, 'model' => 'BufferedEvenement', 'category' => 'ExternalMedia')); ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>



        <div class="row">
            <div class=" col-md-6">

                <ul class=" wizard  pager prev-next ">
                    <li class="previous"><a href="#" name='previous' >Précédent</a></li> 
                    <li class="next"><a href="#"  name='next' >Suivant</a></li>             


                </ul>
            </div>
        </div>
    </div>    

    
<?php endif; ?>