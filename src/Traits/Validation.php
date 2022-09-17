<?php
namespace George\ConsoleApp\Traits;
/**
 * 
 */
trait Validation
{

    public $entityerror=[];
    public function checkIfEmpty($data, $required)
    {
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $required) && empty($value)) {
                $this->entityerror[$key]=$key." is required";
            }
        }

        if (empty($this->entityerror)) {
            return false;
        }

        return true;
    }

    public function validate(Array $data)
    {
        # code...
    }
}
