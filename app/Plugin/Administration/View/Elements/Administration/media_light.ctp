<?php //debug($media); ?>
<?php $mediaId= $media[$category]['id']; ?>
<div class="file panel panel-default <?php echo $category; ?>" id="<?php echo $category.'-'. $mediaId;?>">
     <input type="hidden"  value="<?php echo (isset($media['id']))?$media['id']:'' ?>" name="data[media][<?php echo $mediaId ?>][id]">
     <input type="hidden"  value="<?php echo $mediaId ?>" name="data[media][<?php echo $mediaId ?>][media_id]">
     <input type="hidden"  data-attr="order" value="<?php echo (isset($media['order']))?$media['order']:'' ?>" name="data[media][<?php echo $mediaId ?>][order]">
   
    <div class="panel-heading clearfix">
<?php 
if (isset($media[$category]) && file_exists(WWW_ROOT.'/medias/'.$category.'/'.$media[$category]['dir'].'/'.'thumb_'.$media[$category]['file'])) echo $this->Html->image('../medias/'.$category.'/'.$media[$category]['dir'].'/'.'thumb_'.$media[$category]['file'],array('class'=>'thumb'));?> 
    <?php if (!empty($media[$category]['name'])): ?>
    <div class="name"><?php echo $media[$category]['name'];?></div>
    <?php elseif (!empty($media[$category]['file'])): ?>
    <div class="name"><?php echo $media[$category]['file'];?></div>
    <?php endif;?>
    <?php if (!empty($media[$category]['copyright'])): ?>
    <div class="copyright">© <?php echo $media[$category]['copyright'];?></div>
    <?php endif;?>
    </div>
   
</div>