{extends file="layouts/base.tpl"}

{block name=title}{$category.name|escape} — Blog{/block}

{block name=meta}
    <meta name="description" content="{$category.description|escape}">
{/block}

{block name=breadcrumbs}
    {include file="partials/breadcrumbs.tpl" breadcrumbs=[
        ['label' => 'Главная', 'url' => "{$base_url}/"],
        ['label' => $category.name, 'url' => null]
    ]}
{/block}

{block name=content}
    <header class="page-header">
        <h1 class="page-header__title">{$category.name|escape}</h1>
        <p class="page-header__lead">{$category.description|escape}</p>
    </header>

    <div class="sort-controls">
        <span class="sort-controls__label">Сортировка:</span>
        <a href="{$paginationBase|escape}?sort=date&amp;page=1"
           class="sort-controls__link {if $sort == 'date'}is-active{/if}">По дате</a>
        <a href="{$paginationBase|escape}?sort=views&amp;page=1"
           class="sort-controls__link {if $sort == 'views'}is-active{/if}">По просмотрам</a>
    </div>

    <p class="category-stats">Всего статей: {$totalItems|escape}</p>

    <div class="articles-list">
        {foreach $articles as $article}
            {include file="partials/article_card.tpl" article=$article}
        {foreachelse}
            <p class="empty-state">В этой категории пока нет статей.</p>
        {/foreach}
    </div>

    {include file="partials/pagination.tpl"}
{/block}
