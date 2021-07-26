<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Idea\Infrastructure\Communication\Console;

use HexagonalArchitecture\Step04\Idea\Application\Service\CreaIdea;
use HexagonalArchitecture\Step04\Idea\Application\Service\CreaIdeaRequest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateIdeaCommand extends Command
{
    public function __construct(private CreaIdea $ideaService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('app:create-idea')
            ->addArgument('title', InputArgument::REQUIRED, "Idea's title")
            ->addArgument('author', InputArgument::REQUIRED, "Idea's author")
            ->addArgument('description', InputArgument::OPTIONAL, "Idea's description", '');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $ideaId = $this->ideaService->execute(new CreaIdeaRequest(
            $input->getArgument('title'),
            $input->getArgument('author'),
            $input->getArgument('description')
        ));

        $output->write(sprintf("Idea created with Id %s\n", (string) $ideaId));

        return Command::SUCCESS;
    }
}
