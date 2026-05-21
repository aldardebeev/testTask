{extends file="layouts/base.tpl"}

{block name=title}{$article.title|escape} — Blog{/block}

{block name=meta}
    <meta name="description" content="{$article.description|escape}">
{/block}

{block name=breadcrumbs}
    {include file="partials/breadcrumbs.tpl" breadcrumbs=[
        ['label' => 'Главная', 'url' => "{$base_url}/"],
        ['label' => $article.title, 'url' => null]
    ]}
{/block}

{block name=content}
    <article class="article-full">
        {if $article.image}
            <img src="{$article.image|escape}" alt="{$article.title|escape}" class="article-full__image">
        {/if}

        <header class="article-full__header">
            <h1 class="article-full__title">{$article.title|escape}</h1>
            <p class="article-full__meta">
                <time datetime="{$article.published_at|escape}">{$article.published_at|date_format:"%d.%m.%Y %H:%M"}</time>
                <span class="article-full__views">{$article.views_count|escape} просмотров</span>
            </p>
        </header>

        {if $article.categories|@count > 0}
            <p class="article-full__categories">
                <span class="article-full__categories-label">Категории:</span>
                {foreach $article.categories as $category name=catLoop}
                    <a href="{$base_url}/category/{$category.slug|escape:'url'}">{$category.name|escape}</a>{if !$smarty.foreach.catLoop.last}, {/if}
                {/foreach}
            </p>
        {/if}

        <p class="article-full__description">{$article.description|escape}</p>

        <div class="article-full__content">
            {$article.content|nl2br}
        </div>
    </article>

    {include file="partials/similar_articles.tpl"}
{/block}
