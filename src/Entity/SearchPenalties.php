<?php
namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
// use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;

class SearchPenalties
{
    /**
     * @Assert\NotBlank
     *
     */
    private $identifyType = 1;


    /**
     * @Recaptcha\IsTrueV3
     */
    // public $recaptcha;

    /**
     * @return mixed
     */
    // public function getRecaptcha()
    // {
    //     return $this->recaptcha;
    // }

    /**
     * @param mixed $recaptcha
     * @return SearchPenalties
     */
    // public function setRecaptcha($recaptcha)
    // {
    //     $this->recaptcha = $recaptcha;
    //     return $this;
    // }

    /**
     * @Assert\NotBlank
     *
     */
    private $identify;

    /**
     * @return mixed
     */
    public function getIdentifyType()
    {
        return $this->identifyType;
    }

    /**
     * @param mixed $identifyType
     * @return searchPenalties
     */
    public function setIdentifyType($identifyType)
    {
        $this->identifyType = $identifyType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdentify()
    {
        return $this->identify;
    }

    /**
     * @param mixed $identify
     * @return searchPenalties
     */
    public function setIdentify($identify)
    {
        $this->identify = $identify;
        return $this;
    }

      /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        $identityType = $this->getIdentifyType();
        if($identityType == 1){
            $validCIN =  preg_match("#^[0-9]{6}#", $this->getIdentify());
            if(strlen($this->getIdentify()) != 8 or !$validCIN  ){
                $message = 'Numéro de la Carte d\'Identité National saisi est incorrect.';
                $context->buildViolation($message)
                ->atPath('identify')
                ->addViolation();
            }
        } 
        
        if($identityType == 2){
            if(strlen($this->getIdentify()) != 15 ){

                $message = 'Numéro de la Carte de Séjour saisi est incorrect.';
                $context->buildViolation($message)
                ->atPath('identify')
                ->addViolation();
            }
        }
        
       
    }



}