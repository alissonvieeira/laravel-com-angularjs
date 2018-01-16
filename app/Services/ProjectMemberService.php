<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Validators\ProjectMemberValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectMemberService
{
    /**
     * @var ProjectMemberRepository
     */
    protected $repository;
    /**
     * @var ProjectMemberValidator
     */
    protected $validator;

    public function __construct(ProjectMemberRepository $repository, ProjectMemberValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function index($id)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id]);
        }catch (ModelNotFoundException $e){
            return [
                'message' => 'Ocorreu um erro ao buscar projeto'
            ];
        }
    }

    public function find($id, $memberId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id, 'id' => $memberId]);
        }catch (ModelNotFoundException $e){
            return [
                'message' => 'Tarefa não encontrada'
            ];
        }
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e){
            return [
                'error' => true,
                'message'=> $e->getMessageBag()
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'Projeto não encontrado, não pode ser atualizado.'
            ];
        }
    }

    public function delete($id)
    {
        try {
            return $this->repository->delete($id);
        } catch (ModelNotFoundException $e){
            return [
                'error' => true,
                'message'=> $e->getMessage()
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'Ocorreu algum erro ao excluir o membro do projeto'
            ];
        }
    }
}