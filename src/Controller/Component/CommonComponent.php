<?php
namespace App\Controller\Component;
use App\Controller\AppController;
use cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

class CommonComponent extends Component
{
    public function generateRandomString($length = 10)
    {
        $characters 		= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength  = strlen($characters);
        $randomString 		= '';

        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

//------------------------------------------------------------------------
    public function uploadFile($fDetail, $path) {
        $getTimeStamp = "";
        if($fDetail['name'] != '') {
            $fName = $fDetail['name'];
            $fSize = $fDetail['size'];
            $tmpName = $fDetail['tmp_name'];
            $getTimeStamp = $this->getTimeStampNumber();
            $aFnameDetail = $this->seperateFnameAndExt($fName);

            $refName = $this->concat($getTimeStamp, $aFnameDetail);
            move_uploaded_file($tmpName,$path.DS.$refName);

            $data['refName'] = $refName;
            $data['fName'] = $fName;
            $data['fSize'] = $fSize;
            $data['fExt'] = $aFnameDetail['ext'];
            return $data;
        } else {
            //$this->Session->setFlash('Error Uploading');
        }
    }
    //------------------------------------------------------------------------
    public function seperateFnameAndExt($fName) {
        $extention =  substr($fName, strrpos($fName,'.'));
        $extLenght = strlen($extention);
        $fnameWithOutExt = substr($fName, 0, -$extLenght);
        return array('fNameWOExt' => $fnameWithOutExt, 'ext' => strtolower($extention));
    }
//------------------------------------------------------------------------
    public function getTimeStampNumber() {
        return $timeStamp = rand().mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
    }
//------------------------------------------------------------------------
    public function concat($fileName, $aFnameData) {
        return trim($fileName.$aFnameData['ext']);
    }
//------------------------------------------------------------------------
    // Unlink  a file
    public function unlinkFile($filename, $path) {

        if(isset($filename) && !empty($filename)) {
            unlink($path."/".$filename);
        } else {
            //$this->Flash->error(_('Error Removing File'));
        }
    }
//------------------------------------------------------------------------
    function removeFromString($str, $item) {
        $parts = explode(',', $str);

        while(($i = array_search($item, $parts)) !== false) {
            unset($parts[$i]);
        }
        return implode(',', $parts);
    }
//------------------------------------------------------------------------
    function seoUrl($string)
    {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $string);

        // trim
        $text = trim($text, '-');

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if(strlen($text) > 70) {
            $text = substr($text, 0, 70);
        }

        if (empty($text))
        {
            //return 'n-a';
            return time();
        }

        return $text;
    }
//------------------------------------------------------------------------

//------------------------------------------------------------------------
    public function latlang($address)
    {

        $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

        $geo = json_decode($geo, true);

        if($geo['status'] = 'OK')
        {
            $latitude = (empty($geo['results'][0]['geometry']['location']['lat'])) ? '0.00' : $geo['results'][0]['geometry']['location']['lat'];
            $longitude = (empty($geo['results'][0]['geometry']['location']['lng'])) ? '0.00' : $geo['results'][0]['geometry']['location']['lng'];
            $latlang[0]  = $latitude;
            $latlang[1]  = $longitude;
            return $latlang;
        }
    }
//------------------------------------------------------------------------
    public function distanceCal($value, $unit){
        // one miles equal to 1609.344 meters
        // one Km equal to 1000.000 meters$outletCount
        if($unit == 'M')
            return $value * 1609.344;
        else if($unit == 'Km')
            return $value * 1000.000;
    }
//------------------------------------------------------------------------
    function generateId($refid)
    {

        if (!empty($refid) && ($refid > 0))
        {
            if ($refid < 10)
            {
                $generate = '000' . $refid;
            } elseif (($refid >= 10) && ($refid < 100))
            {
                $generate = '00' . $refid;
            } elseif (($refid >= 100) && ($refid < 1000))
            {
                $generate = '0' . $refid;
            } else
            {
                $generate = $refid;
            }
        }

        return $generate;
    }
//------------------------------------------------------------------------
    function isAuthorized($role_id) {

        if(!empty($this->request->params['prefix'])) {
            $prefix = $this->request->params['prefix'];
        }else {
            $this->request->params['prefix'] = '';
        }

        //CHECK AUTH
        if($this->request->params['prefix'] == 'dryadmin' && $role_id == '2'){
            echo "<a href='".ADMIN_BASE_URL."users/logout'>Please Logout Front end</a>";exit();
        }
        elseif($this->request->params['prefix'] == '' && $role_id == '1'){
            echo "<a href='".BASE_URL."users/logout/'>Please Logout Admin Panel</a>";exit();
        }
    }
  //-------------------------------------------------------------------------------------------------------
    public function passwordGenerator($length = '') {

        $input      =   "1234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $password   =   substr(str_shuffle($input), 0, $length);
        return $password;
    }
  //---------------------------------------------------------------------------------------------------------
    //Get Mail Content
    public function getMailContent($title) {
        $mailTable      = TableRegistry::get('notifications');
        $mailContent    = $mailTable->find('all', [
            'conditions'    => [
                'title'     => $title
            ]
        ]);
        $content = !empty($mailContent) ? $mailContent->toArray() : '';
        return $content;
    }
    //-------------------------------------------------------------------------------------------------------

    //------------------------------------------------------------------------------------------------

    function getDistanceValue($latitudeFrom,$longitudeFrom,$latitudeTo,$longitudeTo,$unit){
        //Calculate distance from latitude and longitude
        $theta = $longitudeFrom - $longitudeTo;
        $dist = sin(deg2rad((double)$latitudeFrom)) * sin(deg2rad((double)$latitudeTo)) +  cos(deg2rad((double)$latitudeFrom)) * cos(deg2rad((double)$latitudeTo)) * cos(deg2rad((double)$theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == "K") {
            return number_format(($miles * 1.609344),2);
        } else if ($unit == "N") {
            return ($miles * 0.8684).' nm';
        } else {
            return $miles.' mi';
        }
    }
//--------------------------------------------------------------------------------------------------------
    public function getAddress($latitude, $longitude)
    {
        $geolocation = $latitude . ',' . $longitude;
        $request = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $geolocation . '&sensor=false';
        $file_contents = file_get_contents($request);
        $json_decode = json_decode($file_contents);
        return $json_decode->results[0]->formatted_address;
    }
    //--------------------------------------------------------------------------------------------------------
}