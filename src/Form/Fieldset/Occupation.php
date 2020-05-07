<?php

namespace DtlPerson\Form\Fieldset;

use Doctrine\Laminas\Hydrator\DoctrineObject as DoctrineHydrator;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Form\Fieldset as LaminasFielset;
use DtlPerson\Entity\Occupation as OccupationEntity;

class Occupation extends LaminasFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('occupation');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new OccupationEntity());

        $this->add(array(
            'name' => 'id',
            'type' => 'Laminas\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'name',
            'type' => 'Laminas\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Nome da Profissão',
                'class' => 'form-control input-sm',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Nome da Profissão'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'name' => array(
                'required' => true,
            ),
        );
    }

}
