<?php

namespace App\Form;

use App\Entity\Link;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LinksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('link', Type\TextType::class, [
                "label" => false,
                "attr" => [
                    "class" => "form-control mr-1",
                    "placeholder" => "Link"
                ]
            ])
            ->add('tags', Type\TextType::class, [
                "label" => false,
                "attr" => [
                    "class" => "form-control mr-1",
                    "placeholder" => "Tags"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Link::class,
        ]);
    }
}
