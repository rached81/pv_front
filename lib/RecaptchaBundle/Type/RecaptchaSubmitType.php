<?php
namespace Transtu\RecaptchaBundle\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecaptchaSubmitType extends AbstractType {

    public function configureOptions(OptionsResolverI $resolver)
    {
        $resolver->setDefault([
            'mapped' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return 'recaptcha_submit';
    }

    public function getParent()
    {
        return TextType::class;
    }
}