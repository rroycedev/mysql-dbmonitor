<?php

namespace App\Http\Controllers;

use App\Models\DNSAlias;
use Illuminate\Http\Request;

class DNSAliasAdminController extends Controller
{
    public function dnsaliases()
    {
        $rows = DNSAlias::orderBy('name')->get();

        return view('admin.dnsaliases', array("aliases" => $rows));
    }

    public function addDNSAlias()
    {
        return view('admin.dnsalias.add');
    }

    public function updateDNSAlias($alias_id)
    {
        $dnsAlias = DNSAlias::where("alias_id", $alias_id)->get()[0];

        return view('admin.dnsalias.edit', array("alias" => $dnsAlias));
    }

    public function deleteDNSAlias($alias_id)
    {
        $dnsAlias = DNSAlias::where("alias_id", $alias_id)->get()[0];

        return view('admin.dnsalias.delete', array("alias" => $dnsAlias));
    }

    public function performAddDNSAlias(Request $request)
    {
        $name = $request->input('name');
        $isVip = $request->input('isvip');
        $active = $request->input('active');
        $vipPort = $request->input('vipport');

        $dnsAlias = new DNSAlias();

        $dnsAlias->name = $name;
        $dnsAlias->is_vip = $isVip;

        if ($isVip == "1") {
                $dnsAlias->vip_port = $vipPort;
        }
        else {
            $dnsAlias->vip_port = 0;
        }

        $dnsAlias->active = $active;

        try {
            $dnsAlias->save();

            return redirect('/admin/dnsalias')->with('msg', 'DNS alias has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }

    public function performUpdateDNSAlias(Request $request)
    {
        $alias_id = $request->input('alias_id');

        $name = $request->input('name');
        $isVip = $request->input('isvip');
        $active = $request->input('active');
        $vipPort = $request->input('vipport');

        $dnsAlias = DNSAlias::find($alias_id);

        $dnsAlias->name = $name;
        $dnsAlias->is_vip = $isVip;

        if ($isVip == "1") {
                $dnsAlias->vip_port = $vipPort;
        }
        else {
            $dnsAlias->vip_port = 0;
        }

        $dnsAlias->active = $active;

        try {
            $dnsAlias->save();

            return redirect('/admin/dnsalias')->with('msg', 'DNS alias has been saved successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }

    public function performDeleteDNSAlias(Request $request)
    {
        $alias_id = $request->input('alias_id');

        $dnsAlias = DNSAlias::find($alias_id);

        try {
            $dnsAlias->delete();

            return redirect('/admin/dnsalias')->with('msg', 'DNS alias has been deleted successfully');
        } catch (Illuminate\Database\QueryException $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        } catch (\PDOException $pdoEx) {
            return back()->withInput()->with('error', $pdoEx->getMessage());
        }

    }
}
