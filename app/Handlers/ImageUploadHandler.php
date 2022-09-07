<?php


namespace App\Handlers;


use Illuminate\Support\Str;

class ImageUploadHandler
{
    protected $allowedExt = ['png', 'jpg', 'gif', 'jpeg'];

    public function save($file, $folder, $filePrefix) {
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

        $file->move($uploadPath, $fileName);

        return ['path' => config('app.url') . "/$folderName/$fileName"];
    }
}
