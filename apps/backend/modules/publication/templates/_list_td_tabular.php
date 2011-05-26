<td class="sf_admin_text sf_admin_list_td_citation">
  <?php echo link_to($publication->getRaw('citation'), 'publication_edit', $publication) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_publication_date">
  <?php echo $publication->getPublicationDate() ?>
</td>
