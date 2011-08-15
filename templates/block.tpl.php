<aside id="<?php print $block_html_id; ?>" class="<?php print $classes; ?> <?php print block_class($block); ?>">
  <?php if ($title): ?>
    <h2 class="title"><?php print $title; ?></h2>
  <?php endif; ?>

  <div class="content">
    <?php print $content; ?>
  </div>

  <?php print $edit_links; ?>
</aside><!-- /.block -->