<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Model
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

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CPULoadAlert extends Model
{
    protected $table = "cpu_load_alerts";
    protected $primaryKey = "server_id";

    public $timestamps = false;

    protected $attributes = [
    ];

    protected $fillable = ['warning_level', 'error_level'];

}
