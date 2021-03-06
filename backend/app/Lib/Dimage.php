<?php

namespace App\Lib;

use Intervention\Image\ImageManagerStatic as IImage;
use App\Exceptions\FileNameInvalidException;

use stdClass;

class Dimage {
    private static $fileNameExp = "/(.+\/)?(?<domain>[^.]+)\.(?<slug>[^.]+)\.(?<index>[^.]+)\.(?<profile>[^.]+)\.(?<density>[^.]+)\.(?<id>[^.]+)\.(?<ext>[^.]+)$/";

    public static function fromStdClass(stdClass $source) {
        $dimage = new Dimage;
        $dimage->id = $source->id;
        $dimage->domain = $source->domain;
        $dimage->slug = $source->slug;
        $dimage->index = $source->index;
        $dimage->profile = $source->profile;
        $dimage->density = $source->density;
        $dimage->ext = $source->ext;
        return $dimage;
    }

    public static function fromFileName(string $filepath) {
        $m = null;
        $r = preg_match(self::$fileNameExp, $filepath, $m);
        if ($r) {
            $record = new Dimage;
            $record->id = 0 + $m['id'];
            $record->domain = $m['domain'];
            $record->slug   = $m['slug'];
            $record->index  = 0 + $m['index'];
            $record->profile = $m['profile'];
            $record->density = $m['density'];
            $record->ext = $m['ext'];
            return $record;
        }
        throw new FileNameInvalidException("Filepath '$filepath' invalid");
    }

    public $id;
    public $domain;
    public $slug;
    public $index;
    public $profile;
    public $density;
    public $ext;

    public function __construct(string $domain = null, string $slug = null, $index = null, string $profile=null, string $density=null, string $ext = null, $id = 0) {
        $this->id      = $id;
        $this->domain  = $domain;
        $this->slug    = $slug;
        $this->index   = $index;
        $this->profile = $profile;
        $this->density = $density;
        $this->ext     = $ext;
    }

    public function getRoute() {
        return "/mhn/dim/{$this->domain}/{$this->slug}/launcher-icon/mdpi/{$this->index}";
    }

    public function getFileName() {
        return $this->getDerivedFileName($this->profile, $this->density);
    }

    public function getDerivedFileName(string $profile = 'org', string $density = 'org') {
        $idx = Utility::idx($this->index);
        return "{$this->domain}.{$this->slug}.$idx.$profile.$density.{$this->id}.{$this->ext}";
    }

    public function getSourceFileName() {
        $idx = Utility::idx($this->index);
        return "{$this->domain}.{$this->slug}.$idx.org.org.{$this->id}.{$this->ext}";
    }
}