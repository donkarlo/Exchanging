<?php

namespace Ndrm\AuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Ndrm\AuthBundle\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="username already taken")
 * @UniqueEntity(fields="cellPhone", message="Cell phone already taken")
 */
class User implements AdvancedUserInterface, \Serializable {

    /**
     * @var int
     *
     * @ORM\Column(name="id_users", type="integer" , options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=25, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ORM\Column(name="password",type="string", length=64)
     */
    private $password;

    /**
     * Not in databse will be encrypted
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="email",type="string", length=60, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(name="cell_phone",type="string", length=10, unique=true)
     * @Assert\NotBlank()
     */
    private $cellPhone;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(name="first_name", type="string")
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @ORM\Column(name="last_name", type="string")
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     *
     * @var string
     */
    private $remember;

    /**
     * Many User have Many Role.
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="users_roles",
     *      joinColumns={@ORM\JoinColumn(name="id_users", referencedColumnName="id_users")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_roles", referencedColumnName="id_roles")}
     *      )
     */
    private $roles;

    public function __construct() {
        $this->isActive = true;
        $this->roles = new ArrayCollection();
    }

    function getId() {
        return $this->id;
    }

    function getIsActive() {
        return $this->isActive;
    }

    public function getSalt() {
        
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRoles() {
        return $this->roles->toArray();
    }

    public function getRolesIds() {
//        $rolesIds = array();
//        foreach ($this->getRoles() as $roleObject) {
//            $rolesIds[] = $roleObject->getId();
//        }
//        return $rolesIds;
        return $this->roles->map(function (Role $role) {
                    return $role->getId();
                });
    }

    public function deletAllRoles() {
        $this->roles->clear();
        return $this;
    }

    public function eraseCredentials() {
        
    }

    /** @see \Serializable::serialize() */
    public function serialize() {
        return json_encode(array(
            $this->id,
            $this->username,
            $this->password,
            $this->roles
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
                $this->id,
                $this->username,
                $this->password,
                $this->roles
                ) = json_decode($serialized);
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function getCellPhone() {
        return $this->cellPhone;
    }

    function setCellPhone($cellPhone) {
        $this->cellPhone = $cellPhone;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
    }

    function getPlainPassword() {
        return $this->plainPassword;
    }

    public function isAccountNonExpired(): bool {
        return true;
    }

    public function isAccountNonLocked(): bool {
        return true;
    }

    public function isCredentialsNonExpired(): bool {
        return true;
    }

    public function isEnabled(): bool {
        return true;
    }

}
