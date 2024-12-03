{if $mdl_content?}
<div {if $mdl_id?}id="{$mdl_id}"{/if} class="mdl{$mdl_class|before:' '}">
  {if $mdl_title?}
    <div class="mdl__header{$mdl_header_class|before:' '}">{$mdl_title}</div>
  {/if}
  {if mdl_intro?}
    <div class="mdl__intro{$mdl_intro_class|before:' '}">{$mdl_intro}</div>
  {/if}
  <div class="mdl__body{$mdl_body_class|before:' '}">
    {$mdl_content}
  </div>
  {if ($mdl_show_more_id != '' || $mdl_footer != '')}
  <div class="mdl__footer{$mdl_footer_class|before:' '}">
    {if $mdl_show_more_id?}
      <a class="mdl__footer-link{$mdl_show_more_class|before:' '}" href="{$mdl_show_more_id | url}">{$mdl_show_more_text ?: 'Смотреть все'}</a>
    {/if}
    {$mdl_footer}
  </div>
  {/if}
</div>
{/if}
{*
{include 'widget'
  mdl_id                  = ''
  mdl_class           = ''
  mdl_header_class    = ''
  mdl_intro_class     = ''
  mdl_body_class      = ''
  mdl_footer_class    = ''
  mdl_show_more_class = ''

  mdl_title               = ''
  mdl_intro               = ''
  mdl_content             = ''
  mdl_show_more_id        = ''
  mdl_show_more_text      = ''
  mdl_footer              = ''
}
*}