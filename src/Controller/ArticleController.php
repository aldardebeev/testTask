<?php

declare(strict_types=1);

namespace App\Controller;

final class ArticleController extends Controller
{
    public function show(string $slug): void
    {
        $article = $this->articleRepository->findBySlug($slug);
        if ($article === null) {
            $this->abortNotFound();
        }

        $this->articleRepository->incrementViews((int) $article['id']);
        $article['views_count'] = (int) $article['views_count'] + 1;

        $categoryIds = array_map(
            static fn (array $category): int => (int) $category['id'],
            $article['categories'],
        );

        $similarArticles = $this->articleRepository->findSimilar(
            (int) $article['id'],
            $categoryIds,
            3,
        );

        $this->smarty->assign([
            'article' => $article,
            'similarArticles' => $similarArticles,
        ]);
        $this->render('article/show.tpl');
    }
}
