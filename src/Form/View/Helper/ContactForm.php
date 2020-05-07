<?php

namespace DtlPerson\Form\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use DtlPerson\Form\Fieldset\Contact;

class ContactForm extends AbstractHelper {

    public function __invoke(Contact $contact) {

        if (!is_object($contact) || !($contact instanceof Contact)) {
            throw new \Laminas\View\Exception\RuntimeException(
            sprintf('%s is not valid instance of Contact fieldset.'));
        }

        return $this->view->render('dtl-person/contact', array(
                    'contact' => $contact
        ));
    }

}
