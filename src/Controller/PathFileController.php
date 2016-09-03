<?php

namespace Drupal\path_file\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\path_file\Entity\PathFileEntityInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Drupal\file\Entity\File;
use Drupal\Core\File\FileSystem;

/**
* An example controller.
*/
class PathFileController extends ControllerBase {

  protected $file_system;

  public function __construct(FileSystem $file_system) {
    $this->file_system = $file_system;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('file_system')
    );
  }

  /**
  * {@inheritdoc}
  */
  public function file(PathFileEntityInterface $path_file_entity) {

    $fid = $path_file_entity->getFid();
    $file = File::load($fid);
    $uri = $file->getFileUri();
    $server_path = $this->file_system->realpath($uri);

    return new BinaryFileResponse($server_path);
  }

}