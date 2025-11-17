<div class="flex_blocks">
  <?php if (have_rows('blocks')): while (have_rows('blocks')): the_row(); ?>
    <?php if (get_row_layout() === 'text_100'){ include (TEMPLATEPATH . "/page-templates/partials/flex/text_100.php"); }?>
    <?php if (get_row_layout() === 'text_50_text_50'){ include (TEMPLATEPATH . "/page-templates/partials/flex/text_50_text_50.php"); }?>
    <?php if (get_row_layout() === 'image_100'){ include (TEMPLATEPATH . "/page-templates/partials/flex/image_100.php"); }?>
    <?php if (get_row_layout() === 'image_50_image_50'){ include (TEMPLATEPATH . "/page-templates/partials/flex/image_50_image_50.php"); }?>
    <?php if (get_row_layout() === 'image_50_text_50'){ include (TEMPLATEPATH . "/page-templates/partials/flex/image_50_text_50.php"); }?>
    <?php if (get_row_layout() === 'text_50_image_50'){ include (TEMPLATEPATH . "/page-templates/partials/flex/text_50_image_50.php"); }?>
    <?php if (get_row_layout() === 'image_full'){ include (TEMPLATEPATH . "/page-templates/partials/flex/image_full.php"); }?>
  <?php endwhile; endif; ?>
</div>