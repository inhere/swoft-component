<?php

namespace Swoft\DataParser;

/**
 * Class DataParserAwareTrait
 * @package Swoft\DataParser
 * @author inhere <in.798@qq.com>
 */
trait DataParserAwareTrait
{
    /**
     * @var DataParserInterface
     */
    private $parser;

    /**
     * @return DataParserInterface
     */
    public function getParser(): DataParserInterface
    {
        if (!$this->parser) {
            $this->parser = new PhpParser();
        }

        return $this->parser;
    }

    /**
     * @param DataParserInterface $parser
     */
    public function setParser(DataParserInterface $parser)
    {
        $this->parser = $parser;
    }
}
