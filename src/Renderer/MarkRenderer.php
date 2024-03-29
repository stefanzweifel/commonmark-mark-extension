<?php

declare(strict_types=1);

namespace Wnx\CommonmarkMarkExtension\Renderer;

use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class MarkRenderer implements NodeRendererInterface
{
    /**
     * @param Node $node
     *
     * {@inheritDoc}
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
        /** @var array<string, string> $attrs */
        $attrs = $node->data->get('attributes');

        return new HtmlElement('mark', $attrs, $childRenderer->renderNodes($node->children()));
    }
}
