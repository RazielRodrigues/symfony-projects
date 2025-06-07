<?php

namespace App\Service;

use Symfony\Component\Form\FormInterface;

class CheckAmountPeople {

    public function checkPeople(FormInterface $form): bool {

        $amountPeople = $form->get('number_kids')->getData() + 1; // Because the person which is going is already counting
        if ($form->get('plus_one')->getData() === true) {
            $amountPeople += 1;
        }
        $vegetarians = $form->get('number_vegetarians')->getData();

        return $vegetarians > $amountPeople;
    }

}
