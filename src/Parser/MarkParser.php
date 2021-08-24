<?php

namespace Wnx\CommonmarkMarkExtension\Parser;

use League\CommonMark\Parser\Inline\InlineParserInterface;
use League\CommonMark\Parser\Inline\InlineParserMatch;
use League\CommonMark\Parser\InlineParserContext;

class MarkParser implements InlineParserInterface
{
    public function getMatchDefinition(): InlineParserMatch
    {
        return InlineParserMatch::regex("(==)(.*)(==)")->caseSensitive();
    }

    public function parse(InlineParserContext $inlineContext): bool
    {
        return true;
        // TODO: Implement parse() method.
    }
}
