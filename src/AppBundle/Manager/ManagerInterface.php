<?php

namespace AppBundle\Manager;


use AppBundle\Repository\RepositoryInterface;

interface ManagerInterface {

    public function __construct(RepositoryInterface $repository);

    public function find($id);

    public function create($entity);

    public function update($entity);

    public function delete($id);

    public function flush();

    public function getRepository();

    public function setRepository(RepositoryInterface $repository);

}