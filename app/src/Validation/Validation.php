<?php
namespace Validation;
use Database\Adapter\AdapterI;
use Database\ConnectionI;
class Validation
{
    private $_passed = false,
            $_errors = array(),
            $_db = null;

    public function __construct(AdapterI $conn)
    {
        $this->_db = $conn;
    }
    public function check($source, $items){

        foreach($items as $item => $rules){
            foreach($rules as $rule => $rule_value){
                $value = trim($source[$item]);

                if($rule === 'required' && empty($value)){
                    $this->addError($item,"{$item} is required.");

                }else{

                    switch($rule){
                        case 'min':

                            if(strlen($value) < $rule_value){
                                $this->addError($item,"{$item} must be a minimum of {$rule_value} characters.");
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError($item,"{$item} must be a maximum of {$rule_value} characters.");
                            }
                            break;
                        case 'match':
                            if($value != $source[$rule_value]){
                                $this->addError($item,"{$item} must match {$rule_value}.");

                            }

                            break;
                        case 'emailFormat':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $this->addError($item,"Invalid format.");
                            }

                            break;
                        case 'unique':
                            $sql = "SELECT * FROM ".$rule_value." WHERE ".$item."=?";
                            $result = $this->_db->find($sql, $value);


                           if($result){
                               $this->addError($item, "{$item} {$value} already exist.");
                           }
                            break;
                    }
                }
            }
        }
        if(empty($this->_errors)){
            $this->_passed = true;
        }
    }
    public function passed(){
        return $this->_passed;
    }
    public function getErrors(){
        return $this->_errors;
    }
    private function addError($item, $error){
        $this->_errors[$item] = $error;
    }
    public function getError($param){

        return isset($this->_errors[$param]) ? $this->_errors[$param] : false;
    }
}