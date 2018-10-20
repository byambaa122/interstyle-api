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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
	protected function validator(Request $request)
	{
		return Validator::make($request->all(), $this->model->rules($request->input('id')));
	}

    /**
     * Return array
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
	protected function requestParams(Request $request)
	{
        $params = $request->all();
        
        return $params;
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
	protected function responseJSON($data, $type = 'singular')
	{
        $className = class_basename($this->model);

		$key = $type === 'plural'
            ? str_plural($className)
            : $className;

		return response()->json([
            camel_case($key) => $data,
        ]);
	}

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        // Search input
		$search = $request->query('search');
		// Pagination page length
        $rowsPerPage = (int) $request->query('rowsPerPage', 25);
		// Sort column
        $sortBy = snake_case($request->query('sortBy', 'createdAt'));
		// Sort direction
        $direction = $request->query('direction', 'desc');

		$searchQuery = $this->model
            ->when($search, function ($query, $search) {
                return $query->search($search);
            })
            ->orderBy($sortBy, $direction);

        if ($rowsPerPage === -1) {
            $rowsPerPage = $searchQuery->count();
        }

		return response()->json($searchQuery->paginate($rowsPerPage));
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
        // Validate request
		$validator = $this->validator($request)
            ->validate();

		$params = snakeCaseKeys($this->requestParams($request));

        if ($request->filled('id')) {
			$model = $this->model::findOrFail($request->input('id'));
			$model->update($params);
		} else {
			$model = $this->model::create($params);
            $model->refresh();
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
