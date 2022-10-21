<?php

namespace App\app\swagger\components\parameters;

use OpenApi\Annotations as OA;

/**
 *
 * @OA\Parameter(
 *  parameter="Limit",
 *  name="limit",
 *  in="query",
 *  description="Number of records to be included in API call.",
 *  type="integer",
 *  format="int32",
 *  minimum=1,
 *  maximum=100,
 *  default=25
 * )
 */
class Limit
{
}