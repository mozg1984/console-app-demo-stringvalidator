<?php
namespace Demo\Commands;

use Demo\FileSystem;
use Demo\Validator\StringValidatorBuilderFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class ValidationCommand extends Command
{
    /**
     * @var StringValidatorBuilderFactory
     */
    private $stringValidatorBuilderFactory;
    
    /**
     * ValidationCommand constructor.
     *
     * @param FileSystem $fileSystem
     * @param StringValidatorBuilderFactory $stringValidatorBuilderFactory
     */
    public function __construct(FileSystem $fileSystem, StringValidatorBuilderFactory $stringValidatorBuilderFactory)
    {
        parent::__construct();
        $this->fileSystem = $fileSystem;
        $this->stringValidatorBuilderFactory = $stringValidatorBuilderFactory;
    }
    
    protected function configure()
    {
        $this
            ->setName('validate')
            ->setDescription('Returns result of string validation')
            ->setHelp('This command returns result of string validation')
            ->addArgument('filepath', InputArgument::REQUIRED, 'The file path that contents string for validation');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {            
            $path = $input->getArgument('filepath');
            $string = $this->fileSystem->getContent($path);

            $stringValidatorBuilder = $this->stringValidatorBuilderFactory->getBuilder();
            $stringValidatorBuilder->setString($string);

            $stringValidator = $stringValidatorBuilder->build();
            $validationResult = $stringValidator->validate() ? 'valid' : 'not valid';
            $output->writeln("<info>Given string in file is {$validationResult}</info>");

        } catch (\Exception $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");
        }
    }
}