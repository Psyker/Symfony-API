<?php

namespace TagBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use TagBundle\Entity\Tag;

class TagsTransformer implements DataTransformerInterface
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
     * @param array $value
     * @return string
     */
    public function transform($value): string
    {
        return implode(',', $value);
    }

    /**
     * @param string $string
     * @return array
     */
    public function reverseTransform($string): array
    {
        $names = array_unique(array_filter(array_map('trim', explode(',', $string))));
        $tags = $this->manager->getRepository('TagBundle:Tag')->findBy(['name' => $names]);
        $newNames= array_diff($names, $tags);
        foreach ($newNames as $name) {
            $tag = new Tag();
            $tag->setName($name);
            $tags[] = $tag;
        }

        return $tags;
    }
}