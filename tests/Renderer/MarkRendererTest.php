<?php

declare(strict_types=1);

namespace Wnx\CommonmarkMarkExtension\Tests\Renderer;

use League\CommonMark\Util\HtmlElement;
use PHPUnit\Framework\TestCase;
use Wnx\CommonmarkMarkExtension\Element\Mark;
use Wnx\CommonmarkMarkExtension\Renderer\MarkRenderer;
use Wnx\CommonmarkMarkExtension\Tests\Support\FakeChildNodeRenderer;

class MarkRendererTest extends TestCase
{
    private MarkRenderer $renderer;

    protected function setUp(): void
    {
        $this->renderer = new MarkRenderer();
    }

    /** @test */
    public function it_renders_mark(): void
    {
        $inline = new Mark();
        $inline->data->set('attributes/id', 'foo');
        $fakeRenderer = new FakeChildNodeRenderer();
        $fakeRenderer->pretendChildrenExist();

        $result = $this->renderer->render($inline, $fakeRenderer);

        $this->assertInstanceOf(HtmlElement::class, $result);
        $this->assertEquals('mark', $result->getTagName());
        $this->assertEquals(['id' => 'foo'], $result->getAllAttributes());
        /** @phpstan-ignore-next-line  */
        $this->assertStringContainsString('::children::', $result->getContents(false));
    }
}
