<?php namespace App\Console\Commands\Mytour;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use File;

class RemoveRepositoryCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'repository:remove';

	protected $component = null;
	protected $dir = '';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Remove repository.';

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
		$this->dir = app_path('Repository/'.$this->component);
		$removeDir = $this->removeComponentDir();

		if($removeDir){
			$this->removeAutoloadConfig();
			$this->info('Remove Component Successfuly');
		}
	}

	private function removeAutoloadConfig()
	{
		$search = [
		"\"App\Repository\\".$this->component."\\".$this->component."ServiceProvider\",",
		];

		$replace = [
		""
		];

		$Component = base_path('config/app.php');
		$output     = file_get_contents($Component);
		$output     = str_replace($search, $replace, $output);
		file_put_contents($Component, $output);
		$this->info('Remove Autoload '.$this->component.'ServiceProvider successfully');
	}
	/**
	 *
	 * Remove Component
	 * @return bool
	 */

	private function removeComponentDir()
	{
		var_dump($this->dir);
		$success = File::deleteDirectory($this->dir);
		return $success;
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
