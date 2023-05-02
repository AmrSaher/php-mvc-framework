<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\Models\User;
use App\Models\SignUp;
use App\Models\Invoice;

class HomeController {
    public function index(): View
    {
        return View::make('index');
    }
}