<?php

namespace Wnx\CommonmarkMarkExtension;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\ExtensionInterface;
use Wnx\CommonmarkMarkExtension\Renderer\MarkRenderer;

class MarkExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment
            ->addInlineParser()
            ->addRenderer(FencedCode::class, new MarkRenderer(), 10);
    }
}
