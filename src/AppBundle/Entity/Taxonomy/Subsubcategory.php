<?php

namespace AppBundle\Entity\Taxonomy;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Subsubcategory
 *
 * @ORM\Table(name="subsubcategory")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Taxonomy\SubsubcategoryRepository")
 */
class Subsubcategory
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
     * @ORM\ManyToOne(targetEntity="Subcategory", inversedBy="subSubCategories")
     * @ORM\JoinColumn(name="parent_subcategory_id", nullable=false, referencedColumnName="id")
     */
    private $parentSubcategory;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=63, unique=true)
     */
    private $name;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    
     /**
     * @ORM\OneToMany(targetEntity="Subsubsubcategory", mappedBy="parentSubSubcategory")
     */
    private $subSubSubCategories;
    
    /**
     * @ORM\Column(name="swap_preference", nullable=true, options={"default":null})
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Product\SwapPreference", mappedBy="subSubCategoryPreference")
     */
    private $swapPreference;
       
    /**
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Product\ProductTaxonomy", mappedBy="subSubCategory")
     */
    private $productTaxonomies;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", options={"default":1})
     */
    private $isActive;
    
     public function __construct()
    {
        $this->productTaxonomies = new ArrayCollection();
        $this->swapPreference = new ArrayCollection(); 
        $this->subSubSubCategories = new ArrayCollection();
        
    }


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
     * Set name
     *
     * @param string $name
     *
     * @return Subsubcategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Subsubcategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set swapPreference
     *
     * @param string $swapPreference
     *
     * @return Subsubcategory
     */
    public function setSwapPreference($swapPreference)
    {
        $this->swapPreference = $swapPreference;

        return $this;
    }

    /**
     * Get swapPreference
     *
     * @return string
     */
    public function getSwapPreference()
    {
        return $this->swapPreference;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Subsubcategory
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set parentSubcategory
     *
     * @param \AppBundle\Entity\Subcategory $parentSubcategory
     *
     * @return Subsubcategory
     */
    public function setParentSubcategory(\AppBundle\Entity\Subcategory $parentSubcategory)
    {
        $this->parentSubcategory = $parentSubcategory;

        return $this;
    }

    /**
     * Get parentSubcategory
     *
     * @return \AppBundle\Entity\Subcategory
     */
    public function getParentSubcategory()
    {
        return $this->parentSubcategory;
    }

    /**
     * Add subSubSubCategory
     *
     * @param \AppBundle\Entity\Subsubsubcategory $subSubSubCategory
     *
     * @return Subsubcategory
     */
    public function addSubSubSubCategory(\AppBundle\Entity\Subsubsubcategory $subSubSubCategory)
    {
        $this->subSubSubCategories[] = $subSubSubCategory;

        return $this;
    }

    /**
     * Remove subSubSubCategory
     *
     * @param \AppBundle\Entity\Subsubsubcategory $subSubSubCategory
     */
    public function removeSubSubSubCategory(\AppBundle\Entity\Subsubsubcategory $subSubSubCategory)
    {
        $this->subSubSubCategories->removeElement($subSubSubCategory);
    }

    /**
     * Get subSubSubCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubSubSubCategories()
    {
        return $this->subSubSubCategories;
    }

    /**
     * Add productTaxonomy
     *
     * @param \AppBundle\Entity\Product\ProductTaxonomy $productTaxonomy
     *
     * @return Subsubcategory
     */
    public function addProductTaxonomy(\AppBundle\Entity\Product\ProductTaxonomy $productTaxonomy)
    {
        $this->productTaxonomies[] = $productTaxonomy;

        return $this;
    }

    /**
     * Remove productTaxonomy
     *
     * @param \AppBundle\Entity\Product\ProductTaxonomy $productTaxonomy
     */
    public function removeProductTaxonomy(\AppBundle\Entity\Product\ProductTaxonomy $productTaxonomy)
    {
        $this->productTaxonomies->removeElement($productTaxonomy);
    }

    /**
     * Get productTaxonomies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductTaxonomies()
    {
        return $this->productTaxonomies;
    }
}
