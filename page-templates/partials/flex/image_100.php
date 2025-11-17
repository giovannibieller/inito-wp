<?php
    $image_100 = get_sub_field('image');
?>
<div class="main_container_int">
  <div class="image_100">
      <?php if( $image_100 && isset($image_100['url']) ){ 
        ?>
          <img src="<?php echo $image_100['url']; ?>" alt="<?php echo isset($image_100['alt']) ? $image_100['alt'] : ''; ?>" />
        <?php
      }?>
  </div>
</div>