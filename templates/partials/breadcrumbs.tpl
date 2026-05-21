<nav class="breadcrumbs" aria-label="Хлебные крошки">
    <ol class="breadcrumbs__list">
        {foreach $breadcrumbs as $item}
            <li class="breadcrumbs__item">
                {if $item.url}
                    <a href="{$item.url|escape}">{$item.label|escape}</a>
                {else}
                    <span aria-current="page">{$item.label|escape}</span>
                {/if}
            </li>
        {/foreach}
    </ol>
</nav>
