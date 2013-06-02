<?php
/**
 * Custom User Role
 * ========================================================================
 * custom-user-role.php
 * @version 0.1 | June 2nd 2013
 * @author  Beau Charman | @beaucharman | http://www.beaucharman.me
 * @link    https://github.com/beaucharman/wordpress-custom-user-roles
 * @license MIT license
 *
 * More information about roles and capabilities
 * http://codex.wordpress.org/Roles_and_Capabilities
 */

/* ========================================================================
   Custom User Roles
   ======================================================================== */
class LT3_Custom_User_Role
{
  protected $name;
  protected $label;
  protected $capabilities;
  protected $restrictions;

  /**
   * Class constructor
   * ========================================================================
   * __construct()
   * @param  {string} $name
   * @param  {string} $label
   * @param  {array}  $capabilities
   * @param  {array}  $restrictions
   * ======================================================================== */
  function __construct($name, $label = null, $capabilities = array(), $restrictions = array())
  {
    /* Set class values */
    $this->name         = $name;
    $this->label        = ($label) ? $label : ucwords(str_replace('_', ' ', $name));
    $this->capabilities = $capabilities;
    $this->restrictions = $restrictions;
    add_action('init', array(&$this, 'add_custom_user_roles'));
  }

  /**
   * Add custom user roles
   * ========================================================================
   * add_custom_user_roles()
   * ======================================================================== */
  public function add_custom_user_roles()
  {
    add_role($this->name, $this->label);
    $role =& get_role($this->name);
    foreach ($this->capabilities as $cap)
    {
      $role->add_cap($cap);
    }
    foreach ($this->restrictions as $res)
    {
      $role->remove_cap($res);
    }
  }
}