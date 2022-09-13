<?php


namespace App\Handlers;


use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageUploadHandler
{
    protected $allowedExt = ['png', 'jpg', 'gif', 'jpeg'];

    /**
     * 图片保存
     * @param $file
     * @param $folder
     * @param $filePrefix
     * @param bool $maxWidth
     * @return bool|string[]
     */
    public function save($file, $folder, $filePrefix, $maxWidth = false) {
        //文件保存路径(相对路径)
        $folderName = "uploads/images/$folder/" . date('Ym/d', time());

        //文件保存路径(绝对路径)
        $uploadPath = public_path() . '/' . $folderName;

        //文件名后缀
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        //文件名
        $fileName = $filePrefix . '_' . time() . Str::random(10) . '.' . $extension;

        if (!in_array($extension, $this->allowedExt)) {
            return false;
        }

        //移动到目标存储路径
        $file->move($uploadPath, $fileName);

        //如果限制了图片大小 就按要求裁剪
        if ($maxWidth && $extension != 'gif') {
            $this->reduceSize($uploadPath . '/' . $fileName, $maxWidth);
        }

        return ['path' => config('app.url') . "/$folderName/$fileName"];
    }

    /**
     * 裁剪图片大小
     * @param $filePath
     * @param $maxWidth
     */
    public function reduceSize($filePath, $maxWidth) {
        //实例化
        $image = Image::make($filePath);

        //照片大小调整
        $image->resize($maxWidth, $maxWidth, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        //保存
        $image->save();
    }
}
