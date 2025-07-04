<?php

namespace App\DTOs\Category;

use Illuminate\Http\Request;
use App\Fields\CategoryFields;
use App\DTOs\BaseDTO;

class UpdateDTO
{
  use BaseDTO;

  public function __construct(
    public readonly int $id,
    public readonly string $name,
    public readonly ?int $parent_id,
  ) {}

  public static function fromRequest(Request $request)
  {
    return new self(
      $id = $request->{CategoryFields::ID},
      $name = $request->{CategoryFields::NAME},
      $parent_id = $request?->{CategoryFields::PARENT_ID}
    );
  }
}
