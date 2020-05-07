<?php

namespace DtlPerson\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Form\Fieldset;
use DtlPerson\Entity\Legal as LegalEntity;
use DtlBase\Validator\Cnpj;

class Legal extends Fieldset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        
        parent::__construct('legal');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new LegalEntity());

        $this->add(array(
            'name' => 'id',
            'type' => 'Laminas\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'cnpj',
            'type' => 'Laminas\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'CNPJ',
                'class' => 'form-control  cnpj',
            ),
            'options' => array(
                'label' => 'CNPJ'
            ),
        ));

        $this->add(array(
            'name' => 'subscription',
            'type' => 'Laminas\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Inscrição Estadual',
                'class' => 'form-control ',
            ),
            'options' => array(
                'label' => 'Inscrição Estadual'
            ),
        ));

        $this->add(array(
            'name' => 'representativeName',
            'type' => 'Laminas\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Nome do Representante',
                'class' => 'form-control ',
            ),
            'options' => array(
                'label' => 'Nome do Repres.'
            ),
        ));

        $this->add(array(
            'name' => 'representativePhone',
            'type' => 'Laminas\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Telefone',
                'class' => 'form-control  phone',
            ),
            'options' => array(
                'label' => 'Tel. do Repres.'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'cnpj' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Digits'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
                'validators' => array(
                    new Cnpj(),
                ),
            ),
            'subscription' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Digits'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
            ),
            'representativeName' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Alpha'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
            ),
            'representativePhone' => array(
                'required' => false,
                'filters' => array(
                    array('name' => 'Digits'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
            ),
        );
    }
}
