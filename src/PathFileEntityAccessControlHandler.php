<?php

namespace Drupal\path_file;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Path file entity entity.
 *
 * @see \Drupal\path_file\Entity\PathFileEntity.
 */
class PathFileEntityAccessControlHandler extends EntityAccessControlHandler
{

    /**
   * {@inheritdoc}
   */
    protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) 
    {
        /**
 * @var \Drupal\path_file\Entity\PathFileEntityInterface $entity 
*/
        switch ($operation) {
        case 'view':
            if (!$entity->isPublished()) {
                return AccessResult::allowedIfHasPermission($account, 'view unpublished path file entity entities');
            }
            return AccessResult::allowedIfHasPermission($account, 'view published path file entity entities');

        case 'update':
            return AccessResult::allowedIfHasPermission($account, 'edit path file entity entities');

        case 'delete':
            return AccessResult::allowedIfHasPermission($account, 'delete path file entity entities');
        }

        // Unknown operation, no opinion.
        return AccessResult::neutral();
    }

    /**
   * {@inheritdoc}
   */
    protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = null) 
    {
        return AccessResult::allowedIfHasPermission($account, 'add path file entity entities');
    }

}
