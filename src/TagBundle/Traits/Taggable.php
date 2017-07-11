<?php
namespace TagBundle\Traits;
use TagBundle\Entity\Tag;
use Doctrine\ORM\Mapping as ORM;
trait Taggable
{
    /**
     * @var array
     * @ORM\ManyToMany(targetEntity="TagBundle\Entity\Tag", cascade={"persist"})
     */
    private $tags;

    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;
        return $this;
    }
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }
    public function getTags()
    {
        return $this->tags;
    }
}