<?php

namespace App\Http\Controllers\server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Debugbar;
use Hash;

class ServerController extends Controller
{
    
    public function index(Request $request)
    {
        $DataBag = [];
        Debugbar::info(array(1,2,3));
Debugbar::error('Error!');
Debugbar::warning('Watch out…');
Debugbar::addMessage('Another message', 'mylabel');
        return view('server.index', $DataBag);
    }

    public function systemInfo(Request $request)
    {
        $DataBag = [];

        $getPhpVersion = $this->phpVersionInfo();
        $DataBag['php_version'] = json_decode($getPhpVersion, true);
        
        $DataBag['laravel_version'] = app()->version();
        $DataBag['php_port'] = $_SERVER['SERVER_PORT'];
        
        $getRequireExtensions = $this->extensionsForLaravel();
        $DataBag['require_extensions'] = json_decode($getRequireExtensions, true);
        $DataBag['have_extension_error'] = in_array('N', $DataBag['require_extensions']) ? true : false;

        $getServerDetails = $this->serverDetailsInfo();
        $DataBag['server_details'] = json_decode($getServerDetails, true);
        
        return view('server.system_information', $DataBag);
    }

    public function phpInfo(Request $request)
    {
        phpinfo();
    }

    public function extensionsForLaravel()
    {
        $requireExtensions = [];
        $requireExtensions['BCMath_PHP_Extension'] = extension_loaded('bcmath') ? 'Y' : 'N';
        $requireExtensions['Ctype_PHP_Extension'] = extension_loaded('ctype') ? 'Y' : 'N';
        $requireExtensions['Fileinfo_PHP_Extension'] = extension_loaded('fileinfo') ? 'Y' : 'N';
        $requireExtensions['JSON_PHP_Extension'] = extension_loaded('json') ? 'Y' : 'N';
        $requireExtensions['Mbstring_PHP_Extension'] = extension_loaded('mbstring') ? 'Y' : 'N';
        $requireExtensions['OpenSSL_PHP_Extension'] = extension_loaded('openssl') ? 'Y' : 'N';
        $requireExtensions['PDO_PHP_Extension'] = extension_loaded('pdo') ? 'Y' : 'N';
        $requireExtensions['Tokenizer_PHP_Extension'] = extension_loaded('tokenizer') ? 'Y' : 'N';
        $requireExtensions['XML_PHP_Extension'] = extension_loaded('xml') ? 'Y' : 'N';
        return json_encode($requireExtensions);
    }

    public function phpVersionInfo()
    {
        $phpVersion = [];
        $phpVersion['php_version'] = PHP_VERSION;
        $phpVersion['php_major_version'] = PHP_MAJOR_VERSION;
        $phpVersion['php_minor_version'] = PHP_MINOR_VERSION;
        return json_encode($phpVersion);
    }

