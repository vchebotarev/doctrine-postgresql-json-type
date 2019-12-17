<?php

declare(strict_types=1);

namespace Chebur\DoctrinePostgreSQLTypeJson;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use Doctrine\DBAL\Types\JsonType as BaseJsonType;

class JsonType extends BaseJsonType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $encoded = parent::convertToDatabaseValue($value, $platform);

        if (is_string($encoded) && $platform instanceof PostgreSqlPlatform) {
            $encoded = str_replace('\\u0000', '', $encoded);
        }

        return $encoded;
    }
}
