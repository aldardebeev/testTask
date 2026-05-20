<?php

declare(strict_types=1);

namespace App\Controller;

final class CategoryController extends Controller
{
    public function show(string $slug): void
    {
        $this->smarty->assign('slug', $slug);
        $this->render('category/show.tpl');
    }
}
