<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageSubmitExportRequest;
use App\Http\Requests\PageSubmitStoreRequest;
use App\Page;
use App\PageSubmit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class PageSubmitController extends Controller
{
    /**
     * @param PageSubmitStoreRequest $request
     * @param Page                   $page
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function store(PageSubmitStoreRequest $request, Page $page): JsonResponse
    {
        DB::beginTransaction();

        $pageSubmit = $page->pageSubmits()->create();
        foreach ($page->pageKeys as $pageKey) {
            $pageSubmit->pageSubmitValues()->create([
                'key' => $pageKey->key,
                'value' => request('formData')[$pageKey->key] ?? '',
            ]);
        }

        DB::commit();

        return new JsonResponse([], \Illuminate\Http\Response::HTTP_ACCEPTED);
    }

    /**
     * @return View
     */
    public function showExportForm(): View
    {
        $page = auth()->user()->getEditablePage();
        $defaultFilename = $page->name . "_" . date('Ymd_His');

        return view('page-submits.export', compact('page', 'defaultFilename'));
    }

    /**
     * @param Page                    $page
     * @param PageSubmitExportRequest $request
     *
     * @return mixed
     */
    public function export(PageSubmitExportRequest $request, Page $page)
    {
        return Excel::create(request('filename'), function($excel) use ($page) {
            $excel->sheet('Spreadsheet', function($sheet) use ($page) {
                $sheet->fromArray(
                    $page->pageSubmits->map(function (PageSubmit $pageSubmit) {
                        $array = [
                            'Timestamp' => $pageSubmit->created_at,
                        ];

                        foreach ($pageSubmit->page->pageKeys()->orderBy('id')->get() as $pageKey) {
                            $array[$pageKey->name] = $pageSubmit->pageSubmitValues->where('key', $pageKey->key)->first()->value ?? '';
                        }

                        return $array;
                    })
                );

                $sheet->row(1, function($cells) {
                    $cells->setFontWeight('bold');
                });
            });
        })->download();
    }
}
