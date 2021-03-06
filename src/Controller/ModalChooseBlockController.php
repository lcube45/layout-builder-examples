<?php

declare(strict_types = 1);

namespace Drupal\layout_builder_examples\Controller;

use Drupal\Component\Serialization\Json;
use Drupal\layout_builder\Controller\ChooseBlockController;

/**
 * Provides a choose block controller using modals.
 */
class ModalChooseBlockController extends ChooseBlockController {

  /**
   * {@inheritdoc}
   */
  protected function getAjaxAttributes() {
    if ($this->isAjax()) {
      return [
        'class' => ['use-ajax'],
        'data-dialog-type' => 'modal',
        'data-dialog-options' => Json::encode(['width' => 700]),
      ];
    }
    return [];
  }

}
