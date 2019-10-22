<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class RepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {repository} {--remove}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new repository';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->repository = $this->argument('repository');
        $this->dir = base_path('Repository\\'.$this->repository);

        $remove = $this->option('remove');

        if($remove == true) {
            
            $success = File::deleteDirectory($this->dir);
            return $this->info('Remove Component Successfuly');
        }

        try{
            $this->createComponentDir()
                 ->createUnitTestFile()
                 ->createInterfaceFile()
                 ->createRepositoryFile()
                 ->createModelFile()
                 ->createProviderFile()
                 ->createFacadeFile()
                 ->info("Component create successfully");
         } catch( Exception $e){
            $this->info($e);
         }
    }

    /**
     *
     * Create repository dir
     *
     */
    
    private function createComponentDir()
    {
        $dir = base_path('app/Repository').'/'.$this->repository;
        try{
            if(mkdir($dir)){
                $this->dir = $dir;
                $this->info('Create dir '. $this->repository.' successfully');
            }else{
                return $this->info('Can\'t create dir '. $this->repository);
            }
        }catch( Exception $e){
            return $this->info('Component is exists');
        }

        return $this;
    }

    /**
     *
     * Create Unitest File
     *
     */
    

    private function createUnitTestFile()
    {
        $output = view('generators.repository.unit_test',['repository'=>$this->repository])->render();
        $this->createFile($this->dir.'/'.$this->repository.'UnitTest.php',$output);
        return $this;
    }

    /**
     *
     * Create Facade File
     *
     */

    private function createFacadeFile()
    {
        $output = view('generators.repository.facade',['repository'=>$this->repository])->render();
        $this->createFile($this->dir.'/'.$this->repository.'Facade.php',$output);
        return $this;
    }

    /**
     *
     * Create Repository File
     *
     */

    private function createRepositoryFile()
    {
        $output = view('generators.repository.repository',['repository'=>$this->repository])->render();
        $this->createFile($this->dir.'/'.$this->repository.'Repository.php',$output);
        return $this;
    }

    /**
     *
     * Create Model File
     *
     */

    private function createModelFile()
    {
        $output = view('generators.repository.model',['repository'=>$this->repository,'table'=>strtolower($this->repository.'s')])->render();
        $this->createFile($this->dir.'/'.$this->repository.'Model.php',$output);
        return $this;
    }

    /**
     *
     * Create Interface File
     *
     */

    private function createInterfaceFile()
    {
        $output = view('generators.repository.interface',['repository'=>$this->repository])->render();
        $this->createFile($this->dir.'/'.$this->repository.'Interface.php',$output);
        return $this;
    }

     /**
     *
     * Create Provider File
     *
     */

    private function createProviderFile()
    {
        $output = view('generators.repository.provider',['repository'=>$this->repository])->render();
        $this->createFile($this->dir.'/'.$this->repository.'ServiceProvider.php',$output);
        return $this;
    }



    /**
     *
     * Create Files
     *
     */
    
    protected function createFile($migrationFile,$output)
    {
        $migrationString = str_replace("\\","/",$migrationFile );
        if (!file_exists($migrationFile) && $fs = fopen($migrationFile, 'x')) {
            fwrite($fs, $output);
            fclose($fs);
            $this->info('Create file '.$migrationString. ' successfully');
            return true;
        }
        $this->info('Can\'t create file '.$migrationFile);
        return false;
    }
}
