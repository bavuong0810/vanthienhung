<?php

use GuzzleHttp\Client;

include_once __ROOT_PATH . '/admin/consts/index.php';
include_once __ROOT_PATH . '/admin/lib/form.php';
include_once __ROOT_PATH . '/admin/lib/VietGuys.php';
include_once __ROOT_PATH . '/admin/lib/constants.php';


if (!defined('SITE_DOMAIN')) {
    define('SITE_DOMAIN', $currentDomain);
}
global $smsSender;

class func_index
{
    // global $rf;
    var $db = null;
    var $result = "";
    var $insert_id = "";
    var $sql = "";
    var $table = "";
    var $where = "";
    var $order = "";
    var $limit = "";

    var $servername = "";
    var $username = "";
    var $password = "";
    var $database = "";
    var $refix = "";
    var $common_table_prefix = "";
    var $common_tables = [];

    function func_index($config = array())
    {
        if (!empty($config)) {
            $this->init($config);
            $this->connect();
        }

        if (isset($_SESSION["user_hash"])) {
            $this->cacheTTL = 30;
        }
    }

    var $memcached;
    var $disableNextCache = false;
    var $cacheTTL = 600;
    var $cachedHit = 0;
    var $cachedHitMissed = 0;
    var $queries = [];
    var $missedQueries = [];

    function init($config = array())
    {
        foreach ($config as $k => $v) {
            $this->$k = $v;
        }

        $this->memcached = new Memcached();

        $this->memcached->addServer(
            getenv('MEMCACHED_HOST') ?: 'memcached',
            getenv('MEMCACHED_PORT') ?: 11211,
        );
    }

