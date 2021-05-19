<?php

namespace Jsanbae\Metamorphoser\Laravel;

use Illuminate\Console\GeneratorCommand;

class MetamorphoserMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:metamorphoser {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create metamorphoser process';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Metamorphoser';

    /**
     * Get stub File path
     * 
     * @return string
     */
    public function getStub()
    {
        return __DIR__ . '/stubs/morpher.stub';
    }

    /**
     * Collection of Classes to create
     * 
     * @return array
     */
    public function getClasses()
    {
        return [
            [
                'name'=> $this->getAlias().'Morpher',
                'stub' => __DIR__ . '/stubs/morpher.stub',
            ],
            [
                'name' => 'Arrangers/'.$this->getAlias().'Arranger', 
                'stub' => __DIR__ . '/stubs/arranger.stub',
            ],
            [
                'name' => 'Mutators/'.$this->getAlias().'Mutator', 
                'stub' => __DIR__ . '/stubs/mutator.stub',
            ],
            [
                'name' => 'Filters/'.$this->getAlias().'Filter', 
                'stub' => __DIR__ . '/stubs/filter.stub',
            ],
            [
                'name' => 'Validators/'.$this->getAlias().'Validator', 
                'stub' => __DIR__ . '/stubs/validator.stub',
            ]
        ];
    }

    public function getAlias()
    {
        return str_replace([$this->type, strtolower($this->type), strtoupper($this->type)], '', $this->getNameInput());
    }

    /**
     * Do the same as default handle method, but applies to multiples stubs
     * 
     * @return bool|null
     */
    public function generateFiles()
    {
        foreach ($this->getClasses() as $class) {

            // First we need to ensure that the given name is not a reserved word within the PHP
            // language and that the class name will actually be valid. If it is not valid we
            // can error now and prevent from polluting the filesystem using invalid files.
            if ($this->isReservedName($class['name'])) {
                $this->error('The name "'.$class['name'].'" is reserved by PHP.');

                return false;
            }

            $name = $this->qualifyClass($class['name']);

            $path = $this->getPath($name);

            // Next, We will check to see if the class already exists. If it does, we don't want
            // to create the class and overwrite the user's code. So, we will bail out so the
            // code is untouched. Otherwise, we will continue generating this class' files.
            if ((! $this->hasOption('force') ||
                ! $this->option('force')) &&
                $this->alreadyExists($class['name'])) {
                $this->error($this->type.' already exists!');

                return false;
            }

            // Next, we will generate the path to the location where this class' file should get
            // written. Then, we will build the class and make the proper replacements on the
            // stub files so that it gets the correctly formatted namespace and class name.
            $this->makeDirectory($path);

            $this->files->put($path, $this->sortImports($this->buildClassStub($name, $class['stub'])));

            $this->info($name.' created successfully.');

        }
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @param  string  $stub
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClassStub($name, $stub)
    {
        $stub = $this->files->get($stub);

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $this->generateFiles();
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\' . $this->type;
    }

        /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $searches = [
            ['DummyNamespace', 'DummyRootNamespace', 'NamespacedDummyUserModel', 'DummyName'],
            ['{{ namespace }}', '{{ rootNamespace }}', '{{ namespacedUserModel }}', '{{ name }}'],
            ['{{namespace}}', '{{rootNamespace}}', '{{namespacedUserModel}}', '{{name}}'],
        ];

        foreach ($searches as $search) {
            $stub = str_replace(
                $search,
                [$this->getNamespace($name), $this->rootNamespace(), $this->userProviderModel(), $this->getAlias()],
                $stub
            );
        }

        return $this;
    }
}