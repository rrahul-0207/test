<?php
echo "hi";
?>
<div class="page-margin">
   <div class="row">
      <div class="col-md-2"><?php echo Wo_LoadPage("sidebar/left-sidebar"); ?></div>
      <div class="col-md-7 profile-lists">
         <div class="list-group">
            <div class="list-group-item"><i class="fa fa-fw fa-flag"></i> <?php echo $wo['lang']['my_pages'];?><span class="<?php echo Wo_RightToLeft('pull-right'); ?>" ><a href="<?php echo Wo_SeoLink('index.php?link1=create-page');?>" data-ajax="?link1=create-page"><?php echo $wo['lang']['create']; ?></a></span></div>
            <div class="setting-well">
              sdsdsdsd
               <div class="clear"></div>
            </div>
         </div>
      </div>
      <?php echo Wo_LoadPage('sidebar/content');?>
   </div>
</div>