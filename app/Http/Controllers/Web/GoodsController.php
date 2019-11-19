<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{
    Auto_model,
    Auto_mark,
    Good,
    ViewCounter
};
use App\Calculation\PriceCalculation;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ViewCounter $viewCounter)
    {
        $viewNumbers = $viewCounter->createCookie();
        $subCategoryId = $request->route('subCategory');
        $furtherSubCategoryId = $request->route('furtherSubCategory') != 0 ? $request->route('furtherSubCategory') : null;
        $modelId = $request->route('model');
        $model = Auto_model::find($modelId);
        $marks = Auto_mark::all();
        $relatedGoods = Good::where('id_model', $modelId)
            ->where('id_sub_category', $subCategoryId)
            ->where('id_further_sub_category', $furtherSubCategoryId)
            ->get();
        $priceCalculation = new PriceCalculation();
        $relatedGoods = $priceCalculation->calculate($relatedGoods);
        return view ('pages.goods-page', compact('model','marks', 'relatedGoods', 'viewNumbers'));
    }

    /**
     * Search between goods
     *
     * @param Request $request
     * @param ViewCounter $viewCounter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request, ViewCounter $viewCounter)
    {
        $searchKey = $request->searchForGoods;
        $viewNumbers = $viewCounter->createCookie();
        $models = Auto_model::all();
        $marks = Auto_mark::all();
        $matchGoods = Good::where('name_good','LIKE','%'.$searchKey.'%')
            ->orWhere('desc_good','LIKE','%'.$searchKey.'%')
            ->paginate(12);
        $priceCalculation = new PriceCalculation();
        $matchGoods = $priceCalculation->calculate($matchGoods);
        return view('pages.search', compact('matchGoods', 'searchKey', 'viewNumbers', 'models', 'marks'));
    }
}
