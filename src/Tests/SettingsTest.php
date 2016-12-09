<?php

namespace Drupal\path_file\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Tests pager functionality.
 *
 * @group Pager
 */
class SettingsTest extends WebTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array('file', 'path_file');

  /**
   * Test Settings.
   */
  public function testSettings() {
    // Any method whose name starts with "test" is a test that will be executed.
  }

}
