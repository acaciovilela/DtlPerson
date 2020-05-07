<?php

namespace DtlPerson\Controller\Factory;

use DtlPerson\Controller\OccupationController;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use DtlPerson\Entity\Occupation;

class OccupationControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, $options = null) {
        $controller = new OccupationController();
        $controller->setEntityManager($container->get(EntityManager::class));
        $controller->setRepository(Occupation::class);
        return $controller;
    }

}
