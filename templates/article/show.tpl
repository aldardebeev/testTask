{extends file="layouts/base.tpl"}

{block name=title}Статья — Blog{/block}

{block name=content}
    <h1>Статья</h1>
    <p>Slug: {$slug|escape}</p>
{/block}
