<?php

namespace Drupal\entity_reference_quantity\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceLabelFormatter;

/**
 * Plugin implementation of the 'entity_reference_quantity_label' formatter.
 *
 * @FieldFormatter(
 *   id = "entity_reference_quantity_label",
 *   label = @Translation("Label with quantity"),
 *   description = @Translation("Display the label of the referenced entities with quantity."),
 *   field_types = {
 *     "entity_reference_quantity"
 *   }
 * )
 */
class EntityReferenceQuantityLabelFormatter extends EntityReferenceLabelFormatter {

  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = parent::viewElements($items, $langcode);
    $values = $items->getValue();

    foreach ($elements as $delta => $entity) {
      if (!empty($values[$delta]['quantity'])) {
        $elements[$delta]['#suffix'] = ' (' . $values[$delta]['quantity'] . ')';
      }
    }

    return $elements;
  }
}
