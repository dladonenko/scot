<?php include_partial('userGenerator/assets') ?>
<div id="sf_admin_container">
  <h1>Generate users</h1>
  <?php include_partial('common/flashes') ?>
  <div id="sf_admin_content">
    <div class="sf_admin_form">
      <?php echo $form->renderFormTag(@userGenerator); ?>
      <fieldset id="sf_fieldset_none">
      <?php foreach ($form as $field): ?>
        <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_login">
        <?php if($field->hasError()) echo $field->renderError(); ?>
          <div>
            <?php echo $field->renderLabel(); ?>
            <div class="content"><?php echo $field->render(); ?></div>

            <?php if ($help=$field->renderHelp()): ?>
              <div class="help"><?php echo $help; ?></div>
            <?php endif; ?>

          </div>
        </div>
      <?php endforeach; ?>
      </fieldset>
      <ul class="sf_admin_actions">
        <li class="sf_admin_action_list"><?php echo link_to('Back to list', 'user'); ?> |</li>
        <li class="sf_admin_action_save"><input type="submit" value="Generate" /></li>
      </ul>
      </form>
   </div>
  </div>
</div>


