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

class DiskAlert extends Model
{
    protected $table = "disk_alerts";
    protected $primaryKey = "alert_id";

    public $timestamps = false;

    protected $attributes = [
    ];

    protected $fillable = ['volume', 'warning_level_pct', 'error_level_pct'];

}
