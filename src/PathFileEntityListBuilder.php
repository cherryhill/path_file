<?php

namespace Drupal\path_file;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;
use Drupal\path\Plugin\migrate\destination\UrlAlias;

/**
 * Defines a class to build a listing of Path file entity entities.
 *
 * @ingroup path_file
 */
class PathFileEntityListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Path file entity ID');
    $header['name'] = $this->t('Name');
    $header['Url'] = $this->t('Url');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\path_file\Entity\PathFileEntity */
    $row['id'] = $entity->id();

    //display name as a link to the edit form
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.path_file_entity.edit_form', array(
          'path_file_entity' => $entity->id(),
        )
      )
    );

    //Display path, links to the file itself
    $url = $entity->url();
    $row['path'] = $this->l($url, new Url(
      'entity.path_file_entity.canonical', array(
        'path_file_entity' => $entity->id(),
      )
    ));

    return $row + parent::buildRow($entity);
  }

}
