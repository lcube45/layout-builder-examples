<?php

declare(strict_types = 1);

namespace Drupal\layout_builder_examples\Element;

use Drupal\layout_builder\Element\LayoutBuilder;
use Drupal\layout_builder\SectionStorageInterface;

/**
 * Provides a modal layout builder element.
 *
 * @RenderElement("modal_layout_builder")
 */
class ModalLayoutBuilder extends LayoutBuilder {

  /**
   * {@inheritdoc}
   */
  protected function buildAddSectionLink(SectionStorageInterface $section_storage, $delta): array {
    $build = parent::buildAddSectionLink($section_storage, $delta);

    $url = $build['link']['#url'];
    $options = $url->getOptions();
    $options['attributes']['data-dialog-type'] = 'modal';
    unset($options['attributes']['data-dialog-renderer']);
    $url->setOptions($options);

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  protected function buildAdministrativeSection(SectionStorageInterface $section_storage, $delta) {
    $build = parent::buildAdministrativeSection($section_storage, $delta);

    // Use the modal for removing a section.
    $build['remove']['#attributes']['data-dialog-type'] = 'modal';
    unset($build['remove']['#attributes']['data-dialog-renderer']);

    // Use the modal for editing a section.
    $build['configure']['#attributes']['data-dialog-type'] = 'modal';
    unset($build['configure']['#attributes']['data-dialog-renderer']);

    // Use the modal for adding a block to a section.
    foreach ($build['layout-builder__section'] as &$section) {
      if (!is_array($section) || empty($section['layout_builder_add_block'])) {
        continue;
      }

      $url = $section['layout_builder_add_block']['link']['#url'] ?? NULL;
      $options = $url->getOptions();
      $options['attributes']['data-dialog-type'] = 'modal';
      unset($options['attributes']['data-dialog-renderer']);
      $url->setOptions($options);
    }

    return $build;
  }

}
