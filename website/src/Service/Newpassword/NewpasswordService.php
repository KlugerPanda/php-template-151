<?php

namespace KlugerPanda\Service\Newpassword;

interface NewpasswordService
{
   public function neuesPassword($email);
   public function getUsername($email);
   public function getEmail($email);
   public function getLink($email);
   
   public function richtigerLink($link);
   
   public function passwordAendern();
}
