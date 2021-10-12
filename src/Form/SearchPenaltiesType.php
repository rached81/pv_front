<?php

namespace App\Form;

use App\Entity\SearchPenalties;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class SearchPenaltiesType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identifyType', ChoiceType::class, [ 
//                'label' => false,
                'choices'  => [ 'CIN' => 1 , 'Carte de Séjour' => 2],
                'expanded' => true,
                'multiple' => false,
                'translation_domain' => 'forms',
                ])
            ->add('identify', TextType::class, [ 'attr' => ['pattern' => '^[0-9]{8}', 'placeholder' => '8 Chiffres'], 'label' => false, 
                'required' => true, 'translation_domain' => 'forms']
                )
            // ->add('captcha', Recaptcha3Type::class, [
            //         // 'constraints' => new Recaptcha3(['message' => ' Please try again or contact with support and provide following code(s): {{ errorCodes }}']),
            //         'constraints' => new Recaptcha3(),
                 
            //         'action_name' => 'pv',
            //         // 'script_nonce_csp' => $nonceCSP,
            //     ])
                
                ;
 
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchPenalties::class,
            'translation_domain' => 'forms'
        ]);
    }
}
