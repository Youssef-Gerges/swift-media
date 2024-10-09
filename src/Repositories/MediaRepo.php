<?php

namespace LaravelDaddy\SwiftMedia\Repositories;

use Illuminate\Support\Facades\Cache;
use LaravelDaddy\SwiftMedia\Models\SwiftMedia;

class MediaRepo
{
    public function findFile($model_type, $model_id, $attribute)
    {
        return Cache::rememberForever('swift_media_' . $model_type . '_' . $model_id . '_' . $attribute, function () use ($model_type, $model_id, $attribute) {
            return SwiftMedia::where('model_type', $model_type)
                ->where('model_id', $model_id)
                ->where('attribute', $attribute)
                ->first();
        });
    }

    public function getAllFiles()
    {
        return Cache::rememberForever('swift_media_all', function () {
            return SwiftMedia::all();
        });
    }

    public function getAllPaginated($limit = 20)
    {
        return SwiftMedia::paginate($limit);
    }

    public function addFile($model_type, $model_id, $attribute, $path, $media)
    {
        if (!$media) {
            $media = new SwiftMedia();
            $media->model_type = $model_type;
            $media->model_id = $model_id;
            $media->attribute = $attribute;
        }
        $media->path = $path;
        $media->save();

        Cache::forget('swift_media_' . $model_type . '_' . $model_id . '_' . $attribute);
        Cache::forget('swift_media_all');

        return Cache::rememberForever('swift_media_' . $model_type . '_' . $model_id . '_' . $attribute, function () use ($media) {
            return $media;
        });
    }

    public function deleteFile($model_type, $model_id, $attribute)
    {
        $media = $this->findFile($model_type, $model_id, $attribute);
        if ($media) {
            $media->delete();
        }
        Cache::forget('swift_media_' . $model_type . '_' . $model_id . '_' . $attribute);
        Cache::forget('swift_media_all');
        return true;
    }
}
