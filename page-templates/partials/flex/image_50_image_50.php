<?php
    $image_50_left = get_sub_field('image_left');
    $image_50_right = get_sub_field('image_right');
?>
<div class="main_container_int">
  <div class="image_50_image_50">
    <div class="image_50">
      <?php if( $image_50_left && isset($image_50_left['url']) ){ 
        ?>
          <img src="<?php echo $image_50_left['url']; ?>" alt="<?php echo isset($image_50_left['alt']) ? $image_50_left['alt'] : ''; ?>" />
        <?php
      }?>
    </div>
    <div class="image_50">
      <?php if( $image_50_right && isset($image_50_right['url']) ){ 
        ?>
          <img src="<?php echo $image_50_right['url']; ?>" alt="<?php echo isset($image_50_right['alt']) ? $image_50_right['alt'] : ''; ?>" />
        <?php
      }?>
    </div>
  </div>
</div>
