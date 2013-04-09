<td colspan="5">
  <?php echo __('%%id%% - %%name%% - %%version%% - %%created_at%% - %%updated_at%%', array('%%id%%' => link_to($content->getId(), 'paidContent_edit', $content), '%%name%%' => $content->getName(), '%%version%%' => $content->getVersion(), '%%created_at%%' => false !== strtotime($content->getCreatedAt()) ? format_date($content->getCreatedAt(), "f") : '&nbsp;', '%%updated_at%%' => false !== strtotime($content->getUpdatedAt()) ? format_date($content->getUpdatedAt(), "f") : '&nbsp;'), 'messages') ?>
</td>
