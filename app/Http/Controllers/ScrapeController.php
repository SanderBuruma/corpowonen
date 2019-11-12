<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ParariusController;

class ScrapeController extends Controller
{
    static public function ScrapeAll()
    {
        try {
            ParariusController::ScrapeAll();
        } catch (Exception $e) {
            error_log("Pararius scraper failed:\n");
            error_log($e);
        }
    }
}
