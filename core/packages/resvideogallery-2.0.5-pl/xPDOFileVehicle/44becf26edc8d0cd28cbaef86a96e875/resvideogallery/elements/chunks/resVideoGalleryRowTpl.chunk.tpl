<div class="rvg-col-md-4 animated zoomIn">
    <div class="rvg-gallery-item">
        <div class="rvg-gallery-item-wrap">
            <img src="{$thumb}" alt="{$title}" width="{$width}" height="{$height}" title="{$title}">
            {if $isVideo?}
                <div class="rvg-gallery-item-duration">{$duration}</div>
            {/if}
            <span class="rvg-gallery-item-overlay">
                <span class="rvg-gallery-item-btn {if $isVideo?} rvg-show {/if}">
                    <span>
                        {if $isVideo?}
                            <a href="#" class="js-rvg-play" data-id="{$id}"><span class="rvg-icon icon-rvg-play rvg-hover-1"></span></a>
                        {else}
                             <a href="{$url}" data-rel="rvg-photo:{$key}"><span class="rvg-icon icon-rvg-search rvg-hover-1"></span></a>
                        {/if}
                    </span>
                </span>
            </span>
            {if $title?}
            <div class="rvg-gallery-item-caption">
                <span>{$title | truncate : 200 : ' ... ' : true : true}</span>
            </div>
            {/if}
        </div>
        {if $tags?}
        <div class="rvg-tags">
            <div class="rvg-tags-cloud">
                {foreach $tags as $tag}
                    <a href="#" class="rvg-tag js-rvg-tag {if $tag['active']?} rvg-tag-active {/if}">{$tag['tag']}</a>
                {/foreach}
            </div>
        </div>
        {/if}
    </div>
</div>




