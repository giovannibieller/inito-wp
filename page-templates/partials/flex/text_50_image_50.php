<?php
    $text_50_left = apply_filters('the_content', get_sub_field('text_left'));
    $image_50_right_text = get_sub_field('image_right');
?>
<div class="main_container_int">
  <div class="text_50_image_50">
    <div class="text_50">
      <?php echo $text_50_left; ?>
    </div>
    <div class="image_50">
      <?php if( $image_50_right_text && isset($image_50_right_text['url']) ){ 
        ?>
          <img src="<?php echo $image_50_right_text['url']; ?>" alt="<?php echo isset($image_50_right_text['alt']) ? $image_50_right_text['alt'] : ''; ?>" />
        <?php
      }?>
    </div>
  </div>
</div>
