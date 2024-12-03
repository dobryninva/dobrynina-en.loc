{extends 'template:base'}

{block 'vars'}
  {parent}
  {set $show_sidebar = 0}
{/block}


{block 'page'}
<div class="page page_inner page_404">
{/block}

{/block}
  <main class="article{($content_class ?: 'article_main')|before:' '}">
      <h1 class="article__header page-header">{$h1 ?: $pagetitle}</h1>
    <div class="article__content page-desc">{$content != '' ? ($content | imageSlimExt : "phpthumbon=q=90") : 'Данной страницы не существует, воспользуйтесь меню или поиском.'}</div>
  </main>
{block 'main'}