<?php

namespace Drupal\revise\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Session\AccountProxyInterface;

/**
 * Provides a 'userDI_block' block.
 *
 * @Block(
 *  id = "userDI_block",
 *  admin_label = @Translation("DI user block"),
 * )
 */
class DIBlock extends BlockBase implements ContainerFactoryPluginInterface {
  
  /**
   * @var AccountInterface $account
   */
  protected $account;

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Session\AccountInterface $account
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountProxyInterface $account) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->account = $account;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user')
    );
  }
  
  /**
   * {@inheritdoc}
   */
  // public function build() {
  //   $build = [];
  //   $build['drupalist_activate_block']['#markup'] = '<p>Your user id is ' . $uid = $this->account->getUsername() . '</p>';

  //   return $build;
  // }
  public function build() {
    return array(
      '#markup' => $this->t($this->account->getUsername()),
    );
  } 
}