<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 13:31
 */
namespace backend\components;

use backend\models\sdk\VideoHandle;
use frontend\models\video\Video;
use yii\base\Component;
use yii\web\UploadedFile;

class UploadfileServers extends Component
{
    private $model;

    /**
     * UploadfileServers constructor.
     * @param null $model
     * @param array $config
     */
    public function __construct($model = null,array $config = [])
    {
        if($model){
            $this->model=$model;
        }else{
            $this->model=new Video();
        }
        parent::__construct($config);
    }

    /**
     * @param $path
     * @return bool
     * @throws \Exception
     * 上传图片到七牛云
     */
    public function uploadImg($path,$name=null){
        $videoHandle = new VideoHandle();
        return $videoHandle::uploadImage($path,$name);
    }

    /**
     * @param $path
     * @return bool
     * @throws \Exception
     * 上传图片到七牛云
     */
    public function uploadVideo($path){
        return VideoHandle::uploadVideo($path);
    }

    /**
     * @param $key
     * @return bool
     * 删除七牛云图片
     */
    public function deleteImg($key){
        $videoHandle = new VideoHandle();
        return $videoHandle::deleteResource($key);
    }

    /**
     * @param $key
     * @return bool
     * 删除七牛云图片
     */
    public function deleteVideo($key){
        $videoHandle = new VideoHandle();
        return $videoHandle::deleteVideoResource($key);
    }

    /**
     * @param $file
     * @param $value
     * @return bool
     * @throws \Exception
    批量上传图片
     */
    public function uploadFiles($file,$value)
    {
        $model=$this->model;
        $files=UploadedFile::getInstances($model,$file);
        //var_dump($files);exit;
        if($files){
            $values=array();
            foreach ($files as $v){
                $img_id = $this->uploadImg($v->tempName);
                if($img_id) array_push($values,$img_id);
            }
            if ($values) $model->$value=json_encode($values);
            return true;
        }
        return false;
    }

    /**
     * @param $value
     * @throws \Exception
     * 上传单张图片
     */
    public function uploadFile($value)
    {
        $model=$this->model;
        $file=UploadedFile::getInstance($model,$value);//var_dump($file);exit;
        if($file){
            if($model->$value) $this->deleteImg($model->$value);
            $img_id = $this->uploadImg($file->tempName);
            if ($img_id) $model->$value=$img_id;
            return $img_id;
        }
        return false;
    }

    /**
     * @param $value
     * @throws \Exception
     * 上传单张图片
     */
    public function uploadVideoThumb($value)
    {
        $model=$this->model;
        $file=UploadedFile::getInstance($model,$value);//var_dump($file);exit;
        if($file){
            if($model->$value) $this->deleteImg(str_replace(\Yii::$app->params['imageUrl'],'',$model->$value));
            $img_id = $this->uploadImg($file->tempName);
            if ($img_id) $model->$value=\Yii::$app->params['imageUrl'].$img_id;
            return $img_id;
        }else{
            unset($model->$value);
        }
        return false;
    }

    public function uploadImage($filePath,$name=null)
    {
        return $this->uploadImg($filePath,$name);
    }

    public function makeFileName( $length = 8 )
    {
        // 密码字符集，可任意添加你需要的字符
        $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
            'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's',
            't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D',
            'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O',
            'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z',
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-', '_',);
        // 在 $chars 中随机取 $length 个数组元素键名
        $keys = array_rand($chars, $length);
        $password = '';
        for($i = 0; $i < $length; $i++)
        {
            // 将 $length 个数组元素连接成字符串
            $password .= $chars[$keys[$i]];
        }
        return $password;
    }

    /**
     * @param $value
     * @return bool
     * @throws \Exception
     * 上传视频
     */
    public function uploadVideoFile()
    {
        $model = $this->model;
        $thumb = UploadedFile::getInstance($model,'thumb');
        $info = @file_get_contents(\Yii::$app->params['videoUrl'].$model->origin_video_key.'?avinfo');
        if($info){
            $info = json_decode($info,true);
            $model->duration = floor($info['format']['duration']);
            $model->status=5;
        }else{
            return -1;
        }
        $videoHandle = new VideoHandle();
        if($thumb){
            if($model->thumb){
                $this->deleteImg($model->thumb);
            }
            $reimg = $videoHandle::uploadImage($thumb->tempName);
            if($reimg){
                $model->thumb=$reimg;
            }
        }else{
            unset($model->thumb);
        }
        unset($model->subpid);
        unset($model->endpid);
    }

    public function deleteFile($value)
    {
        $this->deleteImg($value);
    }
}