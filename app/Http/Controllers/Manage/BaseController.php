<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
	protected function validator(array $data)
	{
		return Validator::make($data, $this->model->rules());
	}

    /**
     * Return array
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
	protected function requestParams(Request $request)
	{
        $data = $request->all();
        
        return snakeCaseKeys($data);
	}

	/**
	 * Custom operations
	 */
	protected function afterCommit($data, Request $request)
    {
        //
	}
    
    /**
     * Return JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	protected function responseJSON($data)
	{
        $className = class_basename($this->model);

		$key = is_array($data)
            ? str_plural($className)
            : $className;

		return response()->json([
            $key => $data,
        ]);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
		$models = $this->model::all();

		return $this->responseJSON($models);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->model::findOrFail($id);

		return $this->responseJSON($model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(Request $request)
    {
		$params = $this->requestParams($request);

        // Validation
		$validator = $this->validator($params)
            ->validate();

        if ($request->filled('id')) {
			$model = $this->model::findOrFail($request->input('id'));
			$model->update($params);
		} else {
			$model = $this->model::create($params);
			$model = $this->model::findOrFail($model->id);
		}

		$this->afterCommit($model, $request);

		return $this->responseJSON($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->model::findOrFail($id);
        $data->delete();

        return $this->responseJSON($data);
    }
}
