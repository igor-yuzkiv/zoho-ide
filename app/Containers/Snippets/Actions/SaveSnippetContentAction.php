<?php

namespace App\Containers\Snippets\Actions;

use App\Abstractions\Contracts\Action\ActionInterface;
use App\Containers\Snippets\Models\Snippet;
use App\Containers\Snippets\Utils\SnippetUtil;

/**
 *
 */
class SaveSnippetContentAction implements ActionInterface
{

    /**
     * @param Snippet $snippet
     * @param string $content
     * @param string|null $prevComponentName
     */
    public function __construct(
        protected readonly Snippet $snippet,
        protected readonly string   $content,
        protected readonly ?string $prevComponentName = null,
    )
    {

    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        if (!\File::isDirectory(SnippetUtil::getBasePath())) {
            \File::makeDirectory(SnippetUtil::getBasePath(), 0775, true, true);
        }

        $this->removePrevFile();

        return (bool)file_put_contents(
            SnippetUtil::getFullPath($this->snippet->component_name),
            $this->content
        );
    }

    /**
     * @return void
     */
    public function removePrevFile(): void {
        if (!$this->prevComponentName) {
            return;
        }

        if ($this->prevComponentName === $this->snippet->component_name) {
            return;
        }

        $oldFilePath = SnippetUtil::getFullPath($this->prevComponentName);
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }
    }
}
