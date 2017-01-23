<?php

namespace AppBundle\Manager;

use AppBundle\Repository\PersonRepository;
use AppBundle\Repository\RepositoryInterface;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PersonManager implements ManagerInterface
{

    /**
     * @var PersonRepository
     */
    protected $repository;


    public function __construct(RepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    public function find($id)
    {
        return $this->getRepository()->find($id);
    }

    public function create($entity)
    {
        $this->getRepository()->add($entity);
    }

    public function update($entity)
    {
        $this->getRepository()->update($entity);
    }

    public function delete($id)
    {
        return $this->getRepository()->remove($id);
    }

    public function flush()
    {
        $this->getRepository()->flush();
    }

    /**
     * @return PersonRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    public function setRepository(RepositoryInterface $repository)
    {
        $this->repository = $repository;

        return $this;
    }
}
