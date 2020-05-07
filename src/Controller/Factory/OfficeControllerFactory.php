<?php

namespace DtlPerson\Controller\Factory;

use DtlPerson\Controller\OfficeController;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use DtlPerson\Entity\Office;

class OfficeControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, $options = null) {
        $controller = new OfficeController();
        $controller->setEntityManager($container->get(EntityManager::class));
        $controller->setRepository(Office::class);
        return $controller;
    }

}
