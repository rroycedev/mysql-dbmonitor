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

use App\Models\Datacenter;
use Auth;
use Illuminate\Http\Request;

class DatacenterAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'acl:view_data']);
    }

    public function datacenters()
    {
        $rows = Datacenter::orderBy('view_order')->get();

        return view('admin.datacenters', array("datacenters" => $rows));
    }

    public function addDatacenter()
    {
        $canEdit = false;

        foreach (Auth::user()->roles[0]->permissions as $p) {
            if ($p["permission_slug"] == "manage_data") {
                $canEdit = true;
            }
        }

        return view('admin.datacenter.add', array("canEdit" => $canEdit));
    }

    public function updateDatacenter($datacenter_id)
    {
        $datacenter = Datacenter::where("datacenter_id", $datacenter_id)->get()[0];

        $canEdit = false;

        foreach (Auth::user()->roles[0]->permissions as $p) {
            if ($p["permission_slug"] == "manage_data") {
                $canEdit = true;
            }
        }

        return view('admin.datacenter.edit', array("datacenter" => $datacenter, "canEdit" => $canEdit));
    }

    public function deleteDatacenter($datacenter_id)
    {
        $datacenter = Datacenter::where("datacenter_id", $datacenter_id)->get()[0];

        $canEdit = false;

        foreach (Auth::user()->roles[0]->permissions as $p) {
            if ($p["permission_slug"] == "manage_data") {
                $canEdit = true;
            }
        }

        return view('admin.datacenter.delete', array("datacenter" => $datacenter, "canEdit" => $canEdit));
    }

    public function performAddDatacenter(Request $request)
    {
        $name = $request->input('name');
        $viewOrder = $request->input('view_order');

        $datacenter = new Datacenter();

        $datacenter->name = $name;
        $datacenter->view_order = $viewOrder;

        try {
            $datacenter->save();

            return redirect('/admin/datacenter')->with('msg', 'Datacenter has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }

    public function performUpdateDatacenter(Request $request)
    {
        $datacenter_id = $request->input('datacenter_id');

        $name = $request->input('name');
        $viewOrder = $request->input('view_order');

        $datacenter = Datacenter::find($datacenter_id);

        $datacenter->name = $name;
        $datacenter->view_order = $viewOrder;

        try {
            $datacenter->save();

            return redirect('/admin/datacenter')->with('msg', 'Datacenter has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }

    public function performDeleteDatacenter(Request $request)
    {
        $datacenter_id = $request->input('datacenter_id');

        $datacenter = Datacenter::find($datacenter_id);

        try {
            $datacenter->delete();

            return redirect('/admin/datacenter')->with('msg', 'Datacenter has been deleted successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }
}
