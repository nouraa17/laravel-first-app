<?php

namespace App\Listeners;

use App\Actions\ImageModelSave;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\traits\upload_image;

class SaveProductImagesListener
{
    use upload_image;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
//        dd('now listener working', $event->data,$event->images,$event->product);
        foreach($event->images as $image) {
            $name = $this->uploadImage($image,'products');
            ImageModelSave::make($event->product->id, 'Product', $name);
        }
    }
}
