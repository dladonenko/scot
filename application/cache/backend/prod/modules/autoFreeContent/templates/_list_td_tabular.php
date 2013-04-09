<td class="sf_admin_foreignkey sf_admin_list_td_id">
  <?php echo link_to($content->getId(), 'freeContent_edit', $content) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $content->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_version">
  <?php echo $content->getVersion() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($content->getCreatedAt()) ? format_date($content->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($content->getUpdatedAt()) ? format_date($content->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
