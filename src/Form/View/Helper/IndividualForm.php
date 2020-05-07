<?php

namespace DtlPerson\Form\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use DtlPerson\Form\Fieldset\Individual;

class IndividualForm extends AbstractHelper {

    public function __invoke(Individual $individual) {

        if (!is_object($individual) || !($individual instanceof Individual)) {
            throw new \Laminas\View\Exception\RuntimeException(
            sprintf('%s is not valid instance of Individual fieldset.'));
        }

        return $this->view->render('dtl-person/individual', array(
                    'individual' => $individual
        ));
    }

}
