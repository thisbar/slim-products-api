<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;

/**
 * @ORM\Entity(repositoryClass="ProductRepository")
 * @ORM\Table(name="products")
 *
 * @OA\Schema(
 *     required={"name", "slug", "price", "stock"}
 * )
 *
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     *
     * @OA\Property(
     *  description="Unique autoincremental ID for the product.",
     *  readOnly=true,
     *  minimum="1",
     *  type="integer",
     *  format="int64",
     *  example="1"
     * )
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @OA\Property(
     *  description="Name or title of the product.",
     *  type="string",
     *  minLength="3",
     *  maxLength="60",
     *  example="Laptop 15" i5 - 16GB RAM - 250 SSD"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     *
     * @OA\Property(
     *  description="Friendly URL for the product",
     *  type="string",
     *  pattern="^[0-9-a-zA-Z]+$",
     *  minLength="5",
     *  maxLength="50",
     *  example="laptop-15-i5-16gb-250ssd"
     * )
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     *
     * @OA\Property(
     *  description="Description and information about the product.",
     *  type="string",
     *  minLength="100",
     *  maxLength="1500",
     *  example="La notebook HP Pavilion 15-eh0004la es una solución tanto para trabajar y estudiar como para entretenerte. Al ser portátil, el escritorio dejará de ser tu único espacio de uso para abrirte las puertas a otros ambientes ya sea en tu casa o en la oficina.
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     *
     * @OA\Property(
     *  escription="Price of the product",
     *  type="number",
     *  format="float",
     *  minimum="0.50",
     *  example="349.99"
     * )
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     *
     * @OA\Property(
     *  description="Amount of available stock.",
     *  type="integer",
     *  format="int32",
     *  minimum="0",
     *  maximum="1000",
     *  example="152"
     * )
     */
    private $stock;

    /**
     * @ORM\Column(type="string")
     *
     * @OA\Property(
     *  description="Keywords separated by commas used to make search operations.",
     *  type="string",
     *  pattern="(.+?)(?:,|$)",
     *  minLength="50",
     *  example="laptop, core i5, ssd"
     * )
     */
    private $keywords;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return self
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of keywords
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set the value of keywords
     *
     * @return self
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Iterate and transform to JSON
     *
     * @return string
     */
    public function toJson(): string
    {
        $json = $this->toArray();

        return json_encode($json);
    }

    /**
     * Iterate and transform to Array
     *
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        foreach ($this as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }
}
