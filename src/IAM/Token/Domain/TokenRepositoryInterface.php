<?php


namespace App\IAM\Token\Domain;


interface TokenRepositoryInterface
{
    public function add(Token $user): void;
}