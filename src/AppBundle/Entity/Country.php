<?php

namespace AppBundle\Entity;

/**
 * Country
 */
class Country
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $tld;


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
     * @return Country
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
     * Set tld
     *
     * @param string $tld
     *
     * @return Country
     */
    public function setTld($tld)
    {
        $this->tld = $tld;

        return $this;
    }

    /**
     * Get tld
     *
     * @return string
     */
    public function getTld()
    {
        return $this->tld;
    }
    /**
     * @var string
     */
    private $iso2;

    /**
     * @var string
     */
    private $iso3;

    /**
     * @var string
     */
    private $lat;

    /**
     * @var string
     */
    private $lng;


    /**
     * Set iso2
     *
     * @param string $iso2
     *
     * @return Country
     */
    public function setIso2($iso2)
    {
        $this->iso2 = $iso2;

        return $this;
    }

    /**
     * Get iso2
     *
     * @return string
     */
    public function getIso2()
    {
        return $this->iso2;
    }

    /**
     * Set iso3
     *
     * @param string $iso3
     *
     * @return Country
     */
    public function setIso3($iso3)
    {
        $this->iso3 = $iso3;

        return $this;
    }

    /**
     * Get iso3
     *
     * @return string
     */
    public function getIso3()
    {
        return $this->iso3;
    }

    /**
     * Set lat
     *
     * @param string $lat
     *
     * @return Country
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param string $lng
     *
     * @return Country
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $borders;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->borders = new \Doctrine\Common\Collections\ArrayCollection();
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
	$this->languages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add border
     *
     * @param \AppBundle\Entity\Borders $border
     *
     * @return Country
     */
    public function addBorder(\AppBundle\Entity\Borders $border)
    {
        $this->borders[] = $border;

        return $this;
    }

    /**
     * Remove border
     *
     * @param \AppBundle\Entity\Borders $border
     */
    public function removeBorder(\AppBundle\Entity\Borders $border)
    {
        $this->borders->removeElement($border);
    }

    /**
     * Get borders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBorders()
    {
        return $this->borders;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $translations;

    /**
     * Add translation
     *
     * @param \AppBundle\Entity\Translations $translation
     *
     * @return Country
     */
    public function addTranslation(\AppBundle\Entity\Translations $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \AppBundle\Entity\Translations $translation
     */
    public function removeTranslation(\AppBundle\Entity\Translations $translation)
    {
        $this->translations->removeElement($translation);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $languages;


    /**
     * Add language
     *
     * @param \AppBundle\Entity\Languages $language
     *
     * @return Country
     */
    public function addLanguage(\AppBundle\Entity\Languages $language)
    {
        $this->languages[] = $language;

        return $this;
    }

    /**
     * Remove language
     *
     * @param \AppBundle\Entity\Languages $language
     */
    public function removeLanguage(\AppBundle\Entity\Languages $language)
    {
        $this->languages->removeElement($language);
    }

    /**
     * Get languages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguages()
    {
        return $this->languages;
    }
}
