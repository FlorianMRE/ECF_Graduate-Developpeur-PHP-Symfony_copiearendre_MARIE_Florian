<?php

namespace App\Services;

use mysql_xdevapi\Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageService
{

    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }
    public function add(UploadedFile $picture, ?string $folder='')
    {
        $fichier = md5(uniqid(rand(), true)). '.webp';

        $picture_info = getimagesize($picture);

        if ($picture_info === false) {
            throw new Exception('Format d\'image non correct');
        }

        $path = $this->params->get('images_directory'). $folder;

        $picture->move($path.'/', $fichier);

        return $fichier;
    }
}