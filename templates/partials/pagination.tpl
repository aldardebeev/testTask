{if $totalPages > 1}
    <nav class="pagination" aria-label="Пагинация">
        {if $currentPage > 1}
            <a class="pagination__link" href="{$paginationBase|escape}?sort={$sort|escape}&amp;page={$currentPage - 1}">← Назад</a>
        {/if}

        {section name=pages loop=$totalPages}
            {assign var=pageNum value=$smarty.section.pages.index + 1}
            {if $pageNum == $currentPage}
                <span class="pagination__current" aria-current="page">{$pageNum|escape}</span>
            {else}
                <a class="pagination__link" href="{$paginationBase|escape}?sort={$sort|escape}&amp;page={$pageNum|escape}">{$pageNum|escape}</a>
            {/if}
        {/section}

        {if $currentPage < $totalPages}
            <a class="pagination__link" href="{$paginationBase|escape}?sort={$sort|escape}&amp;page={$currentPage + 1}">Вперёд →</a>
        {/if}
    </nav>
{/if}
