<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\UploadFilesController;
use Illuminate\Support\Facades\Storage;
class Certificate extends Model
{
    protected $table = 'certificates';

    protected $fillable = [
        'image',
        'order',
        'alt'
    ];

    public function rules($id = null)
    {
        return [
            'image' => 'ext:jpg,jpeg,image/jpeg',
            'order' => 'required|alpha_num',
            'alt'   => 'required|max:255',
        ];
    }

    public function uploadFile($formData){
        if (!empty($formData['delete_image']) && empty($formData['image'])) {
            UploadFilesController::deleteFile('image', $this);
        }
        if (!empty ($formData['image'])) {
            UploadFilesController::uploadFile('image',
                $formData['image']->getClientOriginalExtension(),
                $formData['image'],
                $this,
                700);
        }
    }

}
