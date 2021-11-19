<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsIdentity extends Constraint
{
    public $messageCIN = 'Numéro Carte d\'Identité non valide';


    public $messageCarte = 'Numéro Carte Séjour non valide';
}



?>