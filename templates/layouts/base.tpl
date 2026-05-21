<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{block name=title}Blog{/block}</title>
    {block name=meta}{/block}
    <link rel="stylesheet" href="{$base_url}/assets/css/main.css">
</head>
<body class="page">
    <header class="site-header">
        <div class="container site-header__inner">
            <a href="{$base_url}/" class="site-logo">Blog</a>
            <nav class="site-nav" aria-label="Основная навигация">
                <a href="{$base_url}/" class="site-nav__link">Главная</a>
            </nav>
        </div>
    </header>

    <main class="site-main">
        <div class="container">
            {block name=breadcrumbs}{/block}
            {block name=content}{/block}
        </div>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p class="site-footer__copy">&copy; {$smarty.now|date_format:"%Y"} Blog</p>
        </div>
    </footer>
</body>
</html>
