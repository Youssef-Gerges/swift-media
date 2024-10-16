<?php

namespace LaravelDaddy\SwiftMedia;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use LaravelDaddy\SwiftMedia\Repositories\MediaRepo;

class SwiftMedia
{
    private $mediaRepo;
    public function __construct()
    {
        $this->mediaRepo = new MediaRepo();
    }

    public function uploadFile($model_type, $model_id, $attribute, $file, $path = '/')
    {
        $name = Str::random() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $name);
        $file_path = $path . '/' . $name;
        $media = $this->mediaRepo->findFile($model_type, $model_id, $attribute);
        $this->delete($media);
        return $this->mediaRepo->addFile($model_type, $model_id, $attribute, $file_path, $media);
    }

    public function getFile($model_type, $model_id, $attribute)
    {
        return $this->mediaRepo->findFile($model_type, $model_id, $attribute);

    }

    private function delete($media): void
    {
        if ($media && File::exists($media->path)) {
            File::delete($media->path);
        }
    }

    public function deleteFile($model_type, $model_id, $attribute)
    {
        $media = $this->mediaRepo->findFile($model_type, $model_id, $attribute);
        $this->delete($media);
        $this->mediaRepo->deleteFile($model_type, $model_id, $attribute);
        return true;
    }


    public function getAllFiles()
    {
        return $this->mediaRepo->getAllFiles();
    }

    public function getAllFilesPaginated($limit = 20)
    {
        return $this->mediaRepo->getAllPaginated($limit);
    }

}
