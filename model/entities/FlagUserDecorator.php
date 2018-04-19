<?php
/**
 * Class FlagUSerDecorator.php
 *
 * Define Visitor/admim  User right
 */
class FlagUserDecorator
{
    private $flag;
    private $user;

    public function __construct(BddUser $user)
    {
        $this->user=$user;

    }

    /**
     * @return mixed
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * @param mixed $flag
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
    }


}
