<?php 

class Archer extends Character
{
    public $quiver = 20;
    public $doubleArrow = false;
    public $arrowDamage = 10;
    public function __construct($name) {
        parent::__construct($name);
        $this->damage = 7;
    }

    public function turn($target) {
        if ($this->doubleArrow == true) {
            $status = $this->trueArrow($target);
        } elseif ($this->quiver == 0 && $this->doubleArrow == false) {
            $status = $this->attack($target);
        } elseif ($this->quiver > 0 && $this->doubleArrow == false) {
            $rand = rand(1, 10);
            if ($rand <= 3) {
                $status = $this->doubleArrow();
            } elseif ($rand > 3) {
                $status = $this->arrow($target);
            }
            return $status;
        }
        return $status;
    }

    public function trueArrow($target) {
        $this->doubleArrow = false;
        $target->setHealthPoints($this->arrowDamage);
        $powerup = $this->arrowDamage * 1.5;
        $target->setHealthPoints($powerup);
        $this->quiver -= 2;
        $status = "$this->name tire deux flêches en plein dans $target->name, il lui reste $this->quiver flêches dans sont carquois ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }

    public function doubleArrow() {
        $this->doubleArrow = true;
        $status = "$this->name se prépare à tirer deux flêches ! La puissance de la seconde sera augmenté par la vitesse de la première.";
        return $status;
    }

    public function arrow($target) {
        $this->quiver -= 1;
        $target->setHealthPoints($this->arrowDamage);
        $status = "$this->name tire une flêche en plein dans $target->name, il lui reste $this->quiver flêches dans sont carquois ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }

    public function attack($target) {
        $target->setHealthPoints($this->damage);
        $status = "$this->name donne un coup de dague à $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }

}