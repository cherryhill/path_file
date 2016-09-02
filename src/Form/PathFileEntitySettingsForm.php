<?php

namespace Drupal\path_file\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\field\Plugin\Core\Entity\FieldInstance;

/**
 * Class PathFileEntitySettingsForm.
 *
 * @package Drupal\path_file\Form
 *
 * @ingroup path_file
 */
class PathFileEntitySettingsForm extends ConfigFormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'PathFileEntity_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'path_file.settings',
    ];
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $allowed_settings = $form_state->getValue('allowed_extensions');

    // Update definitions and schema.
    $manager = \Drupal::entityDefinitionUpdateManager();
    $field = BaseFieldDefinition::create('file')
      ->setLabel(t('File Name'))
      ->setDescription($allowed_settings)
      ->setSetting('file_extensions', $allowed_settings)
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'file',
        'weight' => -3,
      ))
      ->setDisplayOptions('form', array(
        'weight' => -3,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $manager->installFieldStorageDefinition('fid', 'path_file_entity', 'path_file_entity', $field);


    parent::submitForm($form, $form_state);
  }

  /**
   * Defines the settings form for Path file entity entities.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['PathFileEntity_settings']['#markup'] = 'Settings form for Path file entity entities. Manage field settings here.';

    $manager = \Drupal::entityDefinitionUpdateManager();
    $field = $manager->getFieldStorageDefinition("fid", "path_file_entity");

    $allowed_extensions = $field->getSetting('file_extensions');

    $form['allowed_extensions'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Allowed File Extensions'),
      '#default_value' => $allowed_extensions,
    );

    return parent::buildForm($form, $form_state);
  }

}
