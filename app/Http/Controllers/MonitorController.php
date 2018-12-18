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

use Illuminate\Support\Facades\DB;

class MonitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function all()
    {
        return view('monitor.all');
    }

    public function specific()
    {
        return view('monitor.specific');
    }    
}
