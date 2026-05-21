{extends file="layouts/base.tpl"}

{block name=title}Главная — Blog{/block}

{block name=content}
    <header class="page-header">
        <h1 class="page-header__title">Блог</h1>
        <p class="page-header__lead">Последние публикации по категориям</p>
    </header>

    {foreach $categories as $category}
        <section class="category-section">
            <header class="category-section__header">
                <h2 class="category-section__title">
                    <a href="{$base_url}/category/{$category.slug|escape:'url'}">{$category.name|escape}</a>
                </h2>
                <p class="category-section__description">{$category.description|escape}</p>
            </header>

            {if $category.articles|@count > 0}
                <div class="articles-grid">
                    {foreach $category.articles as $article}
                        {include file="partials/article_card.tpl" article=$article}
                    {/foreach}
                </div>

                <p class="category-section__more">
                    <a href="{$base_url}/category/{$category.slug|escape:'url'}" class="btn btn--primary">Все статьи</a>
                </p>
            {/if}
        </section>
    {foreachelse}
        <p class="empty-state">Статьи пока не опубликованы.</p>
    {/foreach}
{/block}
