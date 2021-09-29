<?php

namespace App\Form;

use App\Entity\SearchPenalties;
// use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
// use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrueV3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Transtu\RecaptchaBundle\Type\RecaptchaSubmitType;

class SearchPenaltiesType extends AbstractType
{
    /** @var FormBuilderInterface */
    private $recaptcha;

//    public function __construct(?FormBuilderInterface $recaptcha)
//    {
//        $this->recaptcha = $recaptcha;
//    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identifyType', ChoiceType::class, [
//                'label' => false,
                'choices'  => [ 'CIN' => 1, 'Carte de Séjour' => 2],
                'expanded' => true,
                'multiple' => false 
                ])
            ->add('identify', TextType::class, [ 'attr' => ['pattern' => '^[0-9]{8}', 'placeholder' => ' 8 chiffres'], 'label' => false, 
                'required' => true,]
                )
//             ->add('recaptcha', EWZRecaptchaType::class, array(
//                 'constraints' => array(
//                     new IsTrueV3()
//                 ),
// //                'action_name' => 'form',
//                 'attr' => array(
//                     'options' => array(
//                         'theme' => 'light',
//                         'type'  => 'image',
//                         'size'  => 'normal',
//                         'defer' => true,
//                         'async' => true,
//                     )
//                 )
            // ))
            ;
//            ->add('captcha', RecaptchaSubmitType::class, [ 'label'=>'Envoyer'])        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchPenalties::class,
        ]);
    }
}