    function connect()
    {
        try {
            $this->db = new PDO("mysql:host=$this->servername;dbname=$this->database;charset=utf8", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("set names utf8");
            // echo "Connected successfully";

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        // mysql_query('SET NAMES "utf8"',$this->db);
    }

    function disconnect()
    {
        $this->db = null;
        echo '<!--- memcached hit: ' . $this->cachedHit . ' missed: ' . $this->cachedHitMissed . ' --->';
        echo '<!--- QUERIES: ' . var_export($this->queries, true) . ' --->';
        echo '<!--- Missed queries: ' . var_export($this->missedQueries, true) . ' --->';
    }

    // Function to get the client IP address
    function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

    function catchuoi($chuoi, $gioihan)
    {
        $chuoi = strip_tags($chuoi);
        if (strlen($chuoi) <= $gioihan) {
            return $chuoi;
        } else {
            if (strpos($chuoi, " ", $gioihan) > $gioihan) {
                $new_gioihan = strpos($chuoi, " ", $gioihan);
                $new_chuoi = substr($chuoi, 0, $new_gioihan) . " ...";
                return $new_chuoi;
            }
            $new_chuoi = substr($chuoi, 0, $gioihan);
            return $new_chuoi;
        }
    }

    function catchuoi_new($text, $n = 80)
    {
        // string is shorter than n, return as is
        if (strlen($text) <= $n) {
            return $text;
        }
        $text = substr($text, 0, $n);
        if ($text[$n - 1] == ' ') {
            return trim($text) . "...";
        }
        $x = explode(" ", $text);
        $sz = sizeof($x);
        if ($sz <= 1) {
            return $text . "...";
        }
        $x[$sz - 1] = '';
        return trim(implode(" ", $x)) . "...";
    }

    function bodautv($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|�� �|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|�� �|ợ|ớ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|�� �|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|�� �|Ợ|Ở|Ớ|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/( )/", '-', $str);
        $str = preg_replace("/(\?)/", '-', $str);
        $str = preg_replace("/(:)/", '-', $str);
        $str = preg_replace("/(&)/", '', $str);
        $str = preg_replace("/,/", '-', $str);
        $str = preg_replace("/-+-/", '-', $str);

        $str = trim($str, '-');
        return $str;
    }

    function beforeStart($sql = null)
    {
        $this->sql = str_replace('#_', $this->refix, $sql ?: $this->sql);
        $this->sql = str_replace('PREFIX_', $this->refix, $this->sql);

        if (count($this->common_tables) > 0) {
            foreach ($this->common_tables as $table_name) {
                $this->sql = str_replace($this->refix . $table_name, $this->common_table_prefix . $table_name, $this->sql);
            }
        }
    }

    function select($str = "*")
    {
        $this->sql = "select " . $str;
        $this->sql .= " from " . '#_' . $this->table;
        $this->sql .= $this->where;
        $this->sql .= $this->order;
        $this->sql .= $this->limit;
        $this->beforeStart();
        return $this->query();
    }

    function query($sql)
    {
        $this->beforeStart($sql);
        $stmt = $this->db->prepare($this->sql);
        // $stmt->execute();
        return $stmt->execute();
    }

    function fetch_array($sql)
    {
        $this->beforeStart($sql);
        $result = $this->getCache($sql);
        if ($result && $this->memcached->getResultCode() === Memcached::RES_SUCCESS) {
            $this->cachedHit++;
            return $result;
        } else {
            $this->cachedHitMissed++;
        }
        $stmt = $this->db->prepare($this->sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        $this->setCache($this->sql, $result, $this->cacheTTL);
        return $result;
    }

    public function fetch()
    {
        $this->beforeStart();

        $timeStart = microtime(true);
        // file_put_contents(__ROOT_PATH . '/queries.data', str_replace("\n", '', $this->sql) . "\n", FILE_APPEND);
        $result = $this->getCache($this->sql);
        if ($result && $this->memcached->getResultCode() === Memcached::RES_SUCCESS) {
            $this->cachedHit++;
            return $result;
        } else {
            $this->cachedHitMissed++;
        }

        $stmt = $this->db->prepare($this->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $queryCost = timer_diff($timeStart);
        if ($queryCost > 1) {
            file_put_contents(__ROOT_PATH . '/queries.data', str_replace("\n", '', $this->sql) . ' -- ' . $queryCost . "\n", FILE_APPEND);
        }

//        $this->setCache($this->sql, $result, $this->cacheTTL);
        return $result;
    }

    public function o_fet($sql)
    {
        $this->sql = $sql;
        return $this->fetch();
    }

    public function o_fet_class($sql)
    {
        $this->sql = $sql;
        return $this->fetch_class();
    }

    public function fetch_class()
    {
        $this->beforeStart();

        $result = $this->getCache($this->sql);
        if ($result && $this->memcached->getResultCode() === Memcached::RES_SUCCESS) {
            $this->cachedHit++;
            return $result;
        } else {
            $this->cachedHitMissed++;
        }

        $stmt = $this->db->prepare($this->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
//        $this->setCache($this->sql, $result, $this->cacheTTL);
        return $result;
    }

    public function o_sel($sel, $table, $where = "", $order = "", $limit = "")
    {
        if ($where != '') {
            $where = " where " . $where;
        } else {
            $where = "";
        }

        if ($order != '') {
            $order = " order by " . $order;
        } else {
            $order = "";
        }

        if ($limit != '') {
            $limit = " limit " . $limit;
        } else {
            $limit = "";
        }

        $sql = "select " . $sel . " from " . $table . " " . $where . $order . $limit;
        $this->sql = $sql;
        return $this->fetch();
        // return $sql;
    }

    public function o_que($sql)
    {
        $this->sql = $sql;
        return $this->que();
    }

    function assoc_array($sql)
    {
        $this->beforeStart($sql);

        $result = $this->getCache($this->sql);
        if ($result && $this->memcached->getResultCode() === Memcached::RES_SUCCESS) {
            $this->cachedHit++;
            return $result;
        } else {
            $this->cachedHitMissed++;
        }

        $stmt = $this->db->prepare($this->sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        $this->setCache($this->sql, $result, $this->cacheTTL);
        return $result;
    }

    function num_rows($sql)
    {
        $this->beforeStart($sql);

        $result = $this->getCache($this->sql);
        if ($result && $this->memcached->getResultCode() === Memcached::RES_SUCCESS) {
            $this->cachedHit++;
            return $result;
        } else {
            $this->cachedHitMissed++;
        }

        $stmt = $this->db->prepare($this->sql);
        $stmt->execute();
        $result = $stmt->rowCount();

//        $this->setCache($this->sql, $result, $this->cacheTTL);
        return $result;
    }

    function num()
    {
        $this->beforeStart();

        $result = $this->getCache($this->sql);
        if ($result && $this->memcached->getResultCode() === Memcached::RES_SUCCESS) {
            $this->cachedHit++;
            return $result;
        } else {
            $this->cachedHitMissed++;
        }

        $stmt = $this->db->prepare($this->sql);
        $stmt->execute();
        $result = $stmt->rowCount();

//        $this->setCache($this->sql, $result, $this->cacheTTL);
        return $result;
    }

    function que()
    {
        $this->beforeStart();
        $stmt = $this->db->prepare($this->sql);
        return $stmt->execute();
        // return $stmt->fetchAll();
    }

    function setTable($str)
    {
        $this->table = $str;
    }

    function setWhere($col, $dk)
    {
        if ($this->where == "") {
            $this->where = " where " . $col . " = '" . $dk . "'";
        } else {
            $this->where .= " and " . $col . " = '" . $dk . "'";
        }
    }

    function setWhereOrther($col, $dk)
    {
        if ($this->where == "") {
            $this->where = " where " . $col . " <> '" . $dk . "'";
        } else {
            $this->where .= " and " . $col . " <> '" . $dk . "'";
        }
    }

    function setWhereOr($col, $dk)
    {
        if ($this->where == "") {
            $this->where = " where " . $col . " = '" . $dk . "'";
        } else {
            $this->where .= " or " . $col . " = '" . $dk . "'";
        }
    }

    function setWhereRaw($raw)
    {
        if ($this->where == "") {
            $this->where = " WHERE " . $raw;
        } else {
            $this->where .= " AND " . $raw;
        }
    }

    function setOrder($str)
    {
        $this->order = " order by " . $str;
    }

    function setLimit($str)
    {
        $this->limit = " limit " . $str;
    }

    function reset()
    {
        $this->sql = "";
        $this->result = "";
        $this->where = "";
        $this->order = "";
        $this->limit = "";
        $this->table = "";
    }

    function insert($data = array())
    {
        $into = "";
        $values = "";
        foreach ($data as $int => $val) {
            $into .= "," . $int;

            if (gettype($val) === 'string') {
                $values .= ",'" . $val . "' ";
            } else {
                $values .= "," . $val . " ";
            }
        }
        if ($into[0] == ",") {
            $into[0] = "(";
        }

        $into .= ")";
        if ($values[0] == 0) {
            $values[0] = "(";
        }

        $values .= ")";

        $this->sql = "insert into " . $this->table . $into . " values " . $values;
        $this->beforeStart();

        $stmt = $this->db->prepare($this->sql);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    function replace($data = array())
    {
        $into = "";
        $values = "";
        foreach ($data as $int => $val) {
            $into .= "," . $int;

            if (gettype($val) === 'string') {
                $values .= ",'" . $val . "' ";
            } else {
                $values .= "," . $val . " ";
            }
        }
        if ($into[0] == ",") {
            $into[0] = "(";
        }

        $into .= ")";
        if ($values[0] == 0) {
            $values[0] = "(";
        }

        $values .= ")";

        $this->sql = "REPLACE INTO " . $this->table . $into . " values " . $values;
        $this->beforeStart();

        $stmt = $this->db->prepare($this->sql);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    function update($data = array())
    {
        $values = "";
        foreach ($data as $col => $val) {

            if (gettype($val) === 'string') {
                $values .= "," . $col . " = '" . $val . "' ";
            } else if ($val === NULL) {
                $values .= "," . $col . " = NULL ";
            } else {
                $values .= "," . $col . " = " . $val . " ";
            }
        }
        if ($values[0] == ",") {
            $values[0] = " ";
        }

        $this->sql = "update " . $this->table . " set " . $values . $this->where;

        $this->beforeStart();
        $this->result = $this->query($this->sql);
        return $this->result;
    }

    function isExitsValue($key, $value, $table)
    {

        $result = $this->o_fet("SELECT * FROM $table WHERE `$key`='$value'");

        if ($result) {
            return true;
        }

        return false;
    }

    function getOption($key)
    {

        $result = $this->simple_fetch("SELECT option_value_1 FROM #_options WHERE option_name='$key'");

        if ($result) {
            return $result['option_value_1'];
        }

        return false;
    }

    function getOptions($key)
    {

        $result = $this->simple_fetch("SELECT option_value_1, option_value_2 FROM #_options WHERE option_name='$key'");

        if ($result) {
            return $result;
        }

        return false;
    }

    function isExitsOption($key)
    {

        $result = $this->o_fet("SELECT * FROM #_options WHERE option_name='$key'");

        if ($result) {
            return true;
        }

        return false;
    }

    function updateOption($key, $value_1 = '', $value_2 = '')
    {
        if (empty($key)) {
            return false;
        }

        //INSERT INTO db_options (option_name, option_value_1, option_value_2) VALUES ('', '', '')
        //UPDATE db_options SET option_value_1 = '', option_value_2 = '' WHERE option_name = ''

        if ($this->isExitsOption($key)) {
            $this->sql = "UPDATE #_options SET option_value_1='$value_1', option_value_2='$value_2' WHERE option_name = '$key'";
        } else {
            $this->sql = "INSERT INTO #_options (option_name, option_value_1, option_value_2) VALUES ('$key', '$value_1', '$value_2')";
        }

        $this->beforeStart();
        $this->result = $this->query($this->sql);

        return $this->result;
    }

    function delete()
    {
        $this->sql = "delete from " . $this->table . $this->where;

        $this->beforeStart();
        return $this->query($this->sql);
    }

    // other-----------------------------
    function replaceHTMLCharacter($str)
    {
        $str = preg_replace('/&/', '&amp;', $str);
        $str = preg_replace('/</', '&lt;', $str);
        $str = preg_replace('/>/', '&gt;', $str);
        $str = preg_replace('/\"/', '&quot;', $str);
        $str = preg_replace('/\'/', '&apos;', $str);
        return $str;
    }

    function alert($str)
    {
        echo '<script language="javascript"> alert("' . $str . '") </script>';
    }

    function location($url)
    {
        echo '<script language="javascript">window.location = "' . $url . '" </script>';
    }

    function themdau($str)
    {
        $str = addslashes($str);
        return $str;
    }

    function bodau($str)
    {
        $str = stripslashes($str);
        return $str;
    }

    function vnd($money)
    {
        return number_format($money, 0, '.', '.') . ' <sup>đ</sup>';
    }

    function dolla_vnd($money)
    {
        return "$" . number_format($money, 0, '.', '.');
    }

    function usd($money)
    {
        return number_format($money, 2, ',', '.') . ' USD';
    }

    function chuoird($length)
    {
        $str = '';
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }

    // function phantrang($r, $url='', $curPg=1, $mxR=5, $mxP=5,$classunlink='', $classlink='',$getName)
    // {
    // 	if($curPg<1) $curPg=1;
    // 	if($mxR<1) $mxR=5;
    // 	if($mxP<1) $mxP=5;
    // 	$totalRows=count($r);
    // 	if($totalRows==0)
    // 		return array('source'=>NULL, 'paging'=>NULL);
    // 	$totalPages=ceil($totalRows/$mxR);
    // 	if($curPg > $totalPages) $curPg=$totalPages;

    // 	$_SESSION['maxRow']=$mxR;
    // 	$_SESSION['curPage']=$curPg;

    // 	$r2=array();
    // 	$paging="";

    // 	//-------------tao array------------------
    // 	$start=($curPg-1)*$mxR;
    // 	$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;

    // 	$j=0;
    // 	for($i=$start;$i<$end;$i++)
    // 		$r2[$j++]=$r[$i];

    // 	//-------------tao chuoi------------------
    // 	$curRow = ($curPg-1)*$mxR+1;
    // 	if($totalRows>$mxR)
    // 	{
    // 		$start=1;
    // 		$end=1;
    // 		$paging1 ="";
    // 		for($i=1;$i<=$totalPages;$i++)
    // 		{
    // 			if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
    // 			{
    // 				if($start==1) $start=$i;
    // 				if($i==$curPg){
    // 					$paging1.="<span class=\"{$classunlink}\">".$i."</span>";//dang xem
    // 				}
    // 				else
    // 				{
    // 					$paging1 .= " <a href='".$url."&".$getName."=".$i."'  class=\"{$classlink}\"><span >".$i."</span></a> ";
    // 				}
    // 				$end=$i;
    // 			}
    // 		}//tinh paging

    // 		$paging .=" <a  href='".$url."' class=\"{$classlink}\" >&laquo;</a> "; //ve dau

    // 		$paging .=" <a href='".$url."&".$getName."=".($curPg-1)."' class=\"{$classlink}\" >&#8249;</a> "; //ve truoc
    // 		#}
    // 		$paging.=$paging1;

    // 		$paging .=" <a href='".$url."&".$getName."=".($curPg+1)."' class=\"{$classlink}\" >&#8250;</a> "; //ke

    // 		$paging .=" <a href='".$url."&".$getName."=".($totalPages)."' class=\"{$classlink}\" >&raquo;</a> "; //ve cuoi
    // 	}
    // 	$r3['curPage']=$curPg;
    // 	$r3['source']=$r2;
    // 	$r3['paging']=$paging;
    // 	return $r3;
    // }
    //
    function addParam($paramName, $value, $url = '')
    {
        if (empty($url)) {
            $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }

        if (!empty($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $params);
            $params[$paramName] = $value;
        }

        $url = explode('?', $url);

        return count($params) > 0 ? $url[0] . '?' . http_build_query($params) : $url[0];
    }

    function phantrang($r, $url = '', $curPg = 1, $mxR = 5, $mxP = 5, $classunlink = '', $classlink = '', $getName)
    {

        $SIDE_COUNT = 10;

        if ($curPg < 1) {
            $curPg = 1;
        }

        if ($mxR < 1) {
            $mxR = 5;
        }

        if ($mxP < 1) {
            $mxP = 5;
        }

        $totalRows = is_array($r) ? count($r) : $r;
        $start = ($curPg - 1) * $mxR;
        $end = ($start + $mxR) < $totalRows ? ($start + $mxR) : $totalRows;

        if ($totalRows == 0) {
            return array('source' => NULL, 'paging' => NULL);
        }

        $totalPages = ceil($totalRows / $mxR);
        if ($curPg > $totalPages) {
            $curPg = $totalPages;
        }

        $_SESSION['maxRow'] = $mxR;
        $_SESSION['curPage'] = $curPg;

        $paging = "";

        //-------------tao chuoi------------------
        $curRow = ($curPg - 1) * $mxR + 1;
        if ($totalRows > $mxR) {
            $start = 1;
            $end = 1;
            $paging1 = "";
            for ($i = 1; $i <= $totalPages; $i++) {

                if ($start == 1) {
                    $start = $i;
                }

                $pageUrl = $this->addParam($getName, $i, $url);

                if ($curPg < 2) {
                    if ($i == $curPg) {
                        $paging1 .= "<span page='$i' class=\"{$classunlink}\">" . $i . "</span>"; //dang xem
                    } else if ($i > ($curPg - 3) && $i < ($curPg + 5)) {
                        $paging1 .= " <a page='$i' href='" . $pageUrl . "'  class=\"{$classlink}\"><span >" . $i . "</span></a> ";
                    }
                } else if ($curPg == 2) {
                    if ($i == $curPg) {
                        $paging1 .= "<span page='$i' class=\"{$classunlink}\">" . $i . "</span>"; //dang xem
                    } else if ($i > ($curPg - 3) && $i < ($curPg + 4)) {
                        $paging1 .= " <a page='$i' href='" . $pageUrl . "'  class=\"{$classlink}\"><span >" . $i . "</span></a> ";
                    }
                } else if (($curPg + 1) == $totalPages) {
                    if ($i == $curPg) {
                        $paging1 .= "<span page='$i' class=\"{$classunlink}\">" . $i . "</span>"; //dang xem
                    } else if ($i > ($curPg - 4) && $i < ($curPg + 2)) {
                        $paging1 .= " <a page='$i' href='" . $pageUrl . "'  class=\"{$classlink}\"><span >" . $i . "</span></a> ";
                    }
                } else if ($curPg == $totalPages) {
                    if ($i == $curPg) {
                        $paging1 .= "<span class=\"{$classunlink}\">" . $i . "</span>"; //dang xem
                    } else if ($i > ($curPg - 5) && $i < ($curPg + 1)) {
                        $paging1 .= " <a page='$i' href='" . $pageUrl . "'  class=\"{$classlink}\"><span >" . $i . "</span></a> ";
                    }
                } else {
                    if ($i == $curPg) {
                        $paging1 .= "<span class=\"{$classunlink}\">" . $i . "</span>"; //dang xem
                    } else if ($i > ($curPg - $SIDE_COUNT) && $i < ($curPg + $SIDE_COUNT)) {
                        $paging1 .= " <a page='$i' href='" . $pageUrl . "'  class=\"{$classlink}\"><span >" . $i . "</span></a> ";
                    }
                }

                $end = $i;
            } //tinh paging

            $paging .= " <a  href='" . $url . "' page='1' class=\"{$classlink}\" >&laquo;</a> "; //ve dau

            $paging .= " <a page='" . ($curPg - 1) . "' href='" . $this->addParam($getName, $curPg - 1, $url) . "' class=\"{$classlink}\" >&#8249;</a> "; //ve truoc
            #}
            $paging .= $paging1;

            $paging .= " <a page='" . ($curPg + 1) . "' href='" . $this->addParam($getName, $curPg + 1, $url) . "' class=\"{$classlink}\" >&#8250;</a> "; //ke

            $paging .= " <a page='$totalPages' href='" . $this->addParam($getName, $totalPages, $url) . "' class=\"{$classlink}\" >&raquo;</a> "; //ve cuoi
        }

        if (!is_int($r)) {
            //-------------tao array------------------
            $r2 = array();

            $j = 0;
            $start = ($curPg - 1) * $mxR;
            $end = $curPg * $mxR;
            for ($i = $start; $i < $end; $i++) {
                if (empty($r[$i])) {
                    break;
                }

                $r2[$j++] = $r[$i];
            }

            $r3['source'] = $r2;
        }

        $r3['paging'] = $paging;
        return $r3;
    }

    function fullAddress()
    {
        $adr = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
        $adr .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
        $adr .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
        $adr2 = explode('&page=', $adr);
        return $adr2[0];
    }

    function fullAddress1()
    {
        $adr = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
        $adr .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
        $adr .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
        $adr2 = explode('&page=', $adr);
        $adr3 = explode('&sort=', $adr2[0]);
        return $adr3[0];
    }

    function fullAddress2()
    {
        $adr = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
        $adr .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
        $adr .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
        $adr2 = explode('&page=', $adr);
        $adr3 = explode('&limit=', $adr2[0]);
        return $adr3[0];
    }

    function fns_Rand_digit($min, $max, $num)
    {
        $result = '';
        for ($i = 0; $i < $num; $i++) {
            $result .= rand($min, $max);
        }
        return $result;
    }

    function upload_image($file, $extension, $folder, $newname = '', $override = false)
    {
        if (isset($_FILES[$file]) && !$_FILES[$file]['error']) {

            mkdir($folder, 755, true);
            $nameParts = explode('.', $_FILES[$file]['name']);
            $ext = end($nameParts);
            $name = basename($_FILES[$file]['name'], '.' . $ext);

            // if(strpos($extension, $ext)===false){
            // 	alert('Chỉ hỗ trợ upload file dạng '.$extension);
            // 	return false; // không hỗ trợ
            // }

            if ($override) {
                return move_uploaded_file($_FILES[$file]["tmp_name"], $folder . $newname);
            }

            if ($newname == '' && file_exists($folder . $_FILES[$file]['name'])) {
                for ($i = 0; $i < 100; $i++) {
                    if (!file_exists($folder . $name . $i . '.' . $ext)) {
                        $_FILES[$file]['name'] = $name . $i . '.' . $ext;
                        break;
                    }
                }
            } else {
                $_FILES[$file]['name'] = $this->bodautv($name) . $newname . '.' . $ext;
            }

            if (!copy($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                if (!move_uploaded_file($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                    return null;
                }
            }
            return $_FILES[$file]['name'];
        }
        return false;
    }

    function upload_image_2($file, $extension, $folder, $newname = '')
    {
        if (isset($_FILES[$file]) && !$_FILES[$file]['error']) {
            mkdir($folder, 755, true);

            if (!copy($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                if (!move_uploaded_file($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                    return false;
                }
            }
            return $_FILES[$file]['name'];
        }
        return false;
    }

    function upfile($file, $folder, $newname = '')
    {
        if (isset($_FILES[$file]) && !$_FILES[$file]['error']) {

            mkdir($folder, 755, true);
            $ext = end(explode('.', $_FILES[$file]['name']));
            $name = basename($_FILES[$file]['name'], '.' . $ext);

            if ($newname == '' && file_exists($folder . $_FILES[$file]['name'])) {
                for ($i = 0; $i < 100; $i++) {
                    if (!file_exists($folder . $name . $i . '.' . $ext)) {
                        $_FILES[$file]['name'] = $name . $i . '.' . $ext;
                        break;
                    }
                }
            } else {
                $_FILES[$file]['name'] = $newname . '.' . $ext;
            }

            if (!copy($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                if (!move_uploaded_file($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                    return false;
                }
            }
            return $_FILES[$file]['name'];
        }
        return false;
    }

    function mutil_upload_image($tenfile, $folder)
    {
        $name = array();
        $tmp_name = array();
        $tenhinh = array();
        $type = array();
        mkdir($folder, 755, true);
        foreach ($_FILES[$tenfile]['name'] as $file) {
            $name[] = $file;
        }
        foreach ($_FILES[$tenfile]['tmp_name'] as $file) {
            $tmp_name[] = $file;
        }

        foreach ($_FILES[$tenfile]['type'] as $file) {
            $type[] = $file;
        }

        $count = count($name);
        for ($i = 0; $i < $count; $i++) {

            if (
                $type[$i] == "image/jpeg"
                || $type[$i] == "image/jpg"
                || $type[$i] == "image/png"
                || $type[$i] == "image/JPG"
                || $type[$i] == "image/PNG"
                || $type[$i] == "image/GIF"
                || $type[$i] == "image/gif"
            ) {
                $filename = $this->fns_Rand_digit(0, 9, 3) . '_' . $this->bodautv($name[$i]);

                if (move_uploaded_file($tmp_name[$i], $folder . $filename)) {
                    $tenhinh[] = $filename;
                }
            }
        }
        return $tenhinh;
    }

    function create_thumb($file, $width, $height, $folder, $file_name, $folder_new, $zoom_crop = '1')
    {
        $new_width = $width;
        $new_height = $height;

        if ($new_width && !$new_height) {
            $new_height = floor($height * ($new_width / $width));
        } else if ($new_height && !$new_width) {
            $new_width = floor($width * ($new_height / $height));
        }

        $image_url = $folder . $file;
        $origin_x = 0;
        $origin_y = 0;
        // GET ORIGINAL IMAGE DIMENSIONS
        $array = getimagesize($image_url);
        if ($array) {
            list($image_w, $image_h) = $array;
        } else {
            die("NO IMAGE $image_url");
        }
        $width = $image_w;
        $height = $image_h;

        // ACQUIRE THE ORIGINAL IMAGE
        $image_ext = trim(strtolower(end(explode('.', $image_url))));
        switch (strtoupper($image_ext)) {
            case 'JPG':
            case 'JPEG':
                $image = imagecreatefromjpeg($image_url);
                $func = 'imagejpeg';
                break;
            case 'PNG':
                $image = imagecreatefrompng($image_url);
                $func = 'imagepng';
                break;
            case 'GIF':
                $image = imagecreatefromgif($image_url);
                $func = 'imagegif';
                break;

            default:
                die("UNKNOWN IMAGE TYPE: $image_url");
        }

        // scale down and add borders
        if ($zoom_crop == 3) {

            $final_height = $height * ($new_width / $width);

            if ($final_height > $new_height) {
                $new_width = $width * ($new_height / $height);
            } else {
                $new_height = $final_height;
            }
        }

        // create a new true color image
        $canvas = imagecreatetruecolor($new_width, $new_height);
        imagealphablending($canvas, false);

        // Create a new transparent color for image
        $color = imagecolorallocatealpha($canvas, 255, 255, 255, 127);

        // Completely fill the background of the new image with allocated color.
        imagefill($canvas, 0, 0, $color);

        // scale down and add borders
        if ($zoom_crop == 2) {

            $final_height = $height * ($new_width / $width);

            if ($final_height > $new_height) {

                $origin_x = $new_width / 2;
                $new_width = $width * ($new_height / $height);
                $origin_x = round($origin_x - ($new_width / 2));
            } else {

                $origin_y = $new_height / 2;
                $new_height = $final_height;
                $origin_y = round($origin_y - ($new_height / 2));
            }
        }

        // Restore transparency blending
        imagesavealpha($canvas, true);

        if ($zoom_crop > 0) {

            $src_x = $src_y = 0;
            $src_w = $width;
            $src_h = $height;

            $cmp_x = $width / $new_width;
            $cmp_y = $height / $new_height;

            // calculate x or y coordinate and width or height of source
            if ($cmp_x > $cmp_y) {

                $src_w = round($width / $cmp_x * $cmp_y);
                $src_x = round(($width - ($width / $cmp_x * $cmp_y)) / 2);
            } else if ($cmp_y > $cmp_x) {

                $src_h = round($height / $cmp_y * $cmp_x);
                $src_y = round(($height - ($height / $cmp_y * $cmp_x)) / 2);
            }

            // positional cropping!
            if ($align) {
                if (strpos($align, 't') !== false) {
                    $src_y = 0;
                }
                if (strpos($align, 'b') !== false) {
                    $src_y = $height - $src_h;
                }
                if (strpos($align, 'l') !== false) {
                    $src_x = 0;
                }
                if (strpos($align, 'r') !== false) {
                    $src_x = $width - $src_w;
                }
            }

            imagecopyresampled($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);
        } else {

            // copy and resize part of an image with resampling
            imagecopyresampled($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        }

        $new_file = $file_name . '_' . $new_width . 'x' . $new_height . '.' . $image_ext;
        // SHOW THE NEW THUMB IMAGE
        if ($func == 'imagejpeg') {
            $func($canvas, $folder_new . $file, 95);
        } else {
            $func($canvas, $folder_new . $file, floor(95 * 0.09));
        }

        return $new_file;
    }

    function transfer_old($msg, $page = "index.php")
    {
        $showtext = $msg;
        $page_transfer = $page;
        include "./templates/transfer_tpl.php";
        exit();
    }

    function transfer($msg, $url = "index.php")
    {
        echo '<script language="javascript">
				window.alert("' . $msg . '");
				window.location = "' . $url . '";
				</script>';
        exit();
    }

    function redirect($url = '')
    {
        echo '<script language="javascript">window.location = "' . $url . '" </script>';
        exit();
    }

    function lay_show_hienthi($i)
    {
        if ($i == 1 || !$i) {
            return 15;
        } else if ($i == 2) {
            return 25;
        } else if ($i == 3) {
            return 50;
        } else if ($i == 4) {
            return 75;
        } else if ($i == 5) {
            return 100;
        } else if ($i == 6) {
            return 200;
        } else if ($i == 7) {
            return 300;
        } else if ($i == 8) {
            return 500;
        } else if ($i == 9) {
            return 1000;
        } else if ($i == 10) {
            return 2000;
        } else if ($i == 11) {
            return 3000;
        } else if ($i == 12) {
            return 5000;
        } else if ($i == 13) {
            return 8000;
        }
    }

    function cv_html($toptip)
    {
        $toptip = preg_replace('/[\n\r\t]/', ' ', $toptip);
        $toptip = str_replace("<br/>", "", $toptip);
        $toptip = str_replace("@[\s]{2,}@", "", $toptip);
        $toptip = str_replace("\\n", "&nbsp;", $toptip);
        $toptip = str_replace("\\r", "&nbsp;", $toptip);
        $toptip = str_replace("\\r\\n", "", $toptip);
        $toptip = str_replace("\"", "&quot;", $toptip);
        $toptip = str_replace("<", "&lt;", $toptip);
        $toptip = str_replace(">", "&gt;", $toptip);
        $toptip = str_replace("&", "&amp;", $toptip);
        $toptip = str_replace(",", "&#44;", $toptip);
        $toptip = str_replace("(", "&#40;", $toptip);
        $toptip = str_replace(")", "&#41;", $toptip);
        $toptip = str_replace(";", "&#59;", $toptip);
        $toptip = str_replace("\\", "&#92;", $toptip);
        $toptip = str_replace("'", "&#39;", $toptip);
        return $toptip;
    }

    function check_id_arr($id, $arr)
    {
        $arr = explode(",", $arr);
        foreach ($arr as $ar) {
            if ($id == $ar) {
                return true;
            }
        }
        return false;
    }

    function lay_nd_col($col, $table, $whe)
    {
        $rs = $this->o_fet("select " . $col . " from " . $table . " where " . $whe);
        if (count($rs) > 0) {
            return $rs[0][$col];
        } else {
            return "";
        }
    }

    function show_menu_tt($menus_tt = array(), $lang, $parrent = 0, $link)
    {
        $i = 0;
        foreach ($menus_tt as $val) {
            global $d;
            if ($val['category_id'] == $parrent) {
                $i++;
                if ($i == 1) {
                    echo '<ul class="nhom_tt_hide nhom_tt_' . $val['category_id'] . '">';
                }

                echo '<li>
                        <span class="span_nav" onclick="aj_showmn_mb_tt(this,\'' . $val['id'] . '\')">►</span><a href="' . URLPATH . $lang . $link . '/' . $val['alias_' . $_SESSION['lang']] . '/">' . $val['name_' . $_SESSION['lang']] . '</a>';
                $this->show_menu_tt($menus_tt, $lang, $val['id'], $link, false);
                echo '</li>';
            }
        }
        if ($i != 0) {
            echo '</ul>';
        }
    }

    function show_menu_tt_dt($menus_tt = array(), $lang, $parrent = 0, $link)
    {
        $i = 0;
        foreach ($menus_tt as $val) {
            global $d;
            if ($val['category_id'] == $parrent) {
                $i++;
                if ($i == 1) {
                    echo '<ul class="nhom_tt_hide nhom_tt_' . $val['category_id'] . '">';
                }

                echo '<li>
                        <a href="' . URLPATH . $lang . $link . '/' . $val['alias_' . $_SESSION['lang']] . '/">' . $val['name_' . $_SESSION['lang']] . '</a>';
                $this->show_menu_tt_dt($menus_tt, $lang, $val['id'], $link, false);
                echo '</li>';
            }
        }
        if ($i != 0) {
            echo '</ul>';
        }
    }

    function show_menu_dl($menus_dl = array(), $lang, $parrent = 0)
    {
        $i = 0;
        // echo '<ul>';
        foreach ($menus_dl as $val) {
            global $d;
            if ($val['category_id'] == $parrent) {
                $i++;
                if ($i == 1) {
                    echo '<ul class="nhom_sp_hide nhom_sp_' . $val['category_id'] . '">';
                }

                echo '<li>

                        <span class="span_nav" onclick="aj_showmn_mb_sp(this,\'' . $val['id'] . '\')">►</span><a href="' . URLPATH . $lang . _linksanpham . "/" . $val['alias_' . $_SESSION['lang']] . '/">' . $val['name_' . $_SESSION['lang']] . '</a>';
                $this->show_menu_dl($menus_dl, $lang, $val['id'], false);
                echo '</li>';
            }
        }
        if ($i != 0) {
            echo '</ul>';
        }
    }

    function show_menu_dl_sp_dt($menus_dl = array(), $lang, $parrent = 0)
    {
        $i = 0;
        // echo '<ul>';
        foreach ($menus_dl as $val) {
            global $d;
            if ($val['category_id'] == $parrent) {
                $i++;
                if ($i == 1) {
                    echo '<ul>';
                }

                echo '<li>';
                if ($val['alias_' . $_SESSION['lang']] == 'pin-sac-du-phong-chinh-hang') {
                    echo '
	                    		<a href="' . URLPATH . '">' . $val['name_' . $_SESSION['lang']] . '</a>';
                } else {
                    echo '
	                    <a href="' . URLPATH . $lang . _linksanpham . "/" . $val['alias_' . $_SESSION['lang']] . '/">' . $val['name_' . $_SESSION['lang']] . '</a>';
                }

                $this->show_menu_dl_sp_dt($menus_dl, $lang, $val['id'], false);
                echo '</li>';
            }
        }
        if ($i != 0) {
            echo '</ul>';
        }
    }

    function show_menu_tintuc_hd($menus = array(), $parrent = 0, &$chuoi = '')
    {
        foreach ($menus as $val) {
            if ($val['category_id'] == $parrent) {
                $chuoi .= $val['id'] . ',';
                $this->show_menu_tintuc_hd($menus, $val['id'], $chuoi);
            }
        }
        return $chuoi;
    }

    function lay_alias_sp($id, $lang, $linksp)
    {
        $lsp = $this->o_sel('alias_vn, alias_us', '#_loaisanpham', 'id = "' . $id . '"');
        if (count($lsp) > 0) {
            return $lsp[0]['alias_' . $lang] . "/";
        } else {
            return $linksp . "/";
        }
    }

    function lay_ten_sp($id, $lang, $linksp)
    {
        $lsp = $this->o_sel('name_vi, name_en', '#_loaisanpham', 'id = "' . $id . '"');
        if (count($lsp) > 0) {
            return $lsp[0]['name_' . $lang];
        } else {
            return $linksp;
        }
    }

    function lay_ten_tintuc($alias, $lang)
    {
        $lsp = $this->o_sel('name_vi, name_en', '#_loaitintuc', 'alias_' . $lang . ' = "' . $alias . '"');
        if (count($lsp) > 0) {
            return $lsp[0]['name_' . $lang];
        } else {
            return "";
        }
    }

    function show_menu_2($menus = array(), $parrent = 0, &$chuoi = '')
    {
        foreach ($menus as $val) {
            if ($val['category_id'] == $parrent) {
                $chuoi .= $val['id'] . ',';
                $this->show_menu_2($menus, $val['id'], $chuoi);
            }
        }
        return $chuoi;
    }

    function check_ptram($giacu, $giamoi)
    {
        return round((($giacu - $giamoi) * 100 / $giacu));
    }

    function simple_fetch($sql)
    {
        $this->beforeStart($sql);

        $result = $this->getCache($this->sql);
        if ($result && $this->memcached->getResultCode() === Memcached::RES_SUCCESS) {
            $this->cachedHit++;
            return $result;
        } else {
            $this->cachedHitMissed++;
        }

        $stmt = $this->db->prepare($this->sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            $result = $result[0];
        } else {
            $result = [];
        }
//        $this->setCache($this->sql, $result, $this->cacheTTL);
        return $result;
    }

    function create_long_link($alias, $lang)
    {
        $str = "";
        if ($this->num_rows("select * from #_category where alias_{$lang}='$alias' and hien_thi=1 ") > 0) {
            $link = $this->o_fet("select * from #_category where alias_{$lang}='$alias' and hien_thi=1 ");
            $str = $link[0]['alias_' . $lang];
        } else if ($this->num_rows("select * from #_tintuc where alias_{$lang}='$alias'") > 0) {
            $link = $this->o_fet("select * from #_tintuc where alias_{$lang}='$alias'");
            $str = $link[0]['alias_' . $lang];
        } else if ($this->num_rows("select * from #_sanpham where alias_{$lang}='$alias'") > 0) {
            $link = $this->o_fet("select * from #_sanpham where alias_{$lang}='$alias'");
            $str = $link[0]['alias_' . $lang];
        }
        return $str;
    }

    function getTemplates($id, $hien_thi = '')
    {
        if ($hien_thi) {
            $sql = "select * from #_setting where id=$id";
        } else {
            $sql = "select * from #_setting where hien_thi=1 and id=$id";
        }
        $str = $this->simple_fetch($sql);
        return $str;
    }

    function getImg($parent, $limit = '', $and = '')
    {
        $str = $this->o_fet("select * from #_gallery where hide = 1 and parent = $parent $and order by stt asc, id asc $limit");
        return $str;
    }

    function getSlider()
    {
        $result = $this->o_fet("select * from #_slide_sp where hien_thi = 1 order by so_thu_tu asc, id desc");
        return $result;
    }

    function findIdSub($id, $level = 0)
    {

        $cacheKey = 'findIdSub_' . $id . $level;
        $result = $this->getCache($cacheKey);
        if ($result && $this->memcached->getResultCode() === Memcached::RES_SUCCESS) {
            $this->cachedHit++;
            return $result;
        } else {
            $this->cachedHitMissed++;
        }

        $str = "";
        $query = $this->o_fet("select id from #_category where category_id=$id and hien_thi=1 order by so_thu_tu asc, id desc");
        if (count($query) > 0) {
            foreach ($query as $item) {
                $str .= "," . $item['id'];
                $check = $this->o_fet("select id from #_category where category_id={$item['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                if (count($check) > 0 && $level == 0) {
                    $str .= $this->findIdSub($item['id']);
                }
            }
        }
//        $this->setCache($cacheKey, $str, 60 * 60 * 24 * 7);
        return $str;
    }

    function getActive($alias, $lang)
    {
        if ($alias != '') {
            $query = $this->simple_fetch("select * from #_category where alias_$lang = '$alias' ");

            if (count($query) > 0) {

                $_SESSION['nav'][$query['level']] = $query['id'];
                if ($query['level'] > 0) {

                    $sub = $this->simple_fetch("select * from #_category where id = {$query['category_id']} ");
                    $this->getActive($sub['alias_' . $lang], $lang);
                }
            }
            $query1 = $this->o_fet("select id,category_id from #_tintuc where alias_$lang = '$alias' ");
            $query2 = $this->o_fet("select id,category_id from #_sanpham where alias_$lang = '$alias' ");
            if (count($query1) > 0 || count($query2) > 0) {
                if (count($query1) > 0) {
                    $category_id = $query1[0]['category_id'];
                } else if (count($query2) > 0) {
                    $category_id = $query2[0]['category_id'];
                }
                $nav = $this->simple_fetch("select * from #_category where id = $category_id ");
                $_SESSION['nav'][$nav['level']] = $nav['id'];
                $this->getActive($nav['alias_' . $lang], $lang);
            }
        }
    }

    function breadcrumb($id, $lang, $path = '')
    {

        $str = "";
        $query = $this->simple_fetch("select * from #_category where id=$id and hien_thi=1");
        $str .= "<li><a href='" . $path . $this->create_long_link($query['alias_' . $lang], $lang) . ".html' title='{$query['name_' .$lang]}'>{$query['name_' .$lang]}</a></li>";
        if ($query['category_id'] > 0) {
            $str = $this->breadcrumb($query['category_id'], $lang) . $str;
        }
        return $str;
    }

    function checkLink($text, $field, $id)
    {
        $and = "";
        if ($id != '') {
            $and .= " and id!=$id";
        }

        $count = $this->num_rows("select id from #_category where $field='{$text}' $and");
        $count1 = $this->num_rows("select id from #_sanpham where $field='{$text}' $and");
        $count2 = $this->num_rows("select id from #_tintuc where $field='{$text}' $and");

        if ($count == 0 && $count1 == 0 && $count2 == 0) {
            return false;
        } else {
            return true;
        }
    }

    function clear($html)
    {
        $str = "";
        $str = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
        return $str;
    }

    function generateUniqueToken($username)
    {
        $token = time() . rand(10, 5000) . sha1(rand(10, 5000)) . md5(__FILE__);
        $token = str_shuffle($token);
        $token = sha1($token) . md5(microtime()) . md5($username);
        return $token;
    }

    function getPassHash($token, $password)
    {
        $password_hash = md5(md5($token) . md5($password));
        return $password_hash;
    }

    function clean($str)
    {
        $str = @trim($str);
        if (get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return strip_tags($str);
    }

    function cleanData($str)
    {
        return $this->clean(addslashes($str));
    }

    function subText($text, $num)
    {
        $str_len = strlen($text);
        if ($str_len < $num) {
            $str = $text;
        } else {
            $str = mb_substr($text, 0, $num, 'UTF-8') . "...";
        }
        return $str;
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function link_redirect($alias = '')
    {
        $link_web = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $link_goc = URLPATH . $alias;

        if ($link_web != $link_goc) {
            $this->redirect($link_goc);
        }
    }

    function array_category($category_id = 0, $plit = "=", $select_ = "", $module = 0, $notshow = 0)
    {
        $cacheKey = "array_category.{$category_id}.{$plit}.{$select_}.{$module}.{$notshow}";

        $str = $this->getCache($cacheKey);
        if (!empty($str)) {
            return $str;
        }

        $str = "";
        $and = ($notshow > 0) ? " and id!=$notshow" : '';

        if ($category_id == 0) {
            $query = $this->o_fet("select * from #_category where category_id=0 $and order by so_thu_tu asc, id desc");
            // echo $d->sql;
            $plit = "";
        } else {
            $query = $this->o_fet("select * from #_category where category_id=$category_id $and order by so_thu_tu asc, id desc");
            // echo $d->sql;
            $plit .= "= ";
        }

        foreach ($query as $item) {
            if (is_array($select_)) {
                if (in_array($item['id'], $select_)) {
                    $selected = "selected='selected'";
                } else {
                    $selected = "";
                }
            } else {
                if ($item['id'] == $select_) {
                    $selected = "selected='selected'";
                } else {
                    $selected = "";
                }
            }

            if ($module > 0) {
                if ($item['module'] == $module) {
                    $str .= "<option value='" . $item['id'] . "' " . $selected . ">" . $plit . " " . $item['name_vi'] . "</option>";
                }
            } else {
                $str .= "<option value='" . $item['id'] . "' " . $selected . ">" . $plit . " " . $item['name_vi'] . "</option>";
            }

            $check_sub = $this->num_rows("select * from #_category where category_id='{$item['id']}'");

            if ($check_sub > 0) {
                $str .= $this->array_category($item['id'], $plit, $select_, $module, $notshow);
            }
        }

//        $this->setCache($cacheKey, $str, 60 * 60 * 24 * 7);
        return $str;
    }

    /*function array_category_dropdown($category_id=0,$plit="=",$select_="",$module=0,$notshow=0) {

            $str="";
            $and = ($notshow>0) ? " and id!=$notshow" : '';

            if($category_id==0) {
                $query = $this->o_fet("select * from #_category where category_id=0 $and order by so_thu_tu asc, id desc");
                echo $d->sql;
                $plit="";
            }
            else {
                $query = $this->o_fet("select * from #_category where category_id=$category_id $and order by so_thu_tu asc, id desc");
                echo $d->sql;
                $plit.="= ";
            }

            foreach($query as $item) {
                if($item['id']==$select_){ $selected="selected='selected'";} else{ $selected="";}
                if($module>0) {
                    if($item['module']==$module) {
                        $str.="<option value='".$item['id']."' ".$selected.">".$plit." ".$item['name_vi']."</option>";
                    }
                }
                else {
                    $str.="<option value='".$item['id']."' ".$selected.">".$plit." ".$item['name_vi']."</option>";
                }

                $check_sub = $this->num_rows("select * from #_category where category_id='{$item['id']}'");

                if($check_sub>0) {
                    $str.=$this->array_category_dropdown($item['id'],$plit,$select_,$module,$notshow);
                }
            }

            <div class="panel-group" role="tablist">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                        <h4 class="panel-title">
                            <a href="#collapseListGroup1" class="" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="collapseListGroup1"> Collapsible list group </a>
                        </h4>
                    </div>
                        <ul class="list-group">class="panel-collapse collapse in" role="tabpanel" id="collapseListGroup1" aria-labelledby="collapseListGroupHeading1" aria-expanded="true"
                            <li class="list-group-item">Bootply</li>
                            <li class="list-group-item">One itmus ac facilin</li>
                            <li class="list-group-item">Second eros</li>
                        </ul>
                </div>
            </div>;
            return $str;
        }*/

    function showEx($id, $lang)
    {
        $query = $this->simple_fetch("select * from #_extra where id=$id");
        return $query['title_' . $lang];
    }

    function many_extra($post)
    {
        $str = "";
        $post = $this->clear($post);
        foreach ($post as $item) {
            $str .= "," . $item;
        }
        return $str;
    }

    public function checkUserPermission($id_user, $page)
    {
        $count = 0;
        $array_temp = array();
        $query = $this->o_fet("select * from #_user_permission_group where id_user=$id_user");
        if (!empty($query)) {
            foreach ($query as $key => $value) {
                $result = $this->o_fet("select * from #_permission_group where id={$value['id_permission']}");
                if (!empty($result)) {
                    foreach ($result as $k => $v) {
                        if ($v['category_id'] == 0) {
                            array_push($array_temp, $v['page']);
                            $listChild = $this->o_fet("select * from #_permission_group where category_id={$v['id']}");
                            foreach ($listChild as $child) {
                                array_push($array_temp, $child['page']);
                            }
                        } else {
                            array_push($array_temp, $v['page']);
                        }
                    }
                }
            }
        }
        if (in_array($page, $array_temp)) {
            $count = 1;
        }
        return $count;
    }

    public function checkChildPermission($id_user, $page)
    {
        $count = 0;
        $array_temp = array();
        $query = $this->simple_fetch("select * from #_permission_group where page='" . $page . "'");
        if (!empty($query)) {
            $check_parent = $this->simple_fetch("select * from #_user_permission_group where id_user = '" . $id_user . "' and id_permission ='" . $query['id'] . "'");
            if (!empty($check_parent)) {
                return 1;
            }
            $check = $this->o_fet("select * from #_permission_group where category_id={$query['id']}");
            if (!empty($check)) {
                foreach ($check as $key => $value) {
                    $check_id = $this->simple_fetch("select * from #_user_permission_group where id_user = '" . $id_user . "' and id_permission ='" . $value['id'] . "'");
                    if (!empty($check_id)) {
                        return 1;
                    }
                }
            }
        }

        return $count;
    }

    function token()
    {
        return sha1(time() . rand(0, 99999));
    }

    function tag_img($text)
    {
        preg_match_all('/<img[^>]+>/i', $text, $str);
        return $str[0][0];
    }

    function generate_username_from_text($strText)
    {
        $strText = preg_replace('/[^A-Za-z0-9-]/', ' ', $strText);
        $strText = preg_replace('/ +/', ' ', $strText);
        $strText = trim($strText);
        $strText = str_replace(' ', '', $strText);
        $strText = preg_replace('/-+/', '', $strText);
        $strText = preg_replace("/-$/", "", $strText);
        return $strText;
    }

    function stripUnicode($str)
    {
        if (!$str) {
            return false;
        }

        $str = strip_tags($str);
        $unicode = array('a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ', 'd' => 'đ', 'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ', 'i' => 'í|ì|ỉ|ĩ|ị', 'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ', 'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự', 'y' => 'ý|ỳ|ỷ|ỹ|ỵ', 'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ', 'D' => 'Đ', 'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ', 'I' => 'Í|Ì|Ỉ|Ĩ|Ị', 'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ', 'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự', 'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ');
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
    }

    function username($strText)
    {
        return strtolower($this->generate_username_from_text($this->stripUnicode($strText)));
    }

    function toCacheKey($str)
    {
        global $config;
        return $config['database']['database'] . '_' . $config['database']['refix'] . '_' . md5(trim($str));
    }

    function setCache($keyStr, $value, $ttl)
    {
        $this->missedQueries[] = $keyStr;
        $key = $this->toCacheKey($keyStr);
        return $this->memcached->set($key, $value, $ttl);
    }

    public function disableCacheQuery()
    {
        $this->disableNextCache = true;
    }

    function getCache($keyStr)
    {
        if ($this->disableNextCache) {
            $this->disableNextCache = false;
            return null;
        }
        $this->queries[] = $keyStr;
        $key = $this->toCacheKey($keyStr);
        return $this->memcached->get($key);
    }

    function clearMemCached()
    {
        return $this->memcached->flush();
    }

    function getAllBrands()
    {
        $cacheKey = 'all_brands';
        $result = $this->getCache($cacheKey);
        if (!empty($result)) {
            return $result;
        }

        $result = $this->o_fet("SELECT id, name FROM #_brand WHERE name IS NOT NULL ORDER BY name ASC, id DESC");

//        $this->setCache($cacheKey, $result, 60 * 60 * 24 * 7);

        return $result;
    }

    function getBrandById($id)
    {
        $result = $this->simple_fetch("SELECT name FROM #_brand WHERE id = {$id}");
        if (!$result) {
            return;
        }
        return $result;
    }

    function getAllGroups()
    {
        $cacheKey = 'all_groups';
        $result = $this->getCache($cacheKey);
        if (!empty($result)) {
            return $result;
        }

        $result = $this->o_fet("SELECT id, name_vi FROM #_group WHERE name_vi IS NOT NULL ORDER BY name_vi ASC, id DESC");

//        $this->setCache($cacheKey, $result, 60 * 60 * 24 * 7);

        return $result;
    }

    function getAllSettings()
    {
        $cacheKey = 'all_settings';
        $result = $this->getCache($cacheKey);
        if (!empty($result)) {
            return $result;
        }

        $result = $this->o_fet("SELECT * FROM #_settings WHERE name IS NOT NULL ORDER BY name DESC");
        $settings = [];
        foreach ($result as $setting) {
            $settings[$setting['name']] = $setting;
        }

//        $this->setCache($cacheKey, $settings, 60 * 60 * 24 * 7);

        return $settings;
    }

    function getSettingByKey($key)
    {
        $cacheKey = 'getSettingByKey_' . $key;
        $result = $this->getCache($cacheKey);
        if (!empty($result)) {
            return $result;
        }

        $result = $this->simple_fetch("SELECT * FROM #_settings WHERE name = {$key}");

//        $this->setCache($cacheKey, $result, 60 * 60 * 24 * 7);

        return $result;
    }

    function getDefaultProductImage($width = 600, $height = 440)
    {
        global $SETTINGS;

        return '/images/' . $width . '/' . $height . '/' . $SETTINGS['default_product_image']['value'];
    }

    function getDefaultProductImage2($width = 600, $height = 440)
    {
        global $SETTINGS;

        return 'images/' . $width . '/' . $height . '/' . $SETTINGS['default_product_image']['value'];
    }

    function convert_number_to_words($number)
    {
        $hyphen = ' ';
        $conjunction = '  ';
        $separator = ' ';
        $negative = 'âm ';
        $decimal = ' phẩy ';
        $dictionary = array(
            0 => 'Không',
            1 => 'Một',
            2 => 'Hai',
            3 => 'Ba',
            4 => 'Bốn',
            5 => 'Năm',
            6 => 'Sáu',
            7 => 'Bảy',
            8 => 'Tám',
            9 => 'Chín',
            10 => 'Mười',
            11 => 'Mười một',
            12 => 'Mười hai',
            13 => 'Mười ba',
            14 => 'Mười bốn',
            15 => 'Mười năm',
            16 => 'Mười sáu',
            17 => 'Mười bảy',
            18 => 'Mười tám',
            19 => 'Mười chín',
            20 => 'Hai mươi',
            30 => 'Ba mươi',
            40 => 'Bốn mươi',
            50 => 'Năm mươi',
            60 => 'Sáu mươi',
            70 => 'Bảy mươi',
            80 => 'Tám mươi',
            90 => 'Chín mươi',
            100 => 'trăm',
            1000 => 'ngàn',
            1000000 => 'triệu',
            1000000000 => 'tỷ',
            1000000000000 => 'nghìn tỷ',
            1000000000000000 => 'ngàn triệu triệu',
            1000000000000000000 => 'tỷ tỷ',
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error('convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING);
            return false;
        }

        if ($number < 0) {
            return $negative . self::convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . self::convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= self::convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
}

function watermark_image($newname, $folder)
{
    $uploadimage = $folder . $newname;
    $actual = $folder . $newname;

    $temp = explode('.', $newname);
    $ext = end($temp);
    if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG') {
        $source = imagecreatefromjpeg($uploadimage);
    } else if ($ext == 'png' || $ext == 'PNG') {
        $source = imagecreatefrompng($uploadimage);
    } else {
        $source = imagecreatefromgif($uploadimage);
    }

    // load the image you want to you want to be watermarked
    $watermark = imagecreatefrompng('../templates/watermark.png');
    $size = getimagesize($uploadimage);

    // get the width and height of the watermark image
    $water_width = imagesx($watermark);
    $water_height = imagesy($watermark);

    // get the width and height of the main image image
    $main_width = imagesx($source);
    $main_height = imagesy($source);

    // Set the dimension of the area you want to place your watermark we use 0
    // from x-axis and 0 from y-axis
    $dime_x = ($size[0] - $water_width) / 1.3;
    $dime_y = ($size[1] - $water_height) / 1.3;

    // copy both the images
    imagecopy($source, $watermark, $dime_x, $dime_y, 0, 0, $water_width, $water_height);

    // Final processing Creating The Image
    imagejpeg($source, $actual, 100);
}

function time_stamp($time_ago)
{
    $cur_time = time();
    $time_elapsed = $cur_time - $time_ago;
    $seconds = $time_elapsed;
    $minutes = round($time_elapsed / 60);
    $hours = round($time_elapsed / 3600);
    $days = round($time_elapsed / 86400);
    $weeks = round($time_elapsed / 604800);
    $months = round($time_elapsed / 2600640);
    $years = round($time_elapsed / 31207680);
    // Seconds
    if ($seconds <= 60) {
        echo " Cách đây $seconds giây ";
    } //Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            echo " Cách đây 1 phút ";
        } else {
            echo " Cách đây $minutes phút";
        }
    } //Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            echo "Cách đây 1 tiếng ";
        } else {
            echo " Cách đây  $hours tiếng ";
        }
    } //Days
    else if ($days <= 7) {
        if ($days == 1) {
            echo " Ngày hôm qua ";
        } else {
            echo " Cách đây  $days ngày ";
        }
    } //Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            echo " Cách đây 1 tuần ";
        } else {
            echo " Cách đây  $weeks tuần";
        }
    } //Months
    else if ($months <= 12) {
        if ($months == 1) {
            echo " Cách đây 1 tháng ";
        } else {
            echo " Cách đây $months tháng";
        }
    } //Years
    else {
        if ($years == 1) {
            echo " Cách đây 1 năm ";
        } else {
            echo " Cách đây $years năm ";
        }
    }
}

function thumb($path, $w = 100, $h = 100)
{
    return "thumb/$w" . "x" . "$h/$path";
}

function strip_unicode($str)
{
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd' => 'đ', 'D' => 'Đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i' => 'í|ì|ỉ|ĩ|ị',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        '-' => '/|,|:|?|;|!|@|#|$|%|^|&|*|(|)|"|+|_|.',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ', 'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
    );
    foreach ($unicode as $khongdau => $codau) {
        $arr = explode("|", $codau);
        $str = str_replace($arr, $khongdau, $str);
    }
    $str = str_replace("'", '-', $str);
    $str = str_replace('"', '-', $str);
    $str = str_replace(' ', '-', $str);
    $str = str_replace('---', '-', $str);
    $str = str_replace('--', '-', $str);
    $str = trim($str, '-');
    $str = strtolower($str);
    return $str;
}

function saveImagesFromHtml($html)
{
    $images = getImagesFromHtml($html);

    foreach ($images as $image) {
        if (empty($image)) {
            continue;
        }

        if (stripos($image, 'http') !== 0) {
            continue;
        }

        $imageContent = file_get_contents($image);
        if ($imageContent) {
            $imageFileName = '/img_data/images/' . uniqid() . '.' . getImageExtension($image);
            $isSuccess = file_put_contents(_ROOT . $imageFileName, $imageContent);

            if ($isSuccess) {
                $html = str_replace($image, $imageFileName, $html);
            }
        }
    }

    return $html;
}

function getImageExtension($filename)
{
    $filenameInfos = explode('.', $filename);
    $count = count($fileNameInfos);

    if ($count <= 1) {
        return 'jpg';
    }

    return $filenameInfos[($count - 1)];
}

function getImagesFromHtml($html)
{
    $images = array();
    preg_match_all('/(img|src)=("|\')[^"\'>]+/i', $html, $media);
    unset($html);
    $html = preg_replace('/(img|src)("|\'|="|=\')(.*)/i', "$3", $media[0]);
    foreach ($html as $url) {
        $info = pathinfo($url);
        if (isset($info['extension'])) {
            if (($info['extension'] == 'jpg') ||
                ($info['extension'] == 'jpeg') ||
                ($info['extension'] == 'gif') ||
                ($info['extension'] == 'png')
            ) {
                array_push($images, $url);
            }
        }
    }

    return $images;
}

// HTML Minifier
function minify_html($input)
{
    if (trim($input) === "") {
        return $input;
    }

    // Remove extra white-space(s) between HTML attribute(s)
    $input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function ($matches) {
        return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
    }, str_replace("\r", "", $input));
    // Minify inline CSS declaration(s)
    if (strpos($input, ' style=') !== false) {
        $input = preg_replace_callback('#<([^<]+?)\s+style=([\'"])(.*?)\2(?=[\/\s>])#s', function ($matches) {
            return '<' . $matches[1] . ' style=' . $matches[2] . minify_css($matches[3]) . $matches[2];
        }, $input);
    }
    if (strpos($input, '</style>') !== false) {
        $input = preg_replace_callback('#<style(.*?)>(.*?)</style>#is', function ($matches) {
            return '<style' . $matches[1] . '>' . minify_css($matches[2]) . '</style>';
        }, $input);
    }
    if (strpos($input, '</script>') !== false) {
        $input = preg_replace_callback('#<script(.*?)>(.*?)</script>#is', function ($matches) {
            return '<script' . $matches[1] . '>' . minify_js($matches[2]) . '</script>';
        }, $input);
    }

    // TODO: solve slow preg_replace
    return $input;

    return preg_replace(
        array(
            // t = text
            // o = tag open
            // c = tag close
            // Keep important white-space(s) after self-closing HTML tag(s)
            '#<(img|input)(>| .*?>)#s',
            // Remove a line break and two or more white-space(s) between tag(s)
            '#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
            '#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s', // t+c || o+t
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s', // o+o || c+c
            '#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s', // c+t || t+o || o+t -- separated by long white-space(s)
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s', // empty tag
            '#<(img|input)(>| .*?>)<\/\1>#s', // reset previous fix
            '#(&nbsp;)&nbsp;(?![<\s])#', // clean up ...
            '#(?<=\>)(&nbsp;)(?=\<)#', // --ibid
            // Remove HTML comment(s) except IE comment(s)
            '#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s',
        ),
        array(
            '<$1$2</$1>',
            '$1$2$3',
            '$1$2$3',
            '$1$2$3$4$5',
            '$1$2$3$4$5$6$7',
            '$1$2$3',
            '<$1$2',
            '$1 ',
            '$1',
            "",
        ),
        $input
    );
}

// CSS Minifier => http://ideone.com/Q5USEF + improvement(s)
function minify_css($input)
{
    if (trim($input) === "") {
        return $input;
    }

    return preg_replace(
        array(
            // Remove comment(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
            // Remove unused white-space(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
            // Replace `:0 0 0 0` with `:0`
            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
            // Replace `background-position:0` with `background-position:0 0`
            '#(background-position):0(?=[;\}])#si',
            // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
            '#(?<=[\s:,\-])0+\.(\d+)#s',
            // Minify string value
            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
            // Minify HEX color code
            '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
            // Replace `(border|outline):none` with `(border|outline):0`
            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
            // Remove empty selector(s)
            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s',
        ),
        array(
            '$1',
            '$1$2$3$4$5$6$7',
            '$1',
            ':0',
            '$1:0 0',
            '.$1',
            '$1$3',
            '$1$2$4$5',
            '$1$2$3',
            '$1:0',
            '$1$2',
        ),
        $input
    );
}

// JavaScript Minifier
function minify_js($input)
{
    if (trim($input) === "") {
        return $input;
    }

    return preg_replace(
        array(
            // Remove comment(s)
            '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
            // Remove white-space(s) outside the string and regex
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
            // Remove the last semicolon
            '#;+\}#',
            // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
            '#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
            // --ibid. From `foo['bar']` to `foo.bar`
            '#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i',
        ),
        array(
            '$1',
            '$1$2',
            '}',
            '$1$3',
            '$1.$3',
        ),
        $input
    );
}

function arrayToConditions($values, $searchColumns)
{
    $conditions = [];

    foreach ($values as $key => $value) {
        $columnOptions = $searchColumns[$key];
        if (!empty($columnOptions['condition'])) {
            $condition = $columnOptions['condition'] . " $value";
        } else {
            $condition = "LIKE '%$value%'";
            if (strpos($key, 'Id')) {
                $condition = "= $value";
            }
        }

        $paramConditions = [];
        foreach ($columnOptions['fields'] as $column) {
            $paramConditions[] = "$column $condition";
        }
        $conditions[] = '(' . implode(' OR ', $paramConditions) . ')';
    }

    return $conditions;
}

function sendBulkSms($toNumbers, $message)
{
    $toNumbers = trim($toNumbers);
    $toNumbers = str_replace(' ', '', $toNumbers);
    $toNumbers = preg_replace('/^0/is', '84', $toNumbers);
    $client = new SoapClient('http://ams.tinnhanthuonghieu.vn:8009/bulkapi?wsdl');
    $params = [
        "User" => getenv('VT_SMS_USERNAME'),
        "Password" => getenv('VT_SMS_PASSWORD'),
        "CPCode" => getenv('VT_SMS_CPCODE'),
        "RequestID" => "1",
        "UserID" => $toNumbers,
        "ReceiverID" => $toNumbers,
        "ServiceID" => getenv('VT_SMS_ALIAS'),
        "CommandCode" => "bulksms",
        "Content" => $message,
        "ContentType" => "0"
    ];

    $response = $client->__soapCall("wsCpMt", array($params));
    return $response;
}

function checkCaptcha($str)
{
    if (empty($_SESSION['captcha_code'])) {
        return false;
    }
    $str = strtolower($str);
    $index = array_search($str, $_SESSION['captcha_code']);
    if ($index === false) {
        return false;
    }

    array_splice($_SESSION['captcha_code'], $index, 1);
    return true;
}

function sendToCRM($data)
{
    try {
        $client = new Client([
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);

        $body = [
            'name' => $data['ho_ten'] ?: $data['sdt'],
            'email' => $data['email'],
            'phone' => $data['sdt'],
            'address' => $data['dia_chi'],
            'subject' => $data['subject'],
            'message' => $data['noi_dung'],
            'source' => getenv('APP_DOMAIN'),
            'messageType' => isset($data['messageType']) && $data['messageType'] ? $data['messageType'] : 1,
            'productIds' => isset($data['productIds']) && $data['productIds'] ? $data['productIds'] : null,
        ];

        return $client->post(getenv('CRM_API_BASE') . '/contact-messages', [
            'json' => $body,
        ]);
    } catch (\Throwable $th) {
        //throw $th;
        return false;
    }
}

function sendOrderToCRM($data)
{
    $client = new Client([
        // You can set any number of default request options.
        'timeout' => 2.0,
    ]);

    return $client->post(getenv('CRM_API_BASE') . '/orders?key=' . getenv('CRM_PARTNER_KEY'), [
        'json' => $data,
    ]);
}

function timer_diff($time_start)
{
    return number_format(microtime(true) - $time_start, 3);
}

function uploadImageFromUrl($url)
{
    global $d;
    $url = trim($url);
    $nameParts = explode(".", $url);
    $ext = array_pop($nameParts);
    $ext = $ext ? $ext : 'gif';
    $name = date('Y-m-d_H-i-s') . $d->fns_Rand_digit(0, 9, 12) . "." . $ext;
    $ext = strtolower($ext);

    //check if the files are only image / document
    if ($ext == "jpg" or $ext == "png" or $ext == "gif" or $ext == "doc" or $ext == "docx" or $ext == "pdf") {
        //here is the actual code to get the file from the url and save it to the uploads folder
        //get the file from the url using file_get_contents and put it into the folder using file_put_contents
        $target = __ROOT_PATH . '/img_data/images/' . $name;
        $upload = @file_put_contents($target, @file_get_contents($url));
        if ($upload) {
            return $name;
        }
    }

    return false;
}

function uploadImageFromSorce($source)
{
    global $d;

    $image = imagecreatefromstring(base64_decode($source));
    $name = date('Y-m-d_H-i-s') . $d->fns_Rand_digit(0, 9, 12) . '.jpg';

    return imagejpeg($image, __ROOT_PATH . '/img_data/images/' . $name, 90) ? $name : false;
}

/**
 * @return array of request body
 */
function getRequestJSON()
{
    return json_decode(file_get_contents('php://input'), true);
}

if (!function_exists('get_column_show')) {
    function get_column_show()
    {
        global $config;

        return $config['data']['columns']['show'];
    }
}

function getApiUploadFile()
{
    return FILEURL . 'admin/api.php?func=uploadImg&site=local';
}

function getSmsMessage(string $typeName = null)
{
    if (!$typeName) {
        return null;
    }

    $brand = env('SMS_BRAND', 'default');
    $listSmsStr = file_get_contents(__ROOT_PATH . '/img_data/files/sms/' . $brand . '.json');
    if (!$listSmsStr) {
        return null;
    }

    $listSms = json_decode($listSmsStr, 1);
    if (empty($listSms[$typeName])) {
        return null;
    }

    return $listSms[$typeName];
}

function sendSms(string $phone, string $type = null)
{
    global $smsSender;

    if (empty($type) || empty($phone)) {
        return;
    }

    if (!$smsSender) {
        $smsSender = new VietGuysSMS([
            'from' => env('SMS_BRAND', 'VIETGUYS'),
            'u' => env('SMS_ACCOUNT', ''),
            'pwd' => env('SMS_ACCOUNT_PASSWORD', ''),
        ]);
    }

    $phone = preg_replace('/[^\d]+/is', '', $phone);
    $phone = preg_replace('/^0/is', '84', $phone);

    $content = getSmsMessage($type);
    if (!$content) {
        return;
    }
    try {
        $result = $smsSender->sendCSKH($phone, $content);
        return $result;
    } catch (\Throwable $th) {
        throw $th;
        return false;
    }
}

function toSafePath($path)
{
    $safePath = preg_replace('/\.+\//', '/', $path);
    $safePath = preg_replace('/\/+/', '/', $safePath);

    return $safePath;
}

function sendCachedFile($realPath)
{
    $safePath = toSafePath($realPath);
    $path = str_replace(__CACHE_HTML, '', $safePath);
    $path = '/html' . $path;
    // header('Cache-Control: public, must-revalidate');
    // header('Pragma: no-cache');
    header('Content-Type: text/html');
    header('x-minh-path: ' . $path);
    // header('Content-Length: ' .(string)(filesize($realPath)) );
    // header('Content-Disposition: attachment; filename='.$filename.'');
    // header('Content-Transfer-Encoding: binary');
    header('X-Accel-Redirect: ' . $path);
    exit(0);
}

function getCustomProductName(&$product, $fallBackKey = null, $site = SITE_DOMAIN)
{
    global $config;
    if (!$fallBackKey) {
        $fallBackKey = 'name_' . $_SESSION['lang'];
    }
    $names = is_array($product['name_json']) ? $product['name_json'] : json_decode($product['name_json'], 1);
    $product['name_json'] = $names;
    $nameKey = !empty($config['domainNameMap'][$site]) ? $config['domainNameMap'][$site] : '';

    return !empty($names[$nameKey]) ? $names[$nameKey] : $product[$fallBackKey];
}

function getCustomSetting($key, $fallBackKey = null, $fallbackValue = null)
{
    global $SETTINGS, $d;

    if (empty($SETTINGS)) {
        $SETTINGS = $d->getAllSettings();
    }

    $setting = $SETTINGS[$key] ?: $SETTINGS[$fallBackKey];

    return !$setting ? $fallbackValue : $setting['value'];
}

function count_product_number($id = '', $type = '')
{
    global $d;
    if (!$id) {
        return 0;
    }
    if (!$type) {
        return 0;
    }
    if ($type == 'category') {
        $cats = array();
        $cats[] = $id;
        $sub1 = $d->o_fet("select id from #_category where category_id={$id} and hien_thi=1");
        if ($sub1) {
            foreach ($sub1 as $s1) {
                $cats[] = $s1['id'];
                $sub2 = $d->o_fet("select id from #_category where category_id={$s1['id']} and hien_thi=1");
                if ($sub2) {
                    foreach ($sub2 as $s2) {
                        $cats[] = $s2['id'];
                    }
                }
            }
        }
        $cats = implode(',', $cats);
        $sql = $d->simple_fetch("select count(id) as cid from #_sanpham where category_id IN ($cats) and hien_thi=1");
    } elseif ($type == 'brand') {
        $sql = $d->simple_fetch("select count(id) as cid from #_sanpham where brand_id IN ($id) and hien_thi=1");
    }
    return $sql['cid'] ? $sql['cid'] : 0;
}

function count_category_product_number($id = '')
{
    global $d;
    if (!$id) {
        return 0;
    }

    $cats = array();
    $cats[] = $id;
    $sub1 = $d->o_fet("select id from #_category where category_id={$id} and hien_thi=1");
    if ($sub1) {
        foreach ($sub1 as $s1) {
            $cats[] = $s1['id'];
            $sub2 = $d->o_fet("select id from #_category where category_id={$s1['id']} and hien_thi=1");
            if ($sub2) {
                foreach ($sub2 as $s2) {
                    $cats[] = $s2['id'];
                }
            }
        }
    }
    $cats = implode(',', $cats);

    $sql = $d->simple_fetch("select sum(so_luong) as quantity from #_category where id IN ($cats) and hien_thi=1");

    return $sql['quantity'] ? $sql['quantity'] : 0;
}

function get_parent_category_by_id($cat_id)
{
    global $d;
    if (!$cat_id) {
        return '';
    }
    $arr = array();
    $query_1 = $d->simple_fetch("select category_id from #_category where id={$cat_id}");
    $parent_1 = $query_1['category_id'];
    if ($parent_1 && $parent_1 != 0) {
        $arr[] = $parent_1;

        $query_2 = $d->simple_fetch("select category_id from #_category where id={$parent_1}");
        $parent_2 = $query_2['category_id'];
        if ($parent_2 && $parent_2 != 0) {
            $arr[] = $parent_2;
        }
    }
    return $arr;
}

function get_widget_by_category_position($cat_id, $position)
{
    global $d;
    if (!$cat_id) {
        return '';
    }
    if (!$position) {
        return '';
    }

    $cat_list = $cat_id;
    $parent_arr = get_parent_category_by_id($cat_id);
    if (!empty($parent_arr)) {
        $parent_list = implode(',', $parent_arr);
        $cat_list .= ',' . $parent_list;
    }

    $widget_arr = array();
    $html = '';

    $sql = "select w.id, w.name_vi, w.content_vi from #_widget w inner join #_widget_category wc on w.id = wc.widget_id where wc.category_id in ($cat_list) and w.group_id = $position and w.is_active = 1";
    $widgets = $d->o_fet($sql);
    if ($widgets) {
        $html .= '<div class="p-widget-wrap p-widget-wrap-' . $widget['id'] . '">';
        foreach ($widgets as $widget) {
            $html .= '<div class="p-widget-item">
						<div class="p-widget-title">' . $widget['name_vi'] . '</div>
						<div class="p-widget-content">' . $widget['content_vi'] . '</div>
					</div>';
        }
        $html .= '</div>';
    }
    return $html;
}