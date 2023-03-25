<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\Validator\Constraints as Assert;


class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			-> add('reference', TextType::class, array(
				'required' => false,
				'constraints' => array(
					new Assert\NotBlank(array(
						'message' => 'Attention, veuillez saisir ce champs'
					)),
					new Assert\Length(array(
						'min' => 3,
						'max' => 15,
						'minMessage' => 'Attention, veuillez saisir 3 caractères mini',
						'maxMessage' => 'Attention, veuillez saisir 15 caractères max'
					)),
					new Assert\Regex(array(
						'pattern' => '/^[a-zA-Z-_0-9]+$/',
						'message' => 'Veuillez entrer des caractères conformes (a à Z, et 0 à 9)'
					)),
				),
			))


			-> add('categorie', TextType::class, array(
				'required' => false,
				'constraints' => array(
					new Assert\NotBlank(array(
						'message' => ''
					)),
					new Assert\Length(array(
						'min' => 3,
						'max' => 30,
						'minMessage' => '' ,
						'minMessage' => ''
					)),
				),
			))
			-> add('titre', TextType::class, array(
				'required' => false,
			))
			-> add('description', TextareaType::class, array(
				'required' => false,
			))
			-> add('couleur', TextType::class, array(
				'required' => false,
			))


			-> add('taille', ChoiceType::class, array(
				'choices' => array(
					'S' => 's',
					'M' => 'm',
					'L' => 'l',
					'XL' => 'xl',
					'2XL' => '2xl',
					'3XL' => '3xl'
				),
			))
			-> add('sexe', ChoiceType::class, array(
				'choices' => array(
					'Homme' => 'm',
					'Femme' => 'f',
					'Mixte' => 'mixte'
				),
			))
			-> add('file', FileType::class, array(
        'required' => false,
      ))


			-> add('prix', MoneyType::class, array(
				'required' => false,
			))


			-> add('stock', IntegerType::class, array(
				'required' => false,
				'constraints' => array(
					new Assert\NotBlank(),
					new Assert\Type(array(
						'type' => 'integer',
						'message' => 'ceci doit être un nombre'
					)),
				),
				'attr' => array(
					'class' => 'custom-class',
					'placeholder' => 'Le stock',
					'id' => 'champsStock'
				),
			))

			-> add('Valider', SubmitType::class, array(
				'attr' => array(
					'class' => 'btn btn-success',
				),
			));

    }


		/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_produit';
    }


}
