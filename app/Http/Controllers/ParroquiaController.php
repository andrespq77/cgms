<?php

namespace App\Http\Controllers;

use App\Parroquia;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ParroquiaController extends Controller
{
    public function index(){

        $title = 'Parroquia Management '.env('APP_NAME');
        return view('lms.admin.location.parroquia.index', ['title' => $title]);

    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {

        $parroquias = Parroquia::select([
            'parroquias.id as id',
            'provinces.id as province_id',
            'provinces.name as province_name',
            'cantons.id as canton_id',
            'cantons.name as canton_name',
            'parroquias.name as parroquia_name',
            ])
            ->leftJoin('cantons','parroquias.canton_id', '=' ,'cantons.id')
            ->leftJoin('provinces','cantons.province_id', '=' ,'provinces.id');

        return Datatables::of($parroquias)
            ->editColumn('action', 'lms.admin.location.parroquia.action')
            ->setRowId(function ($parroquias){
                return 'parroquia_id_'.$parroquias->id;
            })
            ->make(true);

    }

    /**
     * @todo require validation
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){

        $post = $request->all();

        $parroquia = new Parroquia();

        $parroquia->canton_id = $post['canton_id'];
        $parroquia->name        = $post['name'];
        $parroquia->save();

        return response()->json(['parroquia' => $parroquia])->setStatusCode(201);

    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){

        $post = $request->all();

        $parroquia = Parroquia::find($id);
        $parroquia->canton_id   = $post['canton_id'];
        $parroquia->name        = $post['name'];
        $parroquia->save();

        return response()->json(['parroquia' => $parroquia])->setStatusCode(200);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){

        $parroquia = Parroquia::findOrFail($id);

        $parroquia->delete();

        return response()->json()->setStatusCode(204);

    }


}
