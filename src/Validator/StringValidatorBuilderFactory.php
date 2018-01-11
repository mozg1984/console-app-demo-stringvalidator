<?php

namespace Demo\Validator;

class StringValidatorBuilderFactory
{
    /**
     * Returns StringValidatorBuilder instance
     *
     * @return StringValidatorBuilder
     */
    public function getBuilder(): StringValidatorBuilder
    {
        return new StringValidatorBuilder();
    }
}