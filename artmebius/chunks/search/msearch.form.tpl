<form class="search-form msearch2" id="search{*mse2_form*}" action="{$pageId | url}" method="get">
  <input class="search-form__input" type="text" name="{$queryVar}" value="{$mse2_query}" placeholder="Найти товар"/>
  <button class="search-form__btn" type="submit"><i class="search-form__btn-icon fal fa-search"></i></button>
</form>
{*
{'svg_search' | placeholder} || <i class="fal fa-search"></i>

<span class="search_form_btn search_form_close hidden_close" data-hidden-close>{'svg_search' | placeholder}</span>
search_form_inner
*}