<div class="file panel panel-default" >
    <div class="panel-heading clearfix">
 
<?php $img_url=(!empty($ext_media['content']->thumbnail))?  $ext_media['content']->thumbnail :$ext_media['content']->thumbnail_url;?>
<img src="<?php echo $img_url;?>" class="thumb" />
 <?php if (!empty($ext_media['content']->title)): ?>
        <div class="name"><?php echo $ext_media['content']->title;?></div>
    <?php endif;?>
        <div class="type">Type de contenu: <?php echo $ext_media['content']->type;?></div>
    <?php if (!empty($ext_media['content']->authorName)): ?>
    <div class="auteur">Auteur: <?php echo $ext_media['content']->authorName;?></div>
    <?php endif;?>
    <div class="actions">
        
        <a data-target="#viewExtMedia-<?php echo $ext_media['id'];?>" data-toggle="collapse" class="btn btn-default btn-sm editMedia"><i class="fa fa-eye "></i> Afficher</a>
         <?php echo $this->Html->link('<i class="fa fa-trash-o "></i> Supprimer',array('action'=>'ajaxDeleteExtMedia','id'=>$ext_media['id']),array('escape'=>false,'class'=>'btn btn-danger btn-sm deleteMedia')); ?>
       
    </div>
    </div>
   <div id="viewExtMedia-<?php echo $ext_media['id'];?>" class=" panel-body collapse" style="clear:both">

       <div class=" " >
          <div class="ext-content">
          <?php echo $ext_media['content']->html; ?>
          </div>
      </div>
    </div>
    
</div>