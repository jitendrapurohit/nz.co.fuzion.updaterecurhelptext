<?php

require_once 'updaterecurhelptext.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function updaterecurhelptext_civicrm_config(&$config) {
  _updaterecurhelptext_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function updaterecurhelptext_civicrm_xmlMenu(&$files) {
  _updaterecurhelptext_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function updaterecurhelptext_civicrm_install() {
  $optionGroup = civicrm_api3('OptionGroup', 'create', array(
    'name' => "recur_help_text",
    'data_type' => "String",
    'title' => "Recur Help Text",
  ));
  $subscriptionOV = civicrm_api3('OptionValue', 'create', array(
    'option_group_id' => "recur_help_text",
    'label' => "Subscribtion Help Text",
    'value' => "subscription_help_text",
    'description' => "Use this form to change the amount or number of installments for this recurring contribution. Changes will be automatically sent to the payment processor. You can not change the contribution frequency.",
  ));
  $billingOV = civicrm_api3('OptionValue', 'create', array(
    'option_group_id' => "recur_help_text",
    'label' => "Billing Help Text",
    'value' => "billing_help_text",
    'description' => "Use this form to update the credit card and billing name and address used for this recurring contribution.",
  ));
  _updaterecurhelptext_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function updaterecurhelptext_civicrm_postInstall() {
  _updaterecurhelptext_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function updaterecurhelptext_civicrm_uninstall() {
  _updaterecurhelptext_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function updaterecurhelptext_civicrm_enable() {
  _updaterecurhelptext_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function updaterecurhelptext_civicrm_disable() {
  _updaterecurhelptext_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function updaterecurhelptext_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _updaterecurhelptext_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function updaterecurhelptext_civicrm_managed(&$entities) {
  _updaterecurhelptext_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function updaterecurhelptext_civicrm_caseTypes(&$caseTypes) {
  _updaterecurhelptext_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function updaterecurhelptext_civicrm_angularModules(&$angularModules) {
  _updaterecurhelptext_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function updaterecurhelptext_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _updaterecurhelptext_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

function updaterecurhelptext_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Contribute_Form_UpdateBilling') {
    $billingHelpText = civicrm_api3('OptionValue', 'getsingle', array(
      'return' => array("description"),
      'option_group_id' => "recur_help_text",
      'value' => "billing_help_text",
    ));
    CRM_Core_Region::instance('contribute-form-updatebilling-recurhelp')->update('default', array(
      'disabled' => TRUE,
    ));
    CRM_Core_Region::instance('contribute-form-updatebilling-recurhelp')->add(array(
      'markup' => $billingHelpText['description'],
    ));
  }

  if ($formName == 'CRM_Contribute_Form_UpdateSubscription') {
    $subscriptionHelpText = civicrm_api3('OptionValue', 'getsingle', array(
      'return' => array("description"),
      'option_group_id' => "recur_help_text",
      'value' => "subscription_help_text",
    ));
    CRM_Core_Region::instance('contribute-form-updatesubscription-changehelp')->update('default', array(
      'disabled' => TRUE,
    ));
    CRM_Core_Region::instance('contribute-form-updatesubscription-changehelp')->add(array(
      'markup' => $subscriptionHelpText['description'],
    ));
  }
}
// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function updaterecurhelptext_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function updaterecurhelptext_civicrm_navigationMenu(&$menu) {
  _updaterecurhelptext_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'nz.co.fuzion.updaterecurhelptext')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _updaterecurhelptext_civix_navigationMenu($menu);
} // */
