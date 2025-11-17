<?php
    $text_50_left = apply_filters('the_content', get_sub_field('text_left'));
    $text_50_right = apply_filters('the_content', get_sub_field('text_right'));
?>
<div class="main_container_int">
  <div class="text_50_text_50">
    <div class="text_50">
        <?php echo $text_50_left; ?>
    </div>
    <div class="text_50">
        <?php echo $text_50_right; ?>
    </div>
  </div>
</div>
