<?php
namespace OneThink\OrmBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeModelCommand extends Command
{
    protected static $defaultName = 'onethink:make:model';

    protected $namesapce;

    protected $app_dir;

    protected $root_path;

    protected $model_path = 'Model';

    /**
     * SymfonyStyle
     *
     * @var SymfonyStyle
     */
    protected $io;

    protected function configure()
    {
        $this
            ->setDescription('generate a Model for think orm')
            ->addArgument('model', InputArgument::OPTIONAL, "model name")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $this->io = new SymfonyStyle($input, $output);
        $model = $input->getArgument('model');
        if(!$model){
            $model = $this->io->ask('model name?');
            if(!$model){
                $this->io->error('Not found model name');
                return 0;
            }
        }
        $this->baseInfo();
        $path_model = $this->getPathModel($model);
        $this->createModelDir($path_model);
        $this->createModelFile($path_model);
        return 0;
    }

    public function baseInfo()
    {
        $application = $this->getApplication();
        $container = $application->getKernel()->getContainer();
        $this->root_path = $container->getParameter('kernel.project_dir');
        $composer = json_decode(file_get_contents($this->root_path . '/composer.json'), true);
        $namesapce_info = $composer['autoload']['psr-4'];
        foreach($namesapce_info as $namesapce => $app_dir){
            $this->namespace = strpos($namesapce, '\\') === false ? $namesapce. '\\' : $namesapce;
            $this->app_dir = strpos($app_dir, '/') === false ? $app_dir. '/' : $app_dir;
        }
    }

    public function createModelDir($path_model):bool
    {
        array_pop($path_model);
        $dir_path = $this->root_path. DIRECTORY_SEPARATOR . $this->app_dir . $this->model_path . DIRECTORY_SEPARATOR .implode(DIRECTORY_SEPARATOR, $path_model);
        if(!is_dir($dir_path)){
            mkdir($dir_path, '0777', true);
        }
        return true;
    }

    public function getPathModel($path_model)
    {
        $path_model = str_replace('\\', '/', $path_model);
        $path_model = explode(DIRECTORY_SEPARATOR, $path_model);
        array_map(function($path){
            return ucwords($path);
        }, $path_model);
        return $path_model;
    }

    public function createModelFile($path_model)
    {
        $class_name = end($path_model);
        $file_path = $this->app_dir . $this->model_path . DIRECTORY_SEPARATOR .implode(DIRECTORY_SEPARATOR, $path_model) . '.php';
        $full_path = $this->root_path . DIRECTORY_SEPARATOR . $file_path;
        if(file_exists($full_path)){
            $this->io->error('The file "' . $file_path . '" can\'t be generated because it already exists.');
            return false;
        }else{
            $namesapce = $this->getNamesapce($path_model);
            file_put_contents($full_path, $this->getModelContent($namesapce, $class_name));
            $this->io->success('created: '. $file_path);
            return true;
        }
    }

    public function getNamesapce($path_model)
    {
        array_pop($path_model);
        array_unshift($path_model, $this->model_path);
        return $this->namespace . implode('\\', $path_model);
    }

    public function getModelContent($namesapce, $class_name)
    {
        return <<<EOF
<?php
namespace $namesapce;

use think\Model;

class $class_name extends Model
{

}
EOF;
    }
}
