<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageTextUpdateRequest;
use App\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PageTextController extends Controller
{
    /**
     * @return View
     */
    public function edit(): View
    {
        $page = auth()->user()->getEditablePage();

        return view('page-texts.edit', compact('page'));
    }

    /**
     * @param Page                  $page
     * @param PageTextUpdateRequest $request
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(PageTextUpdateRequest $request, Page $page): RedirectResponse
    {
        DB::beginTransaction();

        collect(request('pageTexts'))->each(function ($value, $key) use ($page) {
            $page->pageTexts()->where('key', $key)->update(['value' => $value]);
        });

        DB::commit();

        return redirect()->back()->with('success', 'Changes successfully saved.');
    }
}
