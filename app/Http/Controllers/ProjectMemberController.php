<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Services\ProjectMemberService;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class ProjectMemberController extends Controller
{
    private $service;

    public function __construct(ProjectMemberService $service)
    {
        $this->service = $service;
    }


    public function index($id)
    {
        return $this->service->find($id);
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id, $memberId)
    {
        return $this->service->findWhere($id, $memberId);
    }

    public function update(Request $request, $projectId, $memberId)
    {
        return $this->service->update($request->all(), $projectId, $memberId);
    }

    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
