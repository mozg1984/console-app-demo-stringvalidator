<?php

namespace Demo\Validator;

use \Khisamutdinov\StringValidator;

class StringValidatorBuilder
{
    /**
     * @var string
     */
    private $string;
    
    /**
     * Sets string for validation
     *
     * @param string $string
     *
     * @return StringValidatorBuilder
     */
    public function setString(string $string): StringValidatorBuilder
    {
        $this->string = $string;
        return $this;
    }
    
    /**
     * Builds string validator
     *
     * @return StringValidator
     */
    public function build(): StringValidator
    {
        return new StringValidator($this->string);
    }
}