<?php
    $image_full = get_sub_field('image');
?>
<div class="image_full">
    <?php if( $image_full && isset($image_full['url']) ){ 
      ?>
        <img src="<?php echo $image_full['url']; ?>" alt="<?php echo isset($image_full['alt']) ? $image_full['alt'] : ''; ?>" />
      <?php
    }?>
</div>