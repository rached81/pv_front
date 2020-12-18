<?php
namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;

class SearchPenalties
{
    private $identifyType = 1;


    /**
     * @Recaptcha\IsTrueV3
     */
    public $recaptcha;

    /**
     * @return mixed
     */
    public function getRecaptcha()
    {
        return $this->recaptcha;
    }

    /**
     * @param mixed $recaptcha
     * @return SearchPenalties
     */
    public function setRecaptcha($recaptcha)
    {
        $this->recaptcha = $recaptcha;
        return $this;
    }

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=3)
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



}