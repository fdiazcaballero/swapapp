<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use AppBundle\DBAL\Types\GeographicSwapPreferenceType;

/**
 * SwapPreference
 *
 * @ORM\Table(name="swap_preference")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SwapPreferenceRepository")
 */
class SwapPreference
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="swapPreference1")
     * @ORM\JoinColumn(name="category_preference_1", nullable=false, referencedColumnName="id")
     */
    private $categoryPreference1;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="swapPreference2")
     * @ORM\JoinColumn(name="category_preference_2", nullable=true, referencedColumnName="id")
     */
    private $categoryPreference2;
    
    /**
     * Note, that type of a field should be same as you set in Doctrine config
     * (in this case it is GeographicSwapPreferenceType)
     *
     * @ORM\Column(name="geographic_preference", type="GeographicSwapPreferenceType", nullable=false, options={"default":"ST"})
     * @DoctrineAssert\Enum(entity="AppBundle\DBAL\Types\GeographicSwapPreferenceType")     
     */
    private $geographicPreference;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

   
    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return SwapPreference
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set categoryPreference1
     *
     * @param \AppBundle\Entity\Category $categoryPreference1
     *
     * @return SwapPreference
     */
    public function setCategoryPreference1(\AppBundle\Entity\Category $categoryPreference1 = null)
    {
        $this->categoryPreference1 = $categoryPreference1;

        return $this;
    }

    /**
     * Get categoryPreference1
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategoryPreference1()
    {
        return $this->categoryPreference1;
    }

    /**
     * Set categoryPreference2
     *
     * @param \AppBundle\Entity\Category $categoryPreference2
     *
     * @return SwapPreference
     */
    public function setCategoryPreference2(\AppBundle\Entity\Category $categoryPreference2 = null)
    {
        $this->categoryPreference2 = $categoryPreference2;

        return $this;
    }

    /**
     * Get categoryPreference2
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategoryPreference2()
    {
        return $this->categoryPreference2;
    }

    /**
     * Set geographicPreference
     *
     * @param GeographicSwapPreferenceType $geographicPreference
     *
     * @return SwapPreference
     */
    public function setGeographicPreference($geographicPreference)
    {
        $this->geographicPreference = $geographicPreference;

        return $this;
    }

    /**
     * Get geographicPreference
     *
     * @return GeographicSwapPreferenceType
     */
    public function getGeographicPreference()
    {
        return $this->geographicPreference;
    }
}
