<?php
    $image_50_left_text = get_sub_field('image_left');
    $text_50_right = apply_filters('the_content', get_sub_field('text_right'));
?>
<div class="main_container_int">
  <div class="image_50_text_50">
    <div class="image_50">
      <?php if( $image_50_left_text && isset($image_50_left_text['url']) ){ 
        ?>
          <img src="<?php echo $image_50_left_text['url']; ?>" alt="<?php echo isset($image_50_left_text['alt']) ? $image_50_left_text['alt'] : ''; ?>" />
        <?php
      }?>
    </div>
    <div class="text_50">
      <?php echo $text_50_right; ?>
    </div>
  </div>
</div>
