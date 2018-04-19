<?php

namespace Alexecus\Example\Form;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

use Alexecus\Spawner\Command\Command;
use Alexecus\Spawner\Operations\Template;
use Alexecus\Spawner\Operations\Copy;

use Alexecus\Spawner\Input\Validators\EmptyValidator;

/**
 * Form Plugin
 * Generates a form plugin
 */
class FormGenerator extends Command
{
    /**
     * @var Template
     */
    private $template;
        
    public function __construct(Template $template, Copy $copy)
    {
        parent::__construct();

        $this->template = $template;
        $this->copy = $copy;
    }

    /**
     * @{inheritdoc}
     */
    public function configure()
    {
        $this
            ->setName('generate:form')
            ->setDescription('Generates a new form plugin');
    }

    /**
     * @{inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $this->ask('Where to generate this form ?', '/src/Form', [
            new EmptyValidator('Form should not be empty'),
        ]);

        // inputs

        $name = $this->ask('What is the name of the form ?', 'ContactForm');
        $isTemplate = $this->confirm('Do you want to generate a template file ?');
        $confirm = $this->confirm('Do you confirm form generation ?');

        // actions

        if ($confirm) {
            if ($isTemplate) {
                $this->createTemplate($path, $name);
            }

            $this->createForm($path, $name);
            $this->success("The form $name was generated");
        }
    }

    /**
     * Creates the template file
     *
     * @param string $path The namespace path
     * @param string $name The name of the form
     */
    private function createTemplate($path, $name)
    {
        $source = __DIR__ . '/template/template.html.twig';
        $target = "$path/$name.html.twig";

        $this->copy->perform($source, $target);
    }

    /**
     * Creates the form class
     *
     * @param string $path The namespace path
     * @param string $name The name of the form
     */
    private function createForm($path, $name)
    {
        $source = __DIR__ . '/template/Form.php.twig';
        $target = "$path/$name.php";

        $replacements = [
            'form_name' => $name,
        ];

        $this->template->perform($source, $target, $replacements);
    }
}
