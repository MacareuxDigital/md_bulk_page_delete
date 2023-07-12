<?php
/**
 * @author: Biplob Hossain <biplob.ice@gmail.com>
 */

namespace Macareux\BulkPageDelete\Console\Command;

use Concrete\Core\Console\Command;
use Concrete\Core\Page\Page;
use RuntimeException;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MdPageDeleteCommand extends Command
{
    /** @var ProgressBar */
    protected $progressBar;

    protected function configure(): void
    {
        $this
            ->setName('md:page:delete')
            ->setDescription('Delete pages and their child pages based on page path.')
            ->addArgument('pagePath', InputArgument::REQUIRED, 'The path of the page(s) to delete.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $pagePath = $input->getArgument('pagePath');

        try {
            $page = Page::getByPath($pagePath);

            if (!is_object($page) || $page->isError()) {
                $output->writeln('Page not found!');

                return self::FAILURE;
            }

            $totalPages = $this->countChildPages($page) + 1; // Include the main page

            $this->progressBar = new ProgressBar($output, $totalPages);
            $this->progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %message%');
            $this->progressBar->setMessage('');
            $this->progressBar->start();

            $this->deletePageAndChildren($page);

            $this->progressBar->finish();
            $output->writeln("\nPages deleted successfully.");

            return self::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln("\nAn error occurred: " . $e->getMessage());

            return self::FAILURE;
        }
    }

    private function countChildPages(Page $page): int
    {
        // Get child pages from all levels
        $children = $page->getCollectionChildrenArray(false);
        return count($children);
    }

    private function deletePageAndChildren(Page $page): void
    {
        // Get only the first level of child pages
        $children = $page->getCollectionChildrenArray(true);
        foreach ($children as $childID) {
            $childPage = Page::getByID($childID);
            if (is_object($childPage)) {
                $this->deletePageAndChildren($childPage);
            }
        }

        $this->progressBar->setMessage("Deleting page: " . $page->getCollectionName());
        $page->delete();
        $this->progressBar->advance();
    }
}