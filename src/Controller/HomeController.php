<?php

declare(strict_types=1);

namespace App\Controller;

final class HomeController extends Controller
{
    public function index(): void
    {
        $this->render('home/index.tpl');
    }
}
