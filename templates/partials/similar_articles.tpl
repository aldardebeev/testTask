{if $similarArticles|@count > 0}
    <section class="similar-articles">
        <h2 class="similar-articles__title">Похожие статьи</h2>
        <div class="articles-grid">
            {foreach $similarArticles as $similarArticle}
                {include file="partials/article_card.tpl" article=$similarArticle}
            {/foreach}
        </div>
    </section>
{/if}
