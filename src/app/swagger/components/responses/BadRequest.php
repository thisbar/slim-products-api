<?php

namespace App\app\swagger\components\responses;

use OpenApi\Annotations as OA;

/**
 * @OA\Response(
 *     response="BadRequest",
 *     description="We could not process the request. Please check the request syntax.",
 *     @OA\JsonContent(type="string", example="We could not process the request. Please check the request syntax.")
 * )
 */
class BadRequest
{

}