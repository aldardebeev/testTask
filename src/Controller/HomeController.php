<?php

declare(strict_types=1);

namespace App\Controller;

final class HomeController extends Controller
{
    public function index(): void
    {
        $categories = $this->categoryRepository->findAllWithRecentArticles(3);

        $this->smarty->assign('categories', $categories);
        $this->render('home/index.tpl');
    }
}
