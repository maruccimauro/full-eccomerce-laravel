<?php

namespace App\DTOs;

trait BaseDTO
{
  public function toArray(): array
  {
    return get_object_vars($this);
  }
}
