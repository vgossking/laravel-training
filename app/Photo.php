<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Photo extends Model
{
    //
    public $imageLink = '/images/';

    protected $fillable=['path'];

    public function user(){
        return $this->hasOne('App\User');
    }

    public function getPathAttribute($path){
        return $this->imageLink.$path;
    }

    public function setPathAttribute($path){
        $path = $this->convertToNonUnicode($path);
        $path = $this->generateNewNameIfExist($path);
        $this->attributes['path'] = $path;
    }

    public function generateNewNameIfExist($fileName){
        $count = 0;
        while($this->checkPathNameExist($fileName)){
            $count++;
            $fileName = $count.'-'.$fileName;
        }
        return $fileName;
    }


    public function checkPathNameExist($fileName){
        $photos = DB::table('photos')->where('path',$fileName)->count();
        if($photos > 0)
            return true;
        return false;
    }


    public function unlinkFileIfExist(){
        if(file_exists(public_path().$this->path)){
            unlink(public_path().$this->path);
        }
    }

    public function convertToNonUnicode($str)
    {
        if (!$str) return false;
        $unicode = array(
            'a' => array('á', 'à', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ặ', 'ằ', 'ẳ', 'ẵ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ'),
            'A' => array('Á', 'À', 'Ả', 'Ã', 'Ạ', 'Ă', 'Ắ', 'Ặ', 'Ằ', 'Ẳ', 'Ẵ', 'Â', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ'),
            'd' => array('đ'),
            'D' => array('Đ'),
            'e' => array('é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ'),
            'E' => array('É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ'),
            'i' => array('í', 'ì', 'ỉ', 'ĩ', 'ị'),
            'I' => array('Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị'),
            'o' => array('ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ'),
            'O' => array('Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ', 'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ'),
            'u' => array('ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự'),
            'U' => array('Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự'),
            'y' => array('ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'),
            'Y' => array('Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'),
        );
        foreach ($unicode as $nonUnicode => $uni) {
            foreach ($uni as $value) {
                $str = @str_replace($value, $nonUnicode, $str);
            }
            $str = preg_replace("/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/", "-", $str);
            $str = preg_replace("/-+-/", "-", $str);
            $str = preg_replace("/^\-+|\-+$/", "", $str);
        }
        return $str;
    }
}
