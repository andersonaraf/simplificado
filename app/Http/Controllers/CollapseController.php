<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollapseRequest;
use App\Models\Collapse;
use Illuminate\Http\Request;

class CollapseController extends Controller
{
    //
    public function store(CollapseRequest $request)
    {
        try {
            \DB::beginTransaction();
            $collapse = new Collapse();
            $collapse->cargo_id = $request->cargo_id;
            $collapse->nome = mb_strtoupper($request->nomeCollapse);
            $collapse->save();
            \DB::commit();
            return redirect()->route('configurar.cargo.show', $request->cargo_id);
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with([
                'type' => 'error',
                'msg' => 'Algo deu errado. ' . $exception->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction();
            $collapse = Collapse::findOrFail($id);
            $collapse->nome = $request->nomeCollapse;
            $collapse->save();
            \DB::commit();
            return response()->json(true);
        } catch (\Exception $exception) {
            \DB::rollBack();
            return response()->json('Ocorreu um problema: '. $exception->getMessage(), '405');
        }

    }

    public function destroy()
    {

    }
}
