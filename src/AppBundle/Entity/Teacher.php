<?php


namespace AppBundle\Entity;

use AppBundle\Entity\Traits\NamingTrait;
use AppBundle\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="teacher")
 */
class Teacher
{
    use TimestampableTrait;
    use NamingTrait;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
     /**
     * @var string age
     *
     * @ORM\Column(name="age", type="string", length=255, nullable=false)
     */
    private $age;

    /**
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param string $age
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }
        /**
     * @var string name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


}
