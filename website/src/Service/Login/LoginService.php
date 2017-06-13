<?php

namespace KlugerPanda\Service\Login;

interface LoginService
{
   public function authenticate($username, $password);
}
