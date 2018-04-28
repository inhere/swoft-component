<?php

namespace Swoft\DataParser;

/**
 * Class AbstractDataParser
 * @package Swoft\DataParser
 */
abstract class AbstractDataParser implements DataParserInterface
{
    /**
     * @var array
     */
    protected $encodeOpts;

    /**
     * @var array
     */
    protected $decodeOpts;

    /**
     * JsonParser constructor.
     * @param array $encodeOpts
     * @param array $decodeOpts
     */
    public function __construct(array $encodeOpts = [], array $decodeOpts = [])
    {
        $this->encodeOpts = $encodeOpts;
        $this->decodeOpts = $decodeOpts;
    }

    /**
     * @return array
     */
    public function getEncodeOpts(): array
    {
        return $this->encodeOpts;
    }

    /**
     * @return array
     */
    public function getDecodeOpts(): array
    {
        return $this->decodeOpts;
    }
}
