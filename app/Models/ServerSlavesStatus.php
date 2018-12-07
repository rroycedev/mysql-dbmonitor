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

class ServerSlavesStatus extends Model
{
    protected $table = "server_slaves_status";
    protected $primaryKey = "server_slave_status_id";

    public $timestamps = false;

    public $port_name = "";

    protected $attributes = [
    ];

    protected $fillable = ['connection_name', 'master_binlog_filename', 'master_binlog_position', 'lag_time_secs', 'check_datetime'];

}
