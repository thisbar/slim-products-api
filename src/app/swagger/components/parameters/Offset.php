<?php

namespace App\app\swagger\components\parameters;

use OpenApi\Annotations as OA;

/**
 *
 * @OA\Parameter(
 *  parameter="Offset",
 *  name="offset",
 *  in="query",
 *  description="A offset from which the list of results are retrieved, where an offset of 0 means the first page of results.",
 *  type="integer",
 *  format="int32",
 *  minimum=0,
 *  default=0
 * )
 */
class Offset
{
}