<?php
namespace TagBundle\Form;
use Doctrine\Common\Persistence\ObjectManager;
use TagBundle\Form\DataTransformer\TagsTransformer;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class TagType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    private $manager;
    /**
     * TagsTransformer constructor.
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addModelTransformer(new CollectionToArrayTransformer(), true)
            ->addModelTransformer(new TagsTransformer($this->manager), true);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('attr', [
                'class' => 'tag-input'
            ])
            ->setDefault('required', false);
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tagbundle_tag';
    }
    public function getParent()
    {
        return TextType::class;
    }
}