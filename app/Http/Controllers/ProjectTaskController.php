<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Services\ProjectTaskService;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class ProjectTaskController extends Controller
{
    /**
     * @var ProjectTaskService
     */
    private $service;

    public function __construct(ProjectTaskService $service)
    {
        $this->service = $service;
    }

    public function index($id)
    {
        return $this->service->index($id);
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id, $taskId)
    {
        return $this->service->find($id, $taskId);
    }

    public function update(Request $request, $id, $taskId)
    {
        return $this->service->update($request->all(), $taskId);
    }

    public function destroy($id, $taskId)
    {
        return $this->service->delete($taskId);
    }
}
