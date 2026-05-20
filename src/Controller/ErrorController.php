<?php

declare(strict_types=1);

namespace App\Controller;

final class ErrorController extends Controller
{
    public function notFound(): never
    {
        http_response_code(404);
        $this->render('errors/404.tpl');
        exit;
    }
}
