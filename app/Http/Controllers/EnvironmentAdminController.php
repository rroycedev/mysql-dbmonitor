<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Controller
 *
 * PHP version 7
 *
 * @category  File
 * @package   MySQLDbmonitor
 * @author    Ronald Royce <rroycedev@gmail.com>
 * @copyright 2018 Ronald Royce
 * @license   GPL http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      http://www.rroycedev.com/
 **/

namespace App\Http\Controllers;

use App\Models\Environment;
use Illuminate\Http\Request;

class EnvironmentAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function environments()
    {
        $rows = Environment::orderBy('view_order')->get();

        return view('admin.environments', array("environments" => $rows));
    }

    public function addEnvironment()
    {
        return view('admin.environment.add');
    }

    public function updateEnvironment($environment_id)
    {
        $environment = Environment::where("environment_id", $environment_id)->get()[0];

        return view('admin.environment.edit', array("environment" => $environment));
    }

    public function deleteEnvironment($environment_id)
    {
        $environment = Environment::where("environment_id", $environment_id)->get()[0];

        return view('admin.environment.delete', array("environment" => $environment));
    }

    public function performAddEnvironment(Request $request)
    {
        $name = $request->input('name');
        $viewOrder = $request->input('view_order');

        $environment = new Environment();

        $environment->name = $name;
        $environment->view_order = $viewOrder;

        try {
            $environment->save();

            return redirect('/admin/environment')->with('msg', 'Environment has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }

    public function performUpdateEnvironment(Request $request)
    {
        $environment_id = $request->input('environment_id');

        $name = $request->input('name');
        $viewOrder = $request->input('view_order');

        $environment = Environment::find($environment_id);

        $environment->name = $name;
        $environment->view_order = $viewOrder;

        try {
            $environment->save();

            return redirect('/admin/environment')->with('msg', 'Environment has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }

    public function performDeleteEnvironment(Request $request)
    {
        $environment_id = $request->input('environment_id');

        $environment = Environment::find($environment_id);

        try {
            $environment->delete();

            return redirect('/admin/environment')->with('msg', 'Environment has been deleted successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }
}
