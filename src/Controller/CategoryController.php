<?php

declare(strict_types=1);

namespace App\Controller;

final class CategoryController extends Controller
{
    public function show(string $slug): void
    {
        $category = $this->categoryRepository->findBySlug($slug);
        if ($category === null) {
            $this->abortNotFound();
        }

        $sort = $_GET['sort'] ?? 'date';
        if (!in_array($sort, ['date', 'views'], true)) {
            $sort = 'date';
        }

        $perPage = (int) ($this->config['pagination']['per_page'] ?? 10);
        $totalItems = $this->articleRepository->countByCategory((int) $category['id']);
        $totalPages = max(1, (int) ceil($totalItems / $perPage));

        $page = max(1, (int) ($_GET['page'] ?? 1));
        if ($page > $totalPages) {
            $page = $totalPages;
        }

        $articles = $this->articleRepository->findByCategoryPaginated(
            (int) $category['id'],
            $sort,
            $page,
            $perPage,
        );

        $baseUrl = ($this->config['base_url'] ?? '') . '/category/' . $category['slug'];

        $this->smarty->assign([
            'category' => $category,
            'articles' => $articles,
            'sort' => $sort,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalItems' => $totalItems,
            'paginationBase' => $baseUrl,
        ]);
        $this->render('category/show.tpl');
    }
}
