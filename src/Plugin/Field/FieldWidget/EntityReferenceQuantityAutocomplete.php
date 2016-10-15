<?php

namespace Drupal\entity_reference_quantity\Plugin\Field\FieldWidget;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldWidget\EntityReferenceAutocompleteWidget;

/**
 * @FieldWidget(
 *   id = "entity_reference_quantity_autocomplete",
 *   label = @Translation("Autocomplete"),
 *   description = @Translation("An autocomplete text field with associated data."),
 *   field_types = {
 *     "entity_reference_quantity"
 *   }
 * )
 */
class EntityReferenceQuantityAutocomplete extends EntityReferenceAutocompleteWidget {

  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $widget = array(
      '#attributes' => ['class' => ['form--inline']],
      '#theme_wrappers' => ['container'],
    );
    $widget['target_id'] = parent::formElement($items, $delta, $element, $form, $form_state);
    $widget['quantity'] = array(
      '#type' => 'number',
      '#size' => '4',
      '#default_value' => isset($items[$delta]) ? $items[$delta]->quantity : 1,
      '#placeholder' => $this->fieldDefinition->getSetting('qty_placeholder'),
      '#weight' => 10,
    );

    return $widget;
  }
}
