<?php

declare(strict_types=1);

namespace AppBundle\Form;

use AppBundle\Entity\Post;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostCreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add("title", TextType::class, array(
            "attr" => array(
                "class" => "form-control input-title",
            )))
            ->add("summary", TextareaType::class, array(
                "attr" => array(
                    "class" => "form-control input-summary",
                )
            ))
            ->add("content", CKEditorType::class, array())
            ->add("image", FileType::class, array(
                "attr" => array(
                    "class" => "form-control"
                )
            ))
            ->add("submit", SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                "data_class" => Post::class
            )
        );
    }
}