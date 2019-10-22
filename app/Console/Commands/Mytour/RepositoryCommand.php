<?php namespace App\Console\Commands\Mytour;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RepositoryCommand extends Command {
	
/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'repository:make';

	protected $component = null;
	protected $dir = '';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create repository.';

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
	public function fire()
	{
		$this->component = $this->argument('component');
		$this->dir = base_path('Repository/'.$this->component);
		$this->createComponent();
	}

	/*
*	 *
	 * @author Manh Quyen Ta
	 * @return string
	 *
	 */
	
	public function createComponent()
	{
		try{
			$this->createComponentDir()
			     ->createUnitTestFile()
			     ->createInterfaceFile()
			     ->createRepositoryFile()
			     ->createModelFile()
			     ->createProviderFile()
			     ->createFacadeFile()
			     ->injectAutoload()
			     ->info("Component create successfully");
		 } catch( Exception $e){
		 	$this->info($e);
		 }
	}

	private function createUnitTestFile()
	{
		$output = view('generators.components.unit_test',['component'=>$this->component])->render();
		$this->createFile($this->dir.'/'.$this->component.'UnitTest.php',$output);
		return $this;
	}

	private function createFacadeFile()
	{
		$output = view('generators.components.facade',['component'=>$this->component])->render();
		$this->createFile($this->dir.'/'.$this->component.'Facade.php',$output);
		return $this;
	}

	private function createRepositoryFile()
	{
		$output = view('generators.components.repository',['component'=>$this->component])->render();
		$this->createFile($this->dir.'/'.$this->component.'Repository.php',$output);
		return $this;
	}

	private function createModelFile()
	{
		$output = view('generators.components.model',['component'=>$this->component,'table'=>strtolower($this->component.'s')])->render();
		$this->createFile($this->dir.'/'.$this->component.'Model.php',$output);
		return $this;
	}

	private function createInterfaceFile()
	{
		$output = view('generators.components.interface',['component'=>$this->component])->render();
		$this->createFile($this->dir.'/'.$this->component.'Interface.php',$output);
		return $this;
	}

	private function createProviderFile()
	{
		$output = view('generators.components.provider',['component'=>$this->component])->render();
		$this->createFile($this->dir.'/'.$this->component.'ServiceProvider.php',$output);
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

	protected function injectAutoload(){

		$search = [
		"// Repository Provider",
		"// Repository Alias"
		];

		$replace = [
		"// Component Provider\n        \"App\Components\\".$this->component."\\".$this->component."ServiceProvider\",",
		//"// Component Alias\n        '".$this->component."Component'    =>  \"App\Components\\".$this->component."\\".$this->component."Facade\","
		];

		$ComponentProvider = base_path('config/app.php');
		$output     = file_get_contents($ComponentProvider);
		$output     = str_replace($search, $replace, $output);
		file_put_contents($ComponentProvider, $output);

		$this->info('Autoload '.$this->component.'ServiceProvider successfully');
		return $this;
	}


	private function createComponentDir()
	{
		$dir = base_path('app/Repository').'/'.$this->component;
		try{
			if(mkdir($dir)){
				$this->dir = $dir;
				$this->info('Create dir '. $this->component.' successfully');
			}else{
				return $this->info('Can\'t create dir '. $this->component);
			}
		}catch( Exception $e){
			return $this->info('Component is exists');
		}
		return $this;
	}
	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['component', InputArgument::REQUIRED, 'Component name.'],
		];
	}
}
