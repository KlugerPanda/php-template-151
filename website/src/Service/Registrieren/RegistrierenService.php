<?php

namespace KlugerPanda\Service\Registrieren;

interface RegistrierenService
{
   public function register($username, $email, $password, $link);
}