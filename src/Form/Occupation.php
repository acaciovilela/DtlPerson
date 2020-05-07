<?php

namespace DtlPerson\Form;

use Laminas\Form\Form;
use Laminas\InputFilter\InputFilter;
use Doctrine\Laminas\Hydrator\DoctrineObject as DoctrineHydrator;
use DtlPerson\Entity\Occupation as OccupationEntity;

class Occupation extends Form {

    public function __construct($entityManager) {

        parent::__construct('occupation');

        $this->setAttribute('method', 'post')
                ->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new OccupationEntity())
                ->setInputFilter(new InputFilter());
        
        $occupation = new \DtlPerson\Form\Fieldset\Occupation($entityManager);
        $occupation->setUseAsBaseFieldset(true)
                ->setName('occupation');
        $this->add($occupation);
        
        $this->add(array(
            'type' => 'Laminas\Form\Element\Csrf',
            'name' => 'security'
        ));

        $this->add(array(
            'type' => 'Laminas\Form\Element\Submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-primary'
            )
        ));

        $this->add(array(
            'name' => 'cancel',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Cancel',
                'class' => 'btn btn-secondary',
                'onclick' => "javascript: history.back();",
            )
        ));
    }
}
