<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Ref')
            ->add('Title')
            ->add('PublicationDate', DateType::class, [
                'format' => 'yyyy-MM-dd',
            ])
            ->add('Published')
            ->add('Category' ,ChoiceType ::class,[
                'choices' => [
                    'Sciences-Fiction' => 'sciences-fiction',
                    'Mystery' => 'mystery',
                    'Autobiography' => 'autobiography',
                ]
            ])
            ->add('Author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
