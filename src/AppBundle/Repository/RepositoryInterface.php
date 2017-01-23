<?php

namespace AppBundle\Repository;


interface RepositoryInterface {

    public function add($object);

    public function update($object);

    public function remove($object);

    public function flush();

}