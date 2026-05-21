<?php

declare(strict_types=1);

namespace App\Repository;

use PDO;

final class CategoryRepository
{
    public function __construct(
        private readonly PDO $pdo,
    ) {
    }

    /**
     * Категории, в которых есть статьи, с N последними постами по дате публикации.
     *
     * @return list<array<string, mixed>>
     */
    public function findAllWithRecentArticles(int $limit = 3): array
    {
        $stmt = $this->pdo->query(
            'SELECT DISTINCT c.id, c.name, c.slug, c.description, c.created_at
             FROM categories c
             INNER JOIN article_categories ac ON ac.category_id = c.id
             ORDER BY c.name ASC',
        );

        $categories = $stmt->fetchAll();
        if ($categories === []) {
            return [];
        }

        $categoryIds = array_column($categories, 'id');
        $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));

        $stmt = $this->pdo->prepare(
            "SELECT a.id, a.slug, a.title, a.description, a.image, a.views_count, a.published_at,
                    ac.category_id
             FROM articles a
             INNER JOIN article_categories ac ON ac.article_id = a.id
             WHERE ac.category_id IN ($placeholders)
             ORDER BY ac.category_id ASC, a.published_at DESC",
        );
        $stmt->execute($categoryIds);
        $rows = $stmt->fetchAll();

        $articlesByCategory = [];
        foreach ($rows as $row) {
            $categoryId = (int) $row['category_id'];
            if (!isset($articlesByCategory[$categoryId])) {
                $articlesByCategory[$categoryId] = [];
            }
            if (count($articlesByCategory[$categoryId]) >= $limit) {
                continue;
            }
            unset($row['category_id']);
            $articlesByCategory[$categoryId][] = $row;
        }

        foreach ($categories as &$category) {
            $categoryId = (int) $category['id'];
            $category['articles'] = $articlesByCategory[$categoryId] ?? [];
        }
        unset($category);

        return $categories;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, name, slug, description, created_at
             FROM categories
             WHERE slug = :slug
             LIMIT 1',
        );
        $stmt->execute(['slug' => $slug]);
        $category = $stmt->fetch();

        return $category !== false ? $category : null;
    }

    public function getIdBySlug(string $slug): ?int
    {
        $stmt = $this->pdo->prepare(
            'SELECT id FROM categories WHERE slug = :slug LIMIT 1',
        );
        $stmt->execute(['slug' => $slug]);
        $id = $stmt->fetchColumn();

        return $id !== false ? (int) $id : null;
    }
}
