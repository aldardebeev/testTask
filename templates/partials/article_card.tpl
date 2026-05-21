<article class="article-card">
    {if $article.image}
        <a href="{$base_url}/article/{$article.slug|escape:'url'}" class="article-card__image-link">
            <img src="{$article.image|escape}" alt="{$article.title|escape}" class="article-card__image" loading="lazy">
        </a>
    {/if}
    <div class="article-card__body">
        <h3 class="article-card__title">
            <a href="{$base_url}/article/{$article.slug|escape:'url'}">{$article.title|escape}</a>
        </h3>
        <p class="article-card__description">{$article.description|escape}</p>
        <p class="article-card__meta">
            <time datetime="{$article.published_at|escape}">{$article.published_at|date_format:"%d.%m.%Y"}</time>
            <span class="article-card__views">{$article.views_count|escape} просмотров</span>
        </p>
    </div>
</article>
