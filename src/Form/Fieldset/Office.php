<?php

namespace DtlPerson\Form\Fieldset;

use Doctrine\Laminas\Hydrator\DoctrineObject as DoctrineHydrator;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Form\Fieldset as LaminasFielset;
use DtlPerson\Entity\Office as OfficeEntity;

class Office extends LaminasFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('office');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new OfficeEntity());

        $this->add(array(
            'name' => 'id',
            'type' => 'Laminas\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'name',
            'type' => 'Laminas\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Cargo',
                'class' => 'form-control',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Cargo'
            )
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
