<?php

declare(strict_types=1);

namespace Quillstack\HttpRequest;

abstract class HttpRequest
{
    /**
     * @var string
     */
    public const METHOD_GET = 'GET';

    /**
     * @var string
     */
    public const METHOD_POST = 'POST';

    /**
     * @var string
     */
    public const METHOD_HEAD = 'HEAD';

    /**
     * @var string
     */
    public const METHOD_PUT = 'PUT';

    /**
     * @var string
     */
    public const METHOD_DELETE = 'DELETE';

    /**
     * @var string
     */
    public const METHOD_PATCH = 'PATCH';

    /**
     * @var string
     */
    public const METHOD_OPTIONS = 'OPTIONS';

    /**
     * @var array
     */
    public const AVAILABLE_METHODS = [
        self::METHOD_GET,
        self::METHOD_POST,
        self::METHOD_HEAD,
        self::METHOD_PUT,
        self::METHOD_DELETE,
        self::METHOD_PATCH,
        self::METHOD_OPTIONS,
    ];
}
