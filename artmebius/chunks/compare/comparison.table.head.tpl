<td class="comparison-head" data-id="{$id}" data-list="{$list}">
  <div class="comparison-head-thumb">
    <img src="{$preview | phpthumbon : '&w=320&h=240&zc=0&far=1'}" alt="" title="" /><br/>
    {* <img src="{$_pls['data.thumb']}" alt="" title="" /><br/> *}
  </div>
  <div class="comparison-head-link">
    <a href="{$id | url}">{$pagetitle}</a><br/>
  </div>
  <div class="comparison-head-delete-link">
    <a href="#" class="comparison-remove comparison-link" data-text="{'comparison_updating_list' | lexicon}">{'comparison_remove' | lexicon}</a>
  </div>
</td>