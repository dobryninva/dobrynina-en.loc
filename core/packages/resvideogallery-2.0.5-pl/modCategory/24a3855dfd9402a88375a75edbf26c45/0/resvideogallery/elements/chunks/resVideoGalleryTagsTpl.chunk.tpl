<div class="rvg-tags-cloud">
    {foreach $tags as $tag}
        <a href="#" class="rvg-tag js-rvg-tag {if $tag['active']?} rvg-tag-active {/if}">{$tag['tag']}</a>
    {/foreach}
</div>