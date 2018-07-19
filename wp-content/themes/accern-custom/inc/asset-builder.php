<?php
/*
============================
  [[[ Sage Asset Builder ]]]
============================
*/

// Asset Class
class Asset {
  public static $dist = '/dist';
  protected $manifest;
  protected $asset;
  protected $dir;
  public function __construct($file, ManifestInterface $manifest = null) {
    $this->manifest = $manifest;
    $this->asset = $file;
  }
  public function __toString() {
    return $this->getUri();
  }
  public function getUri() {
    $file = ($this->manifest ? $this->manifest->get($this->asset) : $this->asset);
    return get_template_directory_uri() . self::$dist . "/$file";
  }
}

// JSONManifest Class
class JsonManifest implements ManifestInterface {
  protected $manifest = [];
  public function __construct($manifestPath) {
    $this->manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : [];
  }
  public function get($file) {
    return isset($this->manifest[$file]) ? $this->manifest[$file] : $file;
  }
  public function getAll() {
    return $this->manifest;
  }
}

// Intrepret the JSON Manifest
interface ManifestInterface {
  public function get($file);
  public function getAll();
}

// Read and dynamically assign the asset path
function asset_path($filename) {
  static $manifest;
  isset($manifest) || $manifest = new JsonManifest(get_template_directory_uri() . '/' . Asset::$dist . '/assets.json');
  return (string) new Asset($filename, $manifest);
}
