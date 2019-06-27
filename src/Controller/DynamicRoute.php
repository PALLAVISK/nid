<?php
namespace Drupal\revise\Controller;

use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
 
class DynamicRoute extends ControllerBase {
    public function content($user) {
    return array(
      '#type' => 'markup', 
      '#markup' => t('Hello ' . $user . '! I am your node listing page.'), 
    ); 
  } 
  function foo(NodeInterface $node1) {
    // dump($node1);
    return array(
      '#type' => 'markup', 
      '#markup' => t('Hello ' . $node1->body->format . '! I am your node listing page.'), 
    ); 
  }
  function kuchbhi(NodeInterface $node) {
    // dump($node1);
    return array(
      '#type' => 'markup', 
      '#markup' => t('Hello ' . $node->body->format . '! I am your node listing page.'), 
    ); 
  }

  public function access(AccountInterface $account, NodeInterface $node) {
    // Check permissions and combine that with any custom access checking needed. Pass forward
    // parameters from the route and/or request as needed.
    // dump($node);
    // exit;
    if($node->get('uid')->getString() == $account->id()){
    return AccessResult::allowed(); 
    }
     return AccessResult::forbidden();  
    
    //return ($account->hasPermission('do example things') && $this->someOtherCustomCondition()) ? AccessResult::allowed() : AccessResult::forbidden();
  }
  
} 