<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class ProvinceController extends Controller
{
    public function index(){

        return view('lms.admin.location.province.index');

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData(){

        $allProvinces = Cache::tags(['GET_PROVINCE_LIST'])->remember('GET_PROVINCE_LIST', 120,

            function () {

                return Province::get();

        });

        return response()->json(['provinces' => $allProvinces])->setStatusCode(200);

    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {

        $provinces = Province::select([
            'provinces.id',
            'provinces.name',
            \DB::raw('count(cantons.province_id) as count'),
//            'provinces.created_at',
//            'provinces.updated_at'
        ])->join('cantons','cantons.province_id', '=' ,'provinces.id')
            ->groupBy('cantons.province_id');

        return Datatables::of($provinces)
            ->editColumn('action', 'lms.admin.location.province.action')
            ->make(true);

    }


}
