<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($content, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <li class="sf_admin_action_import">
      <?php echo link_to(__('Import', array(), 'messages'), 'paidContent/import?id='.$content->getId(), array()) ?>
    </li>
    <?php echo $helper->linkToDelete($content, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>
