<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProcessUploadContactAvatar implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public $full_path_to_original,
        public $new_original_file_name
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Logique du job/ ce que ça doit faire pour traiter le job
        $image = Image::read(
            Storage::get($this->full_path_to_original)
        );
        $sizes = config('contactavatar.sizes');
        $extension = config('contactavatar.jpg_image_type');
        $compression = config('contactavatar.jpg_compression');

        // Créer les différentes tailles d'images
        foreach ($sizes as $size) {
            $variant = clone $image;
            // Redimensionner l'image
            $variant->scale($size['width']);
            $variant_path = sprintf(config('contactavatar.variants_path_pattern'),$size['width'],$size['height']);
            Storage::put($variant_path.'/'.$this->new_original_file_name, $variant->encodeByExtension($extension, $compression));
            // $image->aspectRatio();  // Conserver l'aspect ratio
            // $image->upsize();  // Ne pas agrandir l'image si elle est plus petite

        }
    }
}
