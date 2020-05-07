<?php

namespace DtlPerson\Form\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use DtlPerson\Form\Fieldset\Person;

class PersonForm extends AbstractHelper {

    public function __invoke(Person $personForm) {

        if (!is_object($personForm) || !($personForm instanceof Person)) {
            throw new \Laminas\View\Exception\RuntimeException(
            sprintf('%s is not valid instance of Person fieldset.'));
        }

        return $this->view->render('dtl-person/person', array(
                    'person' => $personForm
        ));
    }

}
