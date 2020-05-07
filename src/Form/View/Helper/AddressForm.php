<?php

namespace DtlPerson\Form\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use DtlPerson\Form\Fieldset\Address;

class AddressForm extends AbstractHelper {

    public function __invoke(Address $address) {

        if (!is_object($address) || !($address instanceof Address)) {
            throw new \Laminas\View\Exception\RuntimeException(
                    sprintf('%s is not valid instance of Address fieldset.'));
        }
        
        return $this->view->render('dtl-person/address', array(
            'address' => $address
        ));
    }
}
