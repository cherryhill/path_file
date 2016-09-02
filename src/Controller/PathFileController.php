<?php

namespace Drupal\path_file\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\path_file\Entity\PathFileEntityInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
* An example controller.
*/
class PathFileController extends ControllerBase {

/**
* {@inheritdoc}
*/
public function file(PathFileEntityInterface $path_file_entity) {

  $fid = $path_file_entity->fid->getValue()[0]['target_id'];
  $file = \Drupal\file\Entity\File::load($fid);
  $uri = $file->getFileUri();
  $server_path = \Drupal::service('file_system')->realpath($uri);

  return new BinaryFileResponse($server_path);
}

}