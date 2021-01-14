<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use Exception;

class ApplicationController extends Controller
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
                'data' => Application::all()
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
    public function store(ApplicationRequest $request)
    {
        try {
            $application = Application::create($request->all());
            return response()->json([
                'data' => $application
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApplicationRequest $request, $id)
    {
        try {
            $application = Application::findOrFail($id);
            $application->fill($request->all());
            $application->save();
            return response()->json(
                ['data' => $application]
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
            Application::destroy($id);
            return response()->json();
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                500
            );
        }
    }
}
