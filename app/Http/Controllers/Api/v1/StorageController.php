<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorageRequest;
use App\Repositories\Storage\StorageRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Response;

class StorageController extends Controller
{
    public $storageRepository;

    public function __construct(StorageRepositoryInterface $storageRepository)
    {
        $this->storageRepository = $storageRepository;
    }

    /**
     * Handle the incoming request.
     *
     * @param StorageRequest $request
     * @return JsonResponse
     */
    public function __invoke(StorageRequest $request): JsonResponse
    {
        $request->validated();

        $uploadFolder = $request->folderName ?? 'other';
        $createdIdKey = $uploadFolder.'_id';
        $createdId = $request->createdId ?? '';
        $modelName = $request->modelName ?? '';


        $image = $request->file('image') ?? $request->file('file');

        // optimizing image
        if($image->getMimeType() == "image/jpeg" || $image->getMimeType() == "image/png"){
            $fileSize = Image::make($image)->filesize();
            $thumbnail = Image::make($image)->resize(320, 240);
            ImageOptimizer::optimize($image);
        }

        $imageUploadedPath = $image->store($uploadFolder, 'public');

        $imageUrl = Storage::disk('public')->url($imageUploadedPath);
        $uploadedImageResponse = array(
            "image_name" => basename($imageUploadedPath),
            'image_uploaded_path' => $imageUploadedPath,
            "image_url" => $imageUrl,
            "mime" => $image->getClientMimeType(),
            'file_size' => $fileSize ?? '',
        );

        // Storage repository function

        $insert = $this->storageRepository->create($uploadedImageResponse);
        $uploadedImageResponse['id'] = $insert->id;

        // Storage Pivot Insert

        if ($request->has('createdId')){
            $modelName::create([
                $createdIdKey => $createdId,
                'storage_id' => $uploadedImageResponse['id'],
            ]);
        }

        return Response::json(['message' => 'Resim yükleme işlemi başarılı', 'messageType' => 'success', 'status' => 200, 'created_id' => $createdId, 'data' => $uploadedImageResponse], 200);
    }
}