    public function serverDetailsInfo()
    {
        $serverInfo = [];
        $serverInfo['server_name'] = $_SERVER['SERVER_NAME'];
        $serverInfo['http_host'] = $_SERVER['HTTP_HOST'];
        $serverInfo['http_user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $serverInfo['getway_interface'] = $_SERVER['GATEWAY_INTERFACE'];
        $serverInfo['server_address'] = $_SERVER['SERVER_ADDR'];
        $serverInfo['server_software'] = $_SERVER['SERVER_SOFTWARE'];
        $serverInfo['server_protocol'] = $_SERVER['SERVER_PROTOCOL'];
        $serverInfo['server_admin'] = $_SERVER['SERVER_ADMIN'];
        $serverInfo['server_signature'] = $_SERVER['SERVER_SIGNATURE'];
        return json_encode($serverInfo);
    }

    public function activeExtensions(Request $request)
    {
        $DataBag = [];
        $DataBag['loaded_extensions'] = get_loaded_extensions();
        return view('server.activated_extensions', $DataBag);
    }

    public function serverInfo(Request $request)
    {
        $DataBag = [];
        $DataBag['server'] = $_SERVER;
        return view('server.server_information', $DataBag);
    }

    public function laravelInfo(Request $request)
    {
        $DataBag = [];
        $DataBag['paths'] = json_decode($this->pathDetails(), true);
        $DataBag['writables'] = json_decode($this->checkWritable(), true);
        $DataBag['is_env_exist'] = $this->isEnvExist();
        $DataBag['envs'] = $this->getEnvDetails();
        $DataBag['composer'] = $this->composerDetails();
        $DataBag['package'] = $this->packageDetails();
        return view('server.laravel_information', $DataBag);
    }

    public function pathDetails()
    {
        $paths = [];
        $paths['base_path'] = base_path();
        $paths['app_path'] = app_path();
        $paths['public_path'] = public_path();
        $paths['config_path'] = config_path();
        $paths['database_path'] = database_path();
        $paths['resource_path'] = resource_path();
        $paths['storage_path'] = storage_path();
        return json_encode($paths);
    }

    public function checkWritable()
    {
        $arr = [];
        $arr['is_cache_dir_writable'] = is_writable(base_path('bootstrap/cache')) ? '<span style="color: green;">YES</span>' : '<span style="color: red;">NO</span>';
        $arr['is_storage_dir_writable'] = is_writable(storage_path()) ? '<span style="color: green;">YES</span>' : '<span style="color: red;">NO</span>';
        if ($this->isEnvExist()) {
            $arr['is_env_file_writable'] = is_writable(base_path('.env')) ? '<span style="color: green;">YES</span>' : '<span style="color: red;">NO</span>';
        }
        return json_encode($arr);
    }

    public function getEnvDetails()
    {
        return $_ENV;
    }

    public function isEnvExist()
    {
        $env = base_path('.env');
        if (!file_exists($env)) {
            return false;
        }
        return true;
    }

    public function composerDetails()
    {
        if (file_exists(base_path('composer.json'))) {
            return json_decode(file_get_contents(base_path('composer.json')), true);
        }
        return [];
    }

    public function packageDetails()
    {
        if (file_exists(base_path('package.json'))) {
            return json_decode(file_get_contents(base_path('package.json')), true);
        }
        return [];
    }

    public function login(Request $request)
    {
        $DataBag = [];
        return view('server.login', $DataBag);
    }

    public function checkLogin(Request $request)
    {
        $DataBag = [];
        $DataBag['isSuccess'] = 1;
        $DataBag['status'] = 200;
        $DataBag['msg'] = "Login successfully done! Thankyou.";
        $userID = $request->input('user_id');
        $password = $request->input('password');
        $pin = $request->input('pin');
        if (!$request->get('teamLogin')) {
            $DataBag['isSuccess'] = 0;
            $DataBag['status'] = 400;
            $DataBag['msg'] = "Something went wrong! Query parameter missmatch.";
            return response()->json($DataBag, $DataBag['status']);
        }
        if ($request->header('devteam') != 'creativesyntaxsolutions' && $request->header('devname') != 'arindamroy') {
            $DataBag['isSuccess'] = 0;
            $DataBag['status'] = 400;
            $DataBag['msg'] = "Something went wrong! Header parameter missmatch.";
            return response()->json($DataBag, $DataBag['status']);
        }
        if (!file_exists(base_path('core.json'))) {
            $DataBag['isSuccess'] = 0;
            $DataBag['status'] = 400;
            $DataBag['msg'] = "Something went wrong! Core file not found in the system.";
            return response()->json($DataBag, $DataBag['status']);
        }
        $core = json_decode(file_get_contents(base_path('core.json')), true);
        if (count($core) == 0) {
            $DataBag['isSuccess'] = 0;
            $DataBag['status'] = 400;
            $DataBag['msg'] = "Something went wrong in Core file.";
            return response()->json($DataBag, $DataBag['status']);
        }
        if (!$core['coreLogin']) {
            $DataBag['isSuccess'] = 0;
            $DataBag['status'] = 400;
            $DataBag['msg'] = "Core login is in disable state.";
            return response()->json($DataBag, $DataBag['status']);
        }
        if (base64_decode($core['login']['username']) != $userID) {
            $DataBag['isSuccess'] = 0;
            $DataBag['status'] = 400;
            $DataBag['msg'] = "User ID is invalid.";
            return response()->json($DataBag, $DataBag['status']);
        }
        if (!Hash::check($password, $core['login']['password'])) {
            $DataBag['isSuccess'] = 0;
            $DataBag['status'] = 400;
            $DataBag['msg'] = "Password is incorrect.";
            return response()->json($DataBag, $DataBag['status']);
        }
        if (md5($pin) != $core['login']['pin']) {
            $DataBag['isSuccess'] = 0;
            $DataBag['status'] = 400;
            $DataBag['msg'] = "Pin is invalid.";
            return response()->json($DataBag, $DataBag['status']);
        }
        if ($DataBag['isSuccess'] == 1) {
            Session::put('devCoreLogin', true);
        }
        return response()->json($DataBag, $DataBag['status']);
    }

    public function logout()
    {
        Session::put('devCoreLogin', false);
        Session::flush();
        return redirect()->route('dev.login')
            ->with('msg_title', 'Goodbey!')
            ->with('msg', 'You has been logout successfully.')
            ->with('msg_class', 'alert alert-success');
    }
}
