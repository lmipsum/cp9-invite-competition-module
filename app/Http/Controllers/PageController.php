<?php

namespace App\Http\Controllers;

use App\Page;
use App\PageText;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * @param Page $page
     *
     * @return View
     */
    public function show(Page $page): View
    {
        $page->load('pageKeys');

        $pageTexts = $page->pageTexts->mapWithKeys(function (PageText $pageText) {
            return [$pageText->key => $pageText->value];
        });

        return view("templates.{$page->template}", compact('page', 'pageTexts'));
    }
}
