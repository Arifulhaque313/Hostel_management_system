<?php
namespace App\Actions\Helpers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MultiImages{
    public $request;
    public $model;

    function __construct($request,$model) {
        $this->request = $request;
        $this->model = $model;
    }
    public function store()
    {
        if($this->request->images){
            foreach (request()->images as $image) {
                $this->model->images()->create([
                    'path'=>$image->store('images')
                ]);
            }
        }
    }

    public function update()
    {
        $this->delete();
        $this->store();
    }

    public function delete()
    {
        if($this->request->deleted_image){
            foreach($this->request->deleted_image as $id){
                $image=Image::where('id',$id)->first();
                if (Storage::disk('public')->exists($image->getRawOriginal('path'))){
                    Storage::disk('public')->delete($image->getRawOriginal('path'));
                }
                $image->delete();
            }
        }
    }
}
