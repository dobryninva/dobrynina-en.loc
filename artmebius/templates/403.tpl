{extends 'template:base'}

{block 'vars'}
  {parent}
  {set $show_sidebar = 0}
{/block}

{block 'page'}
<div class="page page_inner page_403">
{/block}

{/block}
  <main class="article{($content_class ?: 'article_main')|before:' '}">
      <h1 class="article__header page-header">{$h1 ?: $pagetitle}</h1>
    <div class="article__content page-desc">{$content != '' ? ($content | imageSlimExt : "phpthumbon=q=90") : 'Доступ к данной странице запрещён.'}</div>
  </main>
{block 'main'}