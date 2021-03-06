<?php

namespace App\Lib;

use Intervention\Image\ImageManagerStatic as IImage;
use Intervention\Image\Image;
use App\Lib\IDimager;
use App\Lib\Dimage;
use App\Lib\Utility;
use App\Exceptions\DimageNotFoundException;

class Dimager implements IDimager {

    private $dir;

    protected function first($query) {
        $files = glob($query);
        //dd($query,$files);
        if (array_key_exists(0,$files)) {
            return Dimage::fromFileName($files[0]);
        }
        throw new DimageNotFoundException("Query '$query' yielded no results.");
    }

    protected function list($query) {
        $files = glob($query);
        $r = [];
        foreach ($files as $filename) {
            $r[] = Dimage::fromFileName($filename);
        }
        return $r;
    }

    public function __construct($path = null) {
        $this->dir = $path;
    }

    public function getById($id) {
        $query = $this->dir."/*.*.*.*.*.$id.*";
        return $this->first($query);
    }

    public function getDomain($domain) {
        $query = $this->dir."/$domain.*.*.org.org.*.*";
        return $this->list($query);
    }

    public function getSources($domain, $slug) {
        $query = $this->dir."/$domain.$slug.*.org.org.*.*";
        return $this->list($query);
    }

    public function getSource($domain, $slug, $index = 0, $profile='org', $density='org') {
        $idx = Utility::idx($index);
        $query = $this->dir."/$domain.$slug.$idx.$profile.$density.*.*";
        return $this->first($query);
    }

    public function getImage(Dimage $dimage) {
        $filepath = $this->dir."/".$dimage->getFileName();
        return IImage::make($filepath);
    }

    public function createImage(Dimage $dimage, Image $iimage) {
        $dimage->id = DimageId::get($this->dir);
        $filepath = $this->dir."/".$dimage->getFileName();
        $iimage->save($filepath);
        return $dimage;
    }
    
    public function renameImage(Dimage $oldDimage, Dimage $newDimage) {
        
        $source = $this->dir."/".$oldDimage->getFileName();
        $dest = $this->dir."/".$newDimage->getFileName();
        rename($source, $dest);
        return $newDimage;
    }

    public function updateImage(Dimage $dimage, Image $iimage) {
        $filepath = $this->dir."/".$dimage->getFileName();
        $iimage->save($filepath);
        return $dimage;
    }

    public function saveImage(Dimage $dimage, Image $iimage) {
        if (empty($dimage->id)) return $this->createImage($dimage, $iimage);
        return $this->updateImage($dimage, $iimage);
    }

    public function deleteImage($id) {
        $query = $this->dir."/*.*.*.*.*.$id.*";
        $files = glob($query);
        if (array_key_exists(0, $files)) {
            return unlink($files[0]);
        }
        return false;
    }

    public function deleteAll(string $domain) {
        $query = $this->dir."/$domain.*.*.*.*.*.*";
        $files = glob($query);
        $cnt = count($files);
        foreach ($files as $file) {
            unlink($file);
        }
        return $cnt;
    }
}