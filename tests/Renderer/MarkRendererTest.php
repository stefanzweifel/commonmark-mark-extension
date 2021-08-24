<?php

namespace Wnx\CommonmarkMarkExtension\Tests\Renderer;

use League\CommonMark\Util\HtmlElement;
use Wnx\CommonmarkMarkExtension\Element\Mark;
use Wnx\CommonmarkMarkExtension\Renderer\MarkRenderer;
use PHPUnit\Framework\TestCase;
use Wnx\CommonmarkMarkExtension\Tests\Support\FakeChildNodeRenderer;

class MarkRendererTest extends TestCase
{
    private MarkRenderer $renderer;

    protected function setUp(): void
    {
        $this->renderer = new MarkRenderer();
    }

    /** @test */
    public function it_renders_mark()
    {
        $inline = new Mark();
        $inline->data->set('attributes/id', 'foo');
        $fakeRenderer = new FakeChildNodeRenderer();
        $fakeRenderer->pretendChildrenExist();

        $result = $this->renderer->render($inline, $fakeRenderer);

        $this->assertTrue($result instanceof HtmlElement);
        $this->assertEquals('mark', $result->getTagName());
        $this->assertStringContainsString('::children::', $result->getContents(true));
        $this->assertEquals(['id' => 'foo'], $result->getAllAttributes());
    }
}
