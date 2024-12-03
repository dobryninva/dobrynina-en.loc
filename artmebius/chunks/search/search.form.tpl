<form name="search_form" id="search_form" action="{($landing ?: $_modx->resource.id) | url}" method="{$method ?: 'post'}">
  <div class="search_form_inner">
    <input class="sf_input" type="text" name="{$searchIndex}" id="{$searchIndex}" autocomplete="off" maxlength="50" value="{$searchValue ?: ''}" placeholder="поиск" />
    <button class="sf_submit" type="submit">Найти</button>
  </div>
  <input type="hidden" name="id" value="{$landing ?: $_modx->resource.id}" />
</form>