<?php

namespace App\app\swagger\components\responses;

use OpenApi\Annotations as OA;

/**
 * @OA\Response(
 *     response="NotFound",
 *     description="Resource not found.",
 *     @OA\JsonContent(type="string", example="Resource not found.")
 * )
 */
class NotFound
{

}