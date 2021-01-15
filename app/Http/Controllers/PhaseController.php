<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhaseRequest;
use App\Http\Requests\RangeDateRequest;
use App\Models\Phase;
use App\Models\PhaseRecord;
use Exception;

class PhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json([
                'data' => Phase::all()
            ]);
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                500
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhaseRequest $request)
    {
        try {
            return response()->json(
                ['data' => Phase::create($request->all())],
                201
            );
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                500
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhaseRequest $request, $id)
    {
        try {
            $phase = Phase::findOrFail($id);
            $phase->fill($request->all());
            $phase->save();
            return response()->json(
                ['data' => $phase]
            );
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Phase::destroy($id);
            return response()->json();
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                500
            );
        }
    }

    public function range(RangeDateRequest $request)
    {
        try {
            $startDate = date($request['start_date']);
            $finishDate = date($request['finish_date']);
            $records = PhaseRecord::whereBetween('created_at', [$startDate, $finishDate])->get()->groupBy('created_at');
            return response()->json([
                'data' => $records
            ], 200);
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                500
            );
        }
    }
}
