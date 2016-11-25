<?php

namespace ServiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MachineType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('client')
                ->add('complaintNumber')
                ->add('complaintDescription')
                ->add('machineDescription')
                ->add('repairDescription')
                ->add('brand')
                ->add('type')
                ->add('modelMachine')
                ->add('repairStatus', EntityType::class, array(
                    'class' => 'ServiceBundle:Repair_status',
                    'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                    ->orderBy('u.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ServiceBundle\Entity\Machine'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'servicebundle_machine';
    }


}
