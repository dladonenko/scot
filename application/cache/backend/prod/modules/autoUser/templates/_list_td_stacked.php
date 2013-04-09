<td colspan="4">
  <?php echo __('%%id%% - %%login%% - %%password%% - %%created_at%%', array('%%id%%' => link_to($user->getId(), 'user_edit', $user), '%%login%%' => $user->getLogin(), '%%password%%' => $user->getPassword(), '%%created_at%%' => false !== strtotime($user->getCreatedAt()) ? format_date($user->getCreatedAt(), "f") : '&nbsp;'), 'messages') ?>
</td>
