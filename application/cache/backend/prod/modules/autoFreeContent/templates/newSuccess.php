<?php use_helper('I18N', 'Date') ?>
<?php include_partial('freeContent/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Create free content', array(), 'messages') ?></h1>

  <?php include_partial('freeContent/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('freeContent/form_header', array('content' => $content, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('freeContent/form', array('content' => $content, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('freeContent/form_footer', array('content' => $content, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
