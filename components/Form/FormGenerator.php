<?php

namespace Components\Form;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\Command\Command;
use App\Operations\Copy;

use App\Input\Validators\EmptyValidator;

/**
 * Form Plugin
 * Generates a form plugin
 */
class FormGenerator extends Command
{
    /**
     * @var Copy
     */
    private $copy;
        
    public function __construct(Copy $copy)
    {
        parent::__construct();

        $this->copy = $copy;
    }

    /**
     * @{inheritdoc}
     */
    public function configure()
    {
        $this
            ->setName('generate:form')
            ->setDescription('Generates a new form plugin')
        ;
    }

    /**
     * @{inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $this->ask('Where to generate this form ?', '/src/Form', [
            new EmptyValidator('Form should not be empty'),
        ]);

        $name = $this->ask('What is the name of the form ?', 'ContactForm');

        $confirm = $this->confirm('Do you confirm form generation ?');

        if ($confirm) {
            $this->createForm($path, $name);
            $this->success("The form $name was generated");
        }
    }

    /**
     * Creates the form class
     *
     * @param string $name The name of the form
     */
    private function createForm($path, $name)
    {
        $source = __DIR__ . '/template/Form.php.twig';
        $target = "$path/$name.php";

        $replacements = [
            'form_name' => $name,
        ];

        $this->copy->perform($source, $target, $replacements);
    }
}
