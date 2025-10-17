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
    )
    {
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

        // Créer les différentes tailles d'images
        foreach ($sizes as $size) {
            $variant = clone $image;
            // Redimensionner l'image
            $resizedImage = $variant->scale($size['width']) ;
            $resizedImage->save(Storage::disk('public')->path(config('contactavatar.variant_path')));
           // $image->aspectRatio();  // Conserver l'aspect ratio
            //$image->upsize();  // Ne pas agrandir l'image si elle est plus petite

        }
    }
}
