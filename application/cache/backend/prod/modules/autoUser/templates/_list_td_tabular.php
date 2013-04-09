<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($user->getId(), 'user_edit', $user) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_login">
  <?php echo $user->getLogin() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_password">
  <?php echo $user->getPassword() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($user->getCreatedAt()) ? format_date($user->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
