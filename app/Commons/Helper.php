<?php

/**
 * Select
 * Helper to get common data
 *
 * Process overview  : Helper
 * Created date      : 12/10/2022
 * Created by        : QuyPN <quypn@outfiz.vn>
 *
 * Updated date      :
 * Updated by        :
 * Update content    :
 *
 * @package System
 * @copyright Copyright (c) outfiz.vn
 * @version 1.0.0
 */

namespace App\Commons;

use App\Commons\CodeMasters\Role as RoleConstant;
use App\Entities\User;
use App\Entities\UserInfo;
use App\Entities\Token;
use App\Entities\Role;
use App\Entities\Province;
use App\Entities\District;
use App\Entities\Commune;
use App\Entities\Option;
use App\Entities\Func;
use App\Entities\Permission;
use DB, Exception, DateTime;

class Helper
{

    public function __construct()
    {
    }

    /**
     * Get value of cookies by key
     * Created: 12/10/2022
     * @author QuyPN <quypn@outfiz.vn>
     * @param String $key
     * @param String $default
     * @return String Value of key in cookies of empty string if key not exists
     */
    public static function GetCookies($key, $default = '')
    {
        try {
            return $_COOKIE[$key];
        } catch (Exception $e) {
            return $default;
        }
    }

    /**
     * Get value from payload of jwt token
     * Created: 12/10/2022
     * @author QuyPN <quypn@outfiz.vn>
     * @param String $token
     * @return Array Value have in payload of token
     */
    public static function GetTokenPayload($token)
    {
        try {
            $tokenParts = explode(".", $token);
            $tokenHeader = base64_decode($tokenParts[0]);
            $tokenPayload = base64_decode($tokenParts[1]);
            $jwtHeader = json_decode($tokenHeader);
            $jwtPayload = json_decode($tokenPayload);
            return $jwtPayload;
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Get IP of client call request
     * Created: 12/10/2022
     * @author QuyPN <quypn@outfiz.vn>
     * @param Array Data from SPC
     * @return Array data ipaddress
     */
    public static function GetIPAddress()
    {
        try {
            return request()->ip();
        } catch (\Exception $e) {
            return '::1';
        }
    }

    /**
     * Rollback transaction if exists
     * Created: 12/10/2022
     * @author QuyPN <quypn@outfiz.vn>
     */
    public static function RollBackTrans()
    {
        try {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }
        } catch (Exception $e) {
        }
    }

    /**
     * Get id of current user loginning
     * Created: 2021/05/26
     * @author QuyPN <quypn@outfiz.vn>
     * @return Integer Id of user is loginning
     */
    public static function GetCurrentUserId()
    {
        try {
            $now = new DateTime(date('Y-m-d H:i:s'));
            $token = Token::where('bearer_token', self::GetCookies('token'))
                ->where('timeout', '>=', $now)
                ->where('deleted_at', null)->select('user_id')->first();
            return $token->user_id;
        } catch (\Exception $e) {
        }
        return 0;
    }

    /**
     * Get data of current user loginning
     * Created: 2021/05/26
     * @author QuyPN <quypn@outfiz.vn>
     * @return Array Data of user is loginning
     */
    public static function GetCurrentUser()
    {
        try {
            $user = User::with('roles')->with('info')->where('id', self::GetCurrentUserId())->where('deleted_at', null)->first();
            return $user != null ? $user->toArray() : null;
        } catch (\Exception $e) {
        }
        return null;
    }

    /**
     * Get name of user by id
     * Created: 12/10/2022
     * @author QuyPN <quypn@outfiz.vn>
     * @return String Name of user
     */
    public static function GetUsername($id)
    {
        try {
            $userDB = UserInfo::where('id', $id)
                ->select('first_name', 'last_name')
                ->first();
            if (isset($userDB) && !empty($userDB)) {
                return $userDB->first_name . ' ' . $userDB->last_name;
            }
            return __('System');
        } catch (Exception $e) {
            return __('System');
        }
    }

    /**
     * Get roles of system follow current user
     * Created: 2021/05/26
     * @author QuyPN <quypn@outfiz.vn>
     * @return Array Data of roles
     */
    public static function GetRoles()
    {
        try {
            $user = self::GetCurrentUser();
            if ($user != null) {
                $isDev = array_search(RoleConstant::DEV(), array_column($user['roles'], 'id'));
                $query = Role::where('deleted_at', null)->whereNot('id', RoleConstant::USER());
                if ($isDev !== false) {
                    return $query->select('id', 'name')->get()->toArray();
                } else {
                    return $query->whereNot('id', RoleConstant::DEV())->select('id', 'name')->get()->toArray();
                }
            }
        } catch (\Exception $e) {
        }
        return [];
    }

    /**
     * Get list of provinces
     * Created: 2021/05/26
     * @author QuyPN <quypn@outfiz.vn>
     * @return Array Data of provinces
     */
    public static function GetProvinces()
    {
        try {
            return Province::where('deleted_at', null)->orderBy('sort')->select('id', 'name')->get()->toArray();
        } catch (\Exception $e) {
        }
        return [];
    }

    /**
     * Get list of districts
     * Created: 2021/05/26
     * @author QuyPN <quypn@outfiz.vn>
     * @return Array Data of districts
     */
    public static function GetDistricts($province_id)
    {
        try {
            return District::where('deleted_at', null)->where('province_id', $province_id)->select('id', 'name')->get()->toArray();
        } catch (\Exception $e) {
        }
        return [];
    }

    /**
     * Check user can access route or not
     * Created: 04/11/2022
     * @author QuyPN <quypn@outfiz.vn>
     * @param Integer $user_id id of user need to check
     * @param String $route_name name of route user want to access
     * @return Boolean true if can access, false if not have permission.
     */
    public static function HavePermission($user_id, $route_name)
    {
        try {
            $fnc = Func::where('deleted_at', NULL)->where('route_name', $route_name)->first();
            if ($fnc == null) {
                return true;
            }
            $roles = array_column(
                DB::table('user_roles')->where('deleted_at', NULL)
                    ->where('user_id', $user_id)
                    ->select('role_id')->get()->toArray(),
                'role_id'
            );
            $permissions = Permission::where('deleted_at', NULL)
                ->whereIn('role_id', $roles)
                ->where('function_id', $fnc->id)
                ->select('role_id', 'function_id', 'is_enabled')
                ->get();
            foreach ($permissions as $permission) {
                if ($permission->is_enabled) {
                    return true;
                }
            }
            return false;
        } catch (\Exception $e) {
        }
        return true;
    }

    /**
     * Check user can execute a function or not
     * Created: 04/11/2022
     * @author QuyPN <quypn@outfiz.vn>
     * @param String $route_name name of route user want to access
     * @return Boolean true if can access, false if not have permission.
     */
    public static function CannAccess($route_name)
    {
        try {
            $adminState = session('adminState');
            $fnc = $adminState['functions'] ?? [];
            return in_array($route_name, $fnc);
        } catch (\Exception $e) {
        }
        return false;
    }

    /**
     * Get list of communes
     * Created: 2021/05/26
     * @author QuyPN <quypn@outfiz.vn>
     * @return Array Data of communes
     */
    public static function GetCommunes($district_id)
    {
        try {
            return Commune::where('deleted_at', null)->where('district_id', $district_id)->select('id', 'name')->get()->toArray();
        } catch (\Exception $e) {
        }
        return [];
    }

    /**
     * Check value of key in array is null or empty
     * Created: 12/10/2022
     * @author QuyPN <quypn@outfiz.vn>
     * @param Array $arr Array need to check
     * @param String $key key have value need to check
     * @return Boolean
     */
    public static function IsNullOrEmpty($arr, $key)
    {
        try {
            if (!isset($arr) || empty($arr) || !isset($arr[$key]) || empty($arr[$key]) || $arr[$key] == null || $arr[$key] == '') {
                return true;
            }
            return false;
        } catch (Exception $e) {
            return true;
        }
    }

    /**
     * Get uuid
     * Created: 2021/05/26
     * @author QuyPN <quypn@outfiz.vn>
     * @return String uuid v4
     */
    public static function GenerateUuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    /**
     * Create a random string
     * Created: 2021/05/26
     * @author QuyPN <quypn@outfiz.vn>
     * @param Integer length of string will be generate. Default is 100
     * @return String uuid v4
     */
    public static function GenerateRandomString($length = 100)
    {
        try {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString . Helper::GenerateUuid();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Check have error data from SPC or not
     * Created: 2021/05/26
     * @author QuyPN <quypn@outfiz.vn>
     * @param Array Data from SPC
     * @return Boolean true - if not error, false - if have error from DB, Exception if SPC have exception
     */
    public static function HasDatabaseError($data)
    {
        try {
            if (empty($result)) return false; // haven't error
            // Check SQL error
            if (isset($result[0][0]['error_typ']) && $result[0][0]['error_typ'] != 0) {
                // SQL Exception
                if ($result[0][0]['error_typ'] == 999) throw new \Exception($result[0][0]['remark']);
                // Logic error
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get Id insert of table
     * Created: 2021/05/26
     * @author QuyPN <quypn@outfiz.vn>
     * @param String $table Name of table want to get new Id
     * @return Integer New id of table
     */
    public static function GetNewId($table)
    {
        try {
            $getLastID = DB::table($table)->select('id')->orderBy('id', 'DESC')->first();
            if ($getLastID == null) {
                return 1;
            } else {
                return ++$getLastID->id;
            }
        } catch (Exception $e) {
            return -1;
        }
    }

    /**
     * Get data of option follow by key
     * Created: 2021/05/26
     * @author QuyPN <quypn@outfiz.vn>
     * @param String $id option key need to get
     * @return Array|Boolean|String Value of option, false if not found key
     */
    public static function GetOptions($id)
    {
        try {
            $val = Option::where('deleted_at', null)
                ->where('id', $id)
                ->first();
            $result = json_decode($val->value);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $result;
            }
            return $val->value;
        } catch (Exception $e) {
        }
        return false;
    }

    /**
     * Escape string before render sql
     * Created: 12/10/2022
     * @author QuyPN <quypn@outfiz.vn>
     * @param String $str string need to escape
     * @return String string after  escape
     */
    public static function SqlEscString($str)
    {
        try {
            $ret = str_replace(['%', '_'], ['\%', '\_'], DB::getPdo()->quote($str));
            return $ret && strlen($ret) >= 2 ? substr($ret, 1, strlen($ret) - 2) : $ret;
        } catch (Exception $e) {
            return $str;
        }
    }

    public static function SaveFileImg($file, $folder = 'upload_file/', $filename = '', $maxSize = 10, $typeFiles = ['png', 'jpg', 'jpeg'])
    {
        $status = false;
        $error = 'E023';
        $path = '';
        try {
            if (isset($file)) {
                $extension = $file->getClientOriginalExtension();
                $size = $file->getSize();
                $filename = $filename . '_' . date('YmdHis') . time() . '.' . $extension;
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                if (in_array($extension, $typeFiles)) {
                    if ($size / 1024 / 1024 > $maxSize) {
                        $error = 'E020';
                    } else {
                        $path = $folder . $filename;
                        if (file_exists($path)) {
                            unlink($path);
                        }
                        $status = true;
                        $error = '';
                        $file->move($folder, $filename);
                        $path = '/' . $path;
                    }
                } else {
                    $error = 'E021';
                }
            } else {
                $error = 'E024';
            }
        } catch (Exception $e) {
        }
        return [
            'status' => $status,
            'error' => $error,
            'path' => $path
        ];
    }
    public static function DeleteFile($path)
    {
        try {
            if (file_exists($path)) {
                unlink($path);
            }
        } catch (Exception $e) {
        }
    }
}
