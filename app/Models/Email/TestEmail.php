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

namespace App\Models\Email;

use Illuminate\Database\Eloquent\Model;

class TestEmail extends Model
{
    public $greeting = "This is the greeting";
    public $level = "success";
    public $introLines = array('Intro line 1', 'Intro line 2');
    public $actionText = "This is action text";
    public $actionUrl = "http://10.0.0.250:8000/action";
    public $outroLines = array('Outro line 1', 'Outro line 2');
    public $salutation = "Regards";

}
