
<div class="file panel panel-default" id="<?php echo $model.'-'.$media['id'];?>">
    <div class="panel-heading clearfix">
<?php 
if (file_exists(WWW_ROOT.'/medias/image'.'/'.$media['dir'].'/'.'thumb_'.$media['file'])) echo $this->Html->image('../medias/image'.'/'.$media['dir'].'/'.'thumb_'.$media['file'],array('class'=>'thumb'));?> 
    <?php if (!empty($media['name'])): ?>
    <div class="name"><?php echo $media['name'];?></div>
    <?php elseif (!empty($media['file'])): ?>
    <div class="name"><?php echo $media['file'];?></div>
    <?php endif;?>
    <?php if (!empty($media['copyright'])): ?>
    <div class="copyright">© <?php echo $media['copyright'];?></div>
    <?php endif;?>
    <div class="actions">
       
        <a data-target="#editMediaForm-<?php echo $media['id'];?>" data-toggle="collapse" class="btn btn-default btn-sm editMedia"><i class="fa fa-pencil-square-o "></i> Editer</a>
        <?php echo $this->Html->link('<i class="fa fa-trash-o "></i> Supprimer',array('action'=>'ajaxDeleteMedia','id'=>$media['id'],'model'=>$model),array('escape'=>false,'class'=>'btn btn-danger btn-sm deleteMedia')); ?>
       
    </div>
    </div>
    <div id="editMediaForm-<?php echo $media['id'];?>" class="collapse" style="clear:both">
      <div class="panel-body col-md-4" >
          <?php echo $this->Form->create('AdministrationUserEditMedia', array('url' => array('controller' => 'administration_users', 'action' => 'ajaxEditMedia'), 'class' => 'AdministrationUserEditMedia form-horizontal', 'role' => 'form')); ?>

        <div class="form-group">
<?php echo $this->Form->label('name', 'Nom', 'col-md-6  control-label'); ?>
                    <div class="col-md-6 ">
                    <?php echo $this->Form->input('name', array( 'label' => false, 'class' => 'form-control')); ?>
                    </div> 
                </div>
                <div class="form-group">
<?php echo $this->Form->label('copyright', 'Copyright', 'col-md-6  control-label'); ?>
                    <div class="col-md-6 ">
                    <?php echo $this->Form->input('copyright', array( 'label' => false, 'class' => 'form-control')); ?>
                    </div> 
                </div>
   <?php echo $this->Form->hidden('model',array('value'=>$model)); ?>   
   <?php echo $this->Form->hidden('id',array('value'=>$media['id'])); ?>   
<?php echo $this->Form->button('Enregistrer', array('type' => 'submit', 'class' => 'search btn btn-primary pull-right', 'id' => 'submit')); ?>
<?php echo $this->Form->end(); ?>
          
      </div>
    </div>
    
</div>