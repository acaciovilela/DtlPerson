<?php

namespace DtlPerson\Form\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use DtlPerson\Form\Fieldset\Legal;

class LegalForm extends AbstractHelper {

    public function __invoke(Legal $legal) {

        if (!is_object($legal) || !($legal instanceof Legal)) {
            throw new \Laminas\View\Exception\RuntimeException(
            sprintf('%s is not valid instance of Legal fieldset.'));
        }

        return $this->view->render('dtl-person/legal', array(
                    'legal' => $legal
        ));
    }

}
