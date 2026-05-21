{extends file="layouts/base.tpl"}

{block name=title}404 — Blog{/block}

{block name=content}
    <section class="error-page">
        <h1 class="error-page__code">404</h1>
        <p class="error-page__message">Страница не найдена.</p>
        <p><a href="{$base_url}/" class="btn btn--primary">На главную</a></p>
    </section>
{/block}
