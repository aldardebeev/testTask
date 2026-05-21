<?php

declare(strict_types=1);

namespace App\Repository;

use PDO;

final class ArticleRepository
{
    public function __construct(
        private readonly PDO $pdo,
    ) {
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function findByCategoryPaginated(
        int $categoryId,
        string $sort,
        int $page,
        int $perPage,
    ): array {
        $offset = max(0, ($page - 1) * $perPage);
        $orderBy = $this->resolveOrderBy($sort);

        $stmt = $this->pdo->prepare(
            "SELECT DISTINCT a.id, a.slug, a.title, a.description, a.image, a.views_count, a.published_at
             FROM articles a
             INNER JOIN article_categories ac ON ac.article_id = a.id
             WHERE ac.category_id = :category_id
             ORDER BY $orderBy
             LIMIT :limit OFFSET :offset",
        );
        $stmt->bindValue('category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function countByCategory(int $categoryId): int
    {
        $stmt = $this->pdo->prepare(
            'SELECT COUNT(DISTINCT a.id)
             FROM articles a
             INNER JOIN article_categories ac ON ac.article_id = a.id
             WHERE ac.category_id = :category_id',
        );
        $stmt->execute(['category_id' => $categoryId]);

        return (int) $stmt->fetchColumn();
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, slug, title, description, content, image, views_count, published_at, created_at
             FROM articles
             WHERE slug = :slug
             LIMIT 1',
        );
        $stmt->execute(['slug' => $slug]);
        $article = $stmt->fetch();

        if ($article === false) {
            return null;
        }

        $stmt = $this->pdo->prepare(
            'SELECT c.id, c.name, c.slug
             FROM categories c
             INNER JOIN article_categories ac ON ac.category_id = c.id
             WHERE ac.article_id = :article_id
             ORDER BY c.name ASC',
        );
        $stmt->execute(['article_id' => (int) $article['id']]);
        $article['categories'] = $stmt->fetchAll();

        return $article;
    }

    public function incrementViews(int $articleId): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE articles SET views_count = views_count + 1 WHERE id = :id',
        );
        $stmt->execute(['id' => $articleId]);
    }

    /**
     * @param list<int> $categoryIds
     *
     * @return list<array<string, mixed>>
     */
    public function findSimilar(int $articleId, array $categoryIds, int $limit = 3): array
    {
        if ($categoryIds === []) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));

        $sql = "SELECT DISTINCT a.id, a.slug, a.title, a.description, a.image, a.views_count, a.published_at
                FROM articles a
                INNER JOIN article_categories ac ON ac.article_id = a.id
                WHERE ac.category_id IN ($placeholders)
                  AND a.id != ?
                ORDER BY a.views_count DESC, a.published_at DESC
                LIMIT ?";

        $stmt = $this->pdo->prepare($sql);

        $position = 1;
        foreach ($categoryIds as $categoryId) {
            $stmt->bindValue($position++, $categoryId, PDO::PARAM_INT);
        }
        $stmt->bindValue($position++, $articleId, PDO::PARAM_INT);
        $stmt->bindValue($position, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    private function resolveOrderBy(string $sort): string
    {
        return match ($sort) {
            'views' => 'a.views_count DESC, a.published_at DESC',
            default => 'a.published_at DESC',
        };
    }
}
